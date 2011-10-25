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
 * Image
 */
class Tx_Assets_Domain_Model_Image extends Tx_Assets_Domain_Model_Files {

	/**
	 * @var string $image
	 */
	protected $image;

	/**
	 * @var integer $width
	 */
	protected $width;

	/**
	 * @var integer $height
	 */
	protected $height;

	/**
	 * @var integer $preferedWidth
	 */
	protected $preferedWidth;

	/**
	 * @var integer $preferedHeight
	 */
	protected $preferedHeight;

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->file = $image;
	}

	/**
	 * @return string
	 */
	public function getImage() {
		return $this->file;
	}

	/**
	 * @return integer $width
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * @param integer $width
	 * @return void
	 */
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	 * @return integer $height
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * @param integer $height
	 * @return void
	 */
	public function setHeight($height) {
		$this->height = $height;
	}

	/**
	 * @return integer $preferedWidth
	 */
	public function getPreferedWidth() {
		return $this->preferedWidth;
	}

	/**
	 * @param integer $preferedWidth
	 * @return void
	 */
	public function setPreferedWidth($preferedWidth) {
		$this->preferedWidth = $preferedWidth;
	}

	/**
	 * @return integer $preferedHeight
	 */
	public function getPreferedHeight() {
		return $this->preferedHeight;
	}

	/**
	 * @param integer $preferedHeight
	 * @return void
	 */
	public function setPreferedHeight($preferedHeight) {
		$this->preferedHeight = $preferedHeight;
	}

}
?>