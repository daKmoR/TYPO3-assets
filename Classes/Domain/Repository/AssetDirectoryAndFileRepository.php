<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Thomas Allmer <at@delusionworld.com>
*  
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


/**
 * Repository for Tx_Assets_Domain_Repository_AssetDirectoryAndFileRepository
 */
class Tx_Assets_Domain_Repository_AssetDirectoryAndFileRepository {

	/**
	 * Constructor
	 */
	public function __construct($root = NULL, $settings = NULL) {
		$this->assetDirectoryRepository = t3lib_div::makeInstance('Tx_Assets_Domain_Repository_AssetDirectoryRepository');
		$this->assetFileRepository = t3lib_div::makeInstance('Tx_Assets_Domain_Repository_AssetFileRepository');
		
		if ($settings !== NULL) {
			$this->setSettings($settings);
		}
		if (is_dir($root)) {
			$this->setRoot($root);
			$this->init();
		}
	}

	/**
	 * Inits the whole Directory and File Repository
	 *
	 * @param string $root you can supply a root on init
	 * @return void
	 */
	public function init($root = '') {
		$this->root = is_dir($root) ? $root : $this->root;
		if (!is_dir($this->root)) {
			return 'You need to define the root directory. (example with ts: plugin.tx_assets.settings.DisplayAssetsDirectories.root = fileadmin/galerie/)';
		}
	
		$this->assetDirectoryRepository->init();
		$this->assetFileRepository->init();
		
		$categories = $this->assetDirectoryRepository->findAll();
		$assetFileRepositoryForCategory = t3lib_div::makeInstance('Tx_Assets_Domain_Repository_AssetFileRepository');
		$assetFileRepositoryForCategory->setSettings($this->settings);
		foreach($categories as $category) {
			$assetFileRepositoryForCategory->setRoot($category->getPath());
			$assetFileRepositoryForCategory->init();
			$categoryAssets = $assetFileRepositoryForCategory->findAll();
			foreach($categoryAssets as $categoryAsset) {
				$categoryAsset->addCategory($category);
				$category->addAsset($categoryAsset);
				$this->assetDirectoryRepository->update($category);
				$this->assetFileRepository->add($categoryAsset);
			}
		}
		
		$this->overrideWithFolderInfo();
		$this->checkRoles();
	}
	
	/**
	 * checks each directory for defined roles, if there are any and the logged in user has none of the roles it will be removed
	 *
	 * @return void
	 */
	public function checkRoles() {
		$categories = $this->assetDirectoryRepository->findAll();
		foreach($categories as $category) {
			$roles = $category->getRoles();
			if (is_array($roles) && !$this->frontendUserHasAnyRole($roles) ) {
				$this->removeCategory($category);
			}
		}
	}
	
	/**
	 * removes a Category form the repository and all it's subcategories and assets
	 *
	 * @param Tx_Assets_Domain_Model_Category $category
	 * @return void
	 */
	public function removeCategory($category) {
		$subCategories = $category->getSubCategories();
		if ($subCategories) {
			foreach($subCategories as $subCategory) {
				$this->removeCategory($subCategory);
			}
		}
		
		foreach($category->getAssets() as $asset) {
			$this->assetFileRepository->remove($asset);
		}
		$this->assetDirectoryRepository->remove($category);
	}
	
	/**
	 * Determines whether the currently logged in FE user belongs to any of the specified usergroups
	 *
	 * @param array $roles The usergroups (either the usergroup uids or its titles)
	 * @return boolean TRUE if the currently logged in FE user belongs to any $roles
	 */
	protected function frontendUserHasAnyRole($roles) {
		if (!isset($GLOBALS['TSFE']) || !$GLOBALS['TSFE']->loginUser) {
			return FALSE;
		}
		foreach($roles as $role) {
			if (is_numeric($role)) {
				if (is_array($GLOBALS['TSFE']->fe_user->groupData['uid']) && in_array($role, $GLOBALS['TSFE']->fe_user->groupData['uid'])) {
					return true;
				}
			} else {
				if (is_array($GLOBALS['TSFE']->fe_user->groupData['title']) && in_array($role, $GLOBALS['TSFE']->fe_user->groupData['title'])) {
					return true;
				}
			}
		}
		return false;
	}
	
