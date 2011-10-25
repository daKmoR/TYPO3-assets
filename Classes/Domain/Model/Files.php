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
 * Files
 */
abstract class Tx_Assets_Domain_Model_Files extends Tx_Assets_Domain_Model_Asset {
	
	/**
	 * @var string $file
	 */
	protected $file;

	/**
	 * @var float $fileSize
	 */
	protected $fileSize;
	
	/**
	 * @return void
	 */
	public function __construct($file = NULL) {
		$this->setFile($file);
		
		parent::__construct();
	}
	

	/**
	 * @return float $fileSize
	 */
	public function getFileSize() {
		return $this->fileSize;
	}

	/**
	 * @param float $fileSize
	 * @return void
	 */
	public function setFileSize($fileSize) {
		$this->fileSize = $fileSize;
	}

	/**
	 * @param string $file
	 * @return boolean successfull set or not a valid file
	 */
	public function setFile($file) {
		if (is_file($file)) {
			$this->file = $file;
			return true;
		}
		return false;
	}

	/**
	 * @return string
	 */
	public function getFile() {
		return $this->file;
	}
	
	/**
	 * @return string
	 */
	public function getFileName() {
		return pathinfo($this->getFile(), PATHINFO_BASENAME);
	}
	
	/**
	 * @return string
	 */
	public function getFileExtension() {
		return pathinfo($this->getFile(), PATHINFO_EXTENSION);
	}	

}
?>