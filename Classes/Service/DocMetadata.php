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
 * Microsoft Word 2003-2007 (*.doc) Meta Data Reader
 */
class Tx_Assets_Service_DocMetadata {

	function __construct($file) {
		$this->file = $file;
	}
	
	public function read($_file = NULL) {
		$file = $_file ? $_file : $this->file;
		$content = file_get_contents($file);
		$startToken = "\xE0\x85\x9F\xF2\xF9\x4F\x68\x10\xAB\x91\x08\x00\x2B\x27\xB3\xD9\x30\x00\x00\x00"; // E0 85 9F F2 F9 4F 68 10 AB 91 08 00 2B 27 B3 D9 30 00 00 00
		$start = strrpos($content, $startToken);
		
		if ($start !== false) {
			$start += 107;
		} else {
			return false;
		}
		
		$endToken = "\xFF\xFF\x00\x00"; // FF FF 00 00
		$end = strpos($content, $endToken, $start);
		if ($end === false) {
			$end = NULL;
		} else {
			$end = $end-$start;
		}
		
		$metaString = substr($content, $start, $end);
		$metaString = utf8_encode($metaString);
		
		foreach(explode("\x00", $metaString) as $metaData) {
			if (strlen(utf8_decode($metaData)) >= 3) {
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
	
	function getCreator() {
		return (string) $this->metaArray[2];
	}
	
	function getKeywords() {
		return (string) $this->metaArray[3];
	}
	
}
?>