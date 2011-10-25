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
 * Repository for Tx_Assets_Domain_Repository_AssetDirectoryRepository
 */
class Tx_Assets_Domain_Repository_AssetDirectoryRepository extends Tx_Assets_Domain_Repository_AssetPathRepository implements Tx_Extbase_Persistence_RepositoryInterface {
	
	/**
	 * inits the Diretory Repository
	 *
	 * @return void
	 */
	public function init() {
		$this->objects = array();
		$this->initDir($this->root);
	}
	
	/**
	 * Recursively inits the diretory and all sub directories
	 *
	 * @return void
	 */	
	protected function initDir($path, $parentCategory = NULL) {
		$dirs = t3lib_div::get_dirs($path);
		foreach($dirs as $dir) {
			$category = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Category');
			$category->setName($dir);
			if ($this->settings['deleteLeadingNumbersInName']) {
				$category->setName($this->deleteLeadingNumbers($category->getName()));
			}
			if ($this->settings['underscoresToSpacesInName']) {
				$category->setName(str_replace('_', ' ', $category->getName()));
			}
			$category->setPath($path . $dir . '/');
			if ($parentCategory) {
				$category->setParentCategory($parentCategory);
				$parentCategory->addSubCategory($category);
				$this->update($parentCategory);
			}
			$this->add($category);
			$this->initDir($path . $dir . '/', $category);
		}
	}
	
	/**
	 * finds all categories without a parent
	 *
	 * @return array list of categories without a parent
	 */
	public function findWithNoParent() {
		$result = array();
		foreach($this->objects as $object) {
			if (!$object->getParentCategory()) {
				array_push($result, $object);
			}
		}
		return $result;
	}
	
	/**
	 * Finds the directory for a given path
	 *
	 * @return Tx_Assets_Domain_Mode_Directory
	 */
	public function findByPath($path) {
		foreach($this->objects as $object) {
			if ($object->getPath() === $path) {
				return $object;
			}
		}
	}
	
	/**
	 * @param string $searchWord 
	 * @return void
	 */
	public function findSearchWord($searchWord) {
		$result = array();
		foreach($this->objects as $object) {
			$propertiesToSearch = array('name', 'description');
			foreach ($propertiesToSearch as $propertyName) {
				$functionName = 'get' . ucfirst($propertyName);
				if (stripos($object->$functionName(), $searchWord) !== false) {
					$result[] = $object;
					break;
				}
			}
		}
		return $result;
	}

}
?>