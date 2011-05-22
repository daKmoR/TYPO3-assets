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
	 * name
	 *
	 * @var string $name
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * description
	 *
	 * @var string $description
	 */
	protected $description;

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
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
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

}
?>