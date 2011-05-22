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
 * Youtube
 */
class Tx_Assets_Domain_Model_Youtube extends Tx_Assets_Domain_Model_Url {

	/**
	 * @var string $youtubeId
	 */
	protected $youtubeId;

	/**
	 * @param string $youtubeId
	 * @return void
	 */
	public function setYoutubeId($youtubeId) {
		$this->youtubeId = $youtubeId;
	}

	/**
	 * @return string
	 */
	public function getYoutubeId() {
		if (!$this->youtubeId && $url = $this->getUrl()) {
			if (strpos($url, 'youtube.com') !== false) {
				$id = substr($url, strpos($url, 'v=')+2);
				$id = (strpos($id, '&') !== false) ? substr($id, 0, strpos($id, '&')) : $id;
			}
			if (strpos($url, 'youtu.be') !== false) {
				$id = substr($url, strrpos($url, '/')+1);
			}
			$this->setYoutubeId($id);
		}
		return $this->youtubeId;
	}
	
	/**
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
	
	
	// function fetchYouTubeData($youtubeId) {
		// $youtubeId = $youtubeId ? $youtubeId : $this->youtubeId;
		// $xml = file_get_contents('http://gdata.youtube.com/feeds/api/videos/' . $youtubeId);
		// $parsedXml = new SimpleXMLElement($xml);
		
		// if ($this->getName() === '') {
			// $this->setName((string)$parsedXml->title);
		// }
	// }
	
}
?>