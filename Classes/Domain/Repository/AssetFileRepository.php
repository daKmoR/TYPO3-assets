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
 * Repository for Tx_Assets_Domain_Model_Asset
 */
class Tx_Assets_Domain_Repository_AssetFileRepository extends Tx_Assets_Domain_Repository_AssetPathRepository implements Tx_Extbase_Persistence_RepositoryInterface {
	
	/**
	 * inits 
	 *
	 * @return void
	 * @api
	 */
	public function init() {
		$this->objects = array();
		$files = t3lib_div::getFilesInDir($this->root);
		sort($files);
		$count = 0;
		foreach($files as $i => $file) {
			$file = $this->root . $file;
			$fileInfo = pathinfo($file);

			switch (strtolower($fileInfo['extension'])) {
				case 'jpg':
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Image');
					$exifService = t3lib_div::makeInstance('Tx_Assets_Service_Exif', $file);
					$asset->setName($exifService->getTitle());
					$asset->setCopyright($exifService->getAuthor());
					$asset->setImage($file);
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
					$asset = t3lib_div::makeInstance('Tx_Assets_Domain_Model_File');
					$asset->setFile($file);
			}
			
			if ($asset->getName() == '') {
				$asset->setName(utf8_encode($fileInfo['filename']));
			}
			$asset->setUid($count);
			$this->add($asset);
			$count++;
		}
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