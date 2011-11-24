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
 * Microsoft Excel 2003-2007 (*.xls) Meta Data Reader
 */
class Tx_Assets_Service_XlsMetadata {

	function __construct($file) {
		$this->file = $file;
	}
	
	public function read($_file = NULL) {
		$file = $_file ? $_file : $this->file;
		$content = file_get_contents($file);
		
		$endToken = "\x00\x00\x1E\x00\x00\x00\x10\x00\x00\x00"; // 00 00 1E 00 00 00 10 00 00 00
		$end = strrpos($content, $endToken);
		if ($end === false) {
			return false;
		}
		
		$startToken = "\xE4\x04\x00\x00\x1E\x00\x00"; // E4 04 00 00 1E 00 00
		$start = strrpos($content, $startToken, (strlen($content)-$end)*-1)+10;
		if ($start === false) {
			return false;
		}
		
		$metaString = substr($content, $start, $end-$start);
		$metaString = utf8_encode($metaString);
		
		foreach(explode("\x00", $metaString) as $metaData) {
			if (strlen($metaData) >= 2) {
				$this->metaArray[] = $metaData;
			}
		}
		return true;
	}
	
	function getTitle() {
		return (string) $this->metaArray[0];
	}
	
	function getSubject() {
		return (string) $this->metaArray[1];
	}
	
	function getAuthor() {
		return (string) $this->metaArray[2];
	}
	
	function getKeywords() {
		return (string) $this->metaArray[3];
	}

	function getCreator() {
		return (string) $this->metaArray[4];
	}
	
}
?>