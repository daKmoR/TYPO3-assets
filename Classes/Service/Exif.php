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

require_once( dirname(__FILE__) . '/../../Resources/Private/PHP/pel/PelJpeg.php');

/**
 * ExifReader
 */
class Tx_Assets_Service_Exif {

	protected $pel;
	
	function __construct($file) {
		//$this->file = $file;
		$this->setFile($file);
	}

	public function init() {
		if ($this->file) {
			$this->pel = new PelJpeg($this->file);
		}
		if ($this->pel) {
			$this->exif = $this->pel->getExif();
		}
		if ($this->exif) {
			$this->tiff = $this->exif->getTiff();
		}
		if ($this->tiff) {
			$this->ifd0 = $this->tiff->getIfd();
		}
	}
	
	public function getDescription($file = null) {
		if ($this->setFile($file)) {
			return ($this->ifd0 && $description = $this->ifd0->getEntry(PelTag::IMAGE_DESCRIPTION)) ? $description->getValue() : '';
		}
		return '';
	}
	
	public function setFile($file) {
		if ($file && $file !== $this->file) {
			$this->file = $file;
			try {
				$this->init();
			}	catch(Exception $e)	{
				return false;
			}
		}
		return true;
	}

}
?>