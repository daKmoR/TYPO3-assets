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
 class Tx_Assets_Domain_Model_Html extends Tx_Assets_Domain_Model_Asset {

	/**
	 * html
	 *
	 * @var string $html
	 */
	protected $html;

	/**
	 * Returns the name
	 *
	 * @return string
	 */
	public function getName() {
		return 'html' . $this->name;
	}

	/**
	 * Sets the html
	 *
	 * @param string $html
	 * @return void
	 */
	public function setHtml($html) {
		$this->html = $html;
	}

	/**
	 * Returns the html
	 *
	 * @return string
	 */
	public function getHtml() {
		return $this->html;
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

}
?>