	/**
	 * Recursively checks all categories and if there is a file .folderinfo it will override the category and assets properties with the properties defined in the yaml file
	 * It will override from the most inner .folderinfo to the outer once. So a .folderinfo in the root will always win
	 *
	 * @param Tx_Assets_Domain_Model_Category $category
	 * @return void
	 */
	protected function processCategory(&$category) {
		foreach($category->getSubCategories() as $subCategory) {
			$this->processCategory($subCategory);
		}
		
		if (is_file($category->getPath() . '/.folderinfo')) {
			$folderInfo = Tx_Assets_Service_Yaml::decodeFile($category->getPath() . '/.folderinfo');
			$this->overrideCategoryWithFolderInfo($category, $folderInfo);
		}
	}
	
	/**
	 * Checks the given Infos and override category and assets infos.
	 * It allows also to override infos for SubCategories (array of infoSubCategories) and assets (array of infoAssets)
	 *
	 * @param Tx_Assets_Domain_Model_Category $category
	 * @return void
	 */
	protected function overrideCategoryWithFolderInfo(&$category, $info) {
		if (!is_string($category) && is_array($info['category'])) {
			foreach($info['category'] as $key => $value) {
				$function = 'set' . ucfirst($key);
				if (method_exists($category, $function)) {
					$category->$function($value);
				}
			}
		}
		
		$path = !is_string($category) ? $category->getPath() : $category;
		
		if (is_array($info['infoSubCategories'])) {
			foreach ($info['infoSubCategories'] as $yamlCategoryName => $yamlCategoryInfos) {
				if ($subCategory = $this->assetDirectoryRepository->findByPath($path . $yamlCategoryName . '/')) {
					$this->overrideCategoryWithFolderInfo($subCategory, $info['infoSubCategories'][$yamlCategoryName]);
				}
			}
		}
		
		if (is_array($info['infoAssets'])) {
			foreach ($info['infoAssets'] as $yamlAssetName => $yamlAssetInfos) {
				if ($asset = $this->assetFileRepository->findByFile($path . $yamlAssetName)) {
					foreach($yamlAssetInfos as $key => $value) {
						$function = 'set' . ucfirst($key);
						if (method_exists($asset, $function)) {
							$asset->$function($value);
						}
					}
				}
			}
		}
		
	}
	
	/**
	 * removes a Category form the repository and all it's subcategories and assets
	 *
	 * @return void
	 */
	protected function overrideWithFolderInfo() {
		$categories = $this->assetDirectoryRepository->findWithNoParent();
		foreach($categories as &$category) {
			$this->processCategory($category);
		}
		
		if (is_file($this->root . '/.folderinfo')) {
			$folderInfo = Tx_Assets_Service_Yaml::decodeFile($this->root . '/.folderinfo');
			$this->overrideCategoryWithFolderInfo($this->root, $folderInfo);
		}
	}
	
	/**
	 * @param string $searchWord 
	 * @return array of found assets and categories
	 */
	public function findSearchWord($searchWord) {
		$assets = $this->assetFileRepository->findSearchWord($searchWord);
		$categories = $this->assetDirectoryRepository->findSearchWord($searchWord);
		return array_merge($assets, $categories);
	}
	
	/**
	 * @param string $root 
	 * @return void
	 */
	public function setRoot($root) {
		$this->root = $root;
		$this->assetDirectoryRepository->setRoot($root);
		$this->assetFileRepository->setRoot($root);
	}	
	
	/**
	 * @param array $settings 
	 * @return void
	 */
	public function setSettings($settings) {
		$this->settings = $settings;
		$this->assetDirectoryRepository->setSettings($settings);
		$this->assetFileRepository->setSettings($settings);
	}

}
?>