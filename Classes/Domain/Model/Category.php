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
 * Category
 */
class Tx_Assets_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * @var string $description
	 */
	protected $description;
	
	/**
	 * @var string $roles
	 */
	protected $roles;
	
	/**
	 * @var array $extras
	 */
	protected $extras;
	
	/**
	 * parentCategory
	 *
	 * @var Tx_Assets_Domain_Model_Category $parentCategory
	 */
	protected $parentCategory;

	/**
	 * preview
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset> $preview
	 */
	protected $preview;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset> $assets
	 */
	protected $assets;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Category> $subCategories
	 */
	protected $subCategories;	
	
	/**
	 * @var string $path
	 */
	protected $path;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->preview = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assets = new Tx_Extbase_Persistence_ObjectStorage();
		$this->subCategories = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param string $path
	 * @return void
	 */
	public function setPath($path) {
		$this->path = $path;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * @param string $roles
	 * @return void
	 */
	public function setRoles($roles) {
		$roles = is_string($roles) ? t3lib_div::trimExplode(',', $roles) : $roles;
		$this->roles = $roles;
	}

	/**
	 * @return string
	 */
	public function getRoles() {
		return $this->roles;
	}
	
	/**
	 * @param array $extras
	 * @return void
	 */
	public function setExtras($extras) {
		$this->extras = $extras;
	}

	/**
	 * @return array
	 */
	public function getExtras() {
		return $this->extras;
	}

	/**
	 * Returns the parentCategory
	 *
	 * @return Tx_Assets_Domain_Model_Category $parentCategory
	 */
	public function getParentCategory() {
		return $this->parentCategory;
	}

	/**
	 * Sets the parentCategory
	 *
	 * @param Tx_Assets_Domain_Model_Category $parentCategory
	 * @return void
	 */
	public function setParentCategory($parentCategory) {
		$this->parentCategory = $parentCategory;
	}

	/**
	 * Adds a Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset the Asset to be added
	 * @return void
	 */
	public function addPreview(Tx_Assets_Domain_Model_Asset $preview) {
		$this->preview->attach($preview);
	}

	/**
	 * Removes a Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset the Asset to be removed
	 * @return void
	 */
	public function removePreview(Tx_Assets_Domain_Model_Asset $previewToRemove) {
		$this->preview->detach($previewToRemove);
	}

	/**
	 * Returns the preview
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset>
	 */
	public function getPreview() {
		return $this->preview;
	}

	/**
	 * Sets the preview
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset> $preview
	 * @return void
	 */
	public function setPreview(Tx_Extbase_Persistence_ObjectStorage $preview) {
		$this->preview = $preview;
	}
	
	/**
	 * @param Tx_Assets_Domain_Model_Asset the Asset to be added
	 * @return void
	 */
	public function addAsset(Tx_Assets_Domain_Model_Asset $asset) {
		$this->assets->attach($asset);
	}

	/**
	 * @param Tx_Assets_Domain_Model_Asset the Asset to be removed
	 * @return void
	 */
	public function removeAsset(Tx_Assets_Domain_Model_Asset $assetToRemove) {
		$this->assets->detach($assetToRemove);
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset>
	 */
	public function getAssets() {
		return $this->assets;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset> $assets
	 * @return void
	 */
	public function setAssets(Tx_Extbase_Persistence_ObjectStorage $assets) {
		$this->assets = $assets;
	}
	
	/**
	 * @param Tx_Assets_Domain_Model_Category the Category to be added
	 * @return void
	 */
	public function addSubCategory(Tx_Assets_Domain_Model_Category $subCategory) {
		$this->subCategories->attach($subCategory);
	}

	/**
	 * @param Tx_Assets_Domain_Model_Category the Asset to be removed
	 * @return void
	 */
	public function removeSubCategory(Tx_Assets_Domain_Model_Category $subCategoryToRemove) {
		$this->subCategories->detach($subCategoryToRemove);
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Category>
	 */
	public function getSubCategories() {
		return $this->subCategories;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Category> $subCategories
	 * @return void
	 */
	public function setSubCategories(Tx_Extbase_Persistence_ObjectStorage $subCategories) {
		$this->subCategories = $subCategories;
	}

}
?>