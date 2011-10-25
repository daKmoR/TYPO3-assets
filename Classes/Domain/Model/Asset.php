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
 * Asset
 */
class Tx_Assets_Domain_Model_Asset extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * name
	 *
	 * @var string $name
	 */
	protected $name;

	/**
	 * caption
	 *
	 * @var string $caption
	 */
	protected $caption;

	/**
	 * alternateText
	 *
	 * @var string $alternateText
	 */
	protected $alternateText;

	/**
	 * description
	 *
	 * @var string $description
	 */
	protected $description;

	/**
	 * copyright
	 *
	 * @var string $copyright
	 */
	protected $copyright;
	
	/**
	 * @var string $keywords
	 */
	protected $keywords;	

	/**
	 * createDate
	 *
	 * @var DateTime $createDate
	 */
	protected $createDate;

	/**
	 * preview
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset> $preview
	 */
	protected $preview;

	/**
	 * categories
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Category> $categories
	 */
	protected $categories;
	
	/**
	 * allows to set the uid
	 *
	 * @var integer $uid
	 */	
	public function setUid($uid) {
		if ($uid !== NULL) {
			$this->uid = (int) $uid;
		}
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
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * @return string $copyright
	 */
	public function getCopyright() {
		return $this->copyright;
	}

	/**
	 * @param string $copyright
	 * @return void
	 */
	public function setCopyright($copyright) {
		$this->copyright = $copyright;
	}
	
	/**
	 * @return string $keywords
	 */
	public function getKeywords() {
		return $this->keywords;
	}

	/**
	 * @param string $keywords
	 * @return void
	 */
	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	/**
	 * Returns the createDate
	 *
	 * @return DateTime $createDate
	 */
	public function getCreateDate() {
		return $this->createDate;
	}

	/**
	 * Sets the createDate
	 *
	 * @param DateTime $createDate
	 * @return void
	 */
	public function setCreateDate($createDate) {
		$this->createDate = $createDate;
	}

	/**
	 * Adds a Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $preview
	 * @return void
	 */
	public function addPreview(Tx_Assets_Domain_Model_Asset $preview) {
		$this->preview->attach($preview);
	}

	/**
	 * Removes a Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $previewToRemove The Asset to be removed
	 * @return void
	 */
	public function removePreview(Tx_Assets_Domain_Model_Asset $previewToRemove) {
		$this->preview->detach($previewToRemove);
	}

	/**
	 * Returns the preview
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Asset> $preview
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
	public function setPreview($preview) {
		$this->preview = $preview;
	}

	/**
	 * Adds a Category
	 *
	 * @param Tx_Assets_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_Assets_Domain_Model_Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param Tx_Assets_Domain_Model_Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(Tx_Assets_Domain_Model_Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Assets_Domain_Model_Category> $categories
	 * @return void
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * Returns the caption
	 *
	 * @return string $caption
	 */
	public function getCaption() {
		return $this->caption;
	}

	/**
	 * Sets the caption
	 *
	 * @param string $caption
	 * @return void
	 */
	public function setCaption($caption) {
		$this->caption = $caption;
	}

	/**
	 * Returns the alternateText
	 *
	 * @return string $alternateText
	 */
	public function getAlternateText() {
		return $this->alternateText;
	}

	/**
	 * Sets the alternateText
	 *
	 * @param string $alternateText
	 * @return void
	 */
	public function setAlternateText($alternateText) {
		$this->alternateText = $alternateText;
	}

}
?>