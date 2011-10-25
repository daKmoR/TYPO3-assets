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
 *
 *
 * @package assets
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Assets_Domain_Model_StandardAsset extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * overrideName
	 *
	 * @var string
	 */
	protected $overrideName;

	/**
	 * overrideDescription
	 *
	 * @var string
	 */
	protected $overrideDescription;

	/**
	 * overrideCopyright
	 *
	 * @var string
	 */
	protected $overrideCopyright;

	/**
	 * overrideCaption
	 *
	 * @var string
	 */
	protected $overrideCaption;

	/**
	 * asset
	 *
	 * @var Tx_Assets_Domain_Model_Asset
	 */
	protected $asset;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the overrideName
	 *
	 * @return string $overrideName
	 */
	public function getOverrideName() {
		return $this->overrideName;
	}

	/**
	 * Sets the overrideName
	 *
	 * @param string $overrideName
	 * @return void
	 */
	public function setOverrideName($overrideName) {
		$this->overrideName = $overrideName;
	}

	/**
	 * Returns the overrideDescription
	 *
	 * @return string $overrideDescription
	 */
	public function getOverrideDescription() {
		return $this->overrideDescription;
	}

	/**
	 * Sets the overrideDescription
	 *
	 * @param string $overrideDescription
	 * @return void
	 */
	public function setOverrideDescription($overrideDescription) {
		$this->overrideDescription = $overrideDescription;
	}

	/**
	 * Returns the overrideCopyright
	 *
	 * @return string $overrideCopyright
	 */
	public function getOverrideCopyright() {
		return $this->overrideCopyright;
	}

	/**
	 * Sets the overrideCopyright
	 *
	 * @param string $overrideCopyright
	 * @return void
	 */
	public function setOverrideCopyright($overrideCopyright) {
		$this->overrideCopyright = $overrideCopyright;
	}

	/**
	 * Returns the overrideCaption
	 *
	 * @return string $overrideCaption
	 */
	public function getOverrideCaption() {
		return $this->overrideCaption;
	}

	/**
	 * Sets the overrideCaption
	 *
	 * @param string $overrideCaption
	 * @return void
	 */
	public function setOverrideCaption($overrideCaption) {
		$this->overrideCaption = $overrideCaption;
	}

	/**
	 * Returns the asset
	 *
	 * @return Tx_Assets_Domain_Model_Asset $asset
	 */
	public function getAsset() {
		return $this->asset;
	}

	/**
	 * Sets the asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $asset
	 * @return void
	 */
	public function setAsset(Tx_Assets_Domain_Model_Asset $asset) {
		$this->asset = $asset;
	}

}
?>