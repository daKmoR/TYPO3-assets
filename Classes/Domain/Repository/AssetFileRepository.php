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
 * Repository for Tx_Assets_Domain_Repository_AssetFileRepository
 */
class Tx_Assets_Domain_Repository_AssetFileRepository extends Tx_Assets_Domain_Repository_AssetPathRepository implements Tx_Extbase_Persistence_RepositoryInterface {

	/**
	 * inits the File Repository
	 *
	 * @return void
	 */
	public function init() {
		$this->objects = array();
		$files = t3lib_div::getFilesInDir($this->root);
		sort($files);
		$count = 0;
		foreach($files as $i => $file) {
			if ($file[0] === '.' && !$this->settings['showHidden']) {
				continue;
			}
			$file = $this->root . $file;
			$fileInfo = pathinfo($file);

			switch (strtolower($fileInfo['extension'])) {
				case 'gif':
				case 'png':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Image', $file);
					break;
				case 'jpg':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Jpg', $file);
					break;
				case 'doc':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Doc', $file);
					break;
				case 'xls':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Xls', $file);
					break;
				case 'pdf':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Pdf', $file);
					break;
				case 'zip':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Zip', $file);
					break;
				case 'mp3':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Mp3', $file);
					break;
				case 'url':
				case 'webloc':
				case 'desktop':
					$url = $this->getUrlFromFile($file);
					$urlDomain = $this->getUrlDomain($url);
					$asset = t3lib_div::makeInstance($urlDomain);
					$asset->setUrl($url);
					break;
				default:
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_File', $file);
			}
			
			$asset->setCreateDate(new DateTime('@' . filemtime($file)));
			$asset->setFileSize(filesize($file));
			$name = $fileInfo['filename'] ? $fileInfo['filename'] : $fileInfo['basename'];
			$asset->setName(utf8_encode($name));
			
			if ($this->settings['deleteLeadingNumbersInName']) {
				$asset->setName($this->deleteLeadingNumbers($asset->getName()));
			}
			if ($this->settings['underscoresToSpacesInName']) {
				$asset->setName(str_replace('_', ' ', $asset->getName()));
			}
			
			if (method_exists($asset, 'overrideWithMetaData')) {
				$asset->overrideWithMetaData();
			}
			
			$asset->setUid($count);
			$this->add($asset);
			$count++;
		}
	}
	
	/**
	 * finds an asset by a given file path
	 *
	 * @return Tx_Assets_Domain_Mode_Asset
	 */
	public function findByFile($file) {
		foreach($this->objects as $object) {
			if ($object->getFile() === $file) {
				return $object;
			}
		}
	}
	
	/**
	 * finds all assets without a category
	 *
	 * @return array
	 */
	public function findWithNoCategory() {
		$result = array();
		foreach($this->objects as $object) {
			if (!$object->getCategories()->toArray()) {
				array_push($result, $object);
			}
		}
		return $result;
	}
	
	/**
	 * @param string $searchWord 
	 * @return void
	 */
	public function findSearchWord($searchWord) {
		$result = array();
		foreach($this->objects as $object) {
			$propertiesToSearch = array('name', 'keywords', 'copyright');
			foreach ($propertiesToSearch as $propertyName) {
				$functionName = 'get' . ucfirst($propertyName);
				if (stripos($object->$functionName(), $searchWord) !== false) {
					$result[] = $object;
					break;
				}
			}
		}
		return $result;
	}	

	/**
	 * @return string single url
	 */
	public function getUrlFromFile($file) {
		$content = file_get_contents($file);
		preg_match_all("#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie", $content, $matches);
		// check for count, as within mac *.desktop the first match will be the xml deklaration
		return (count($matches[1]) === 1) ? $matches[1][0] : $matches[1][1];
	}

	/**
	 * @return domain model of url
	 */
	public function getUrlDomain($url) {
		if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
			return 'Tx_Assets_Domain_Model_Youtube';
		}
		return 'Tx_Assets_Domain_Model_Url';
	}

}
?>