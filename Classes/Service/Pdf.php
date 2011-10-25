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
 * PDF Meta Data Reader
 */
class Tx_Assets_Service_Pdf {

	var $encodeArray = array('<rdf:', '</rdf:', '<dc:', '</dc:', '<pdf:', '</pdf:');
	var $decodeArray = array('<rdf_', '</rdf_', '<dc_', '</dc_', '<pdf_', '</pdf_');

	function __construct($file) {
		$content = file_get_contents($file);
		
		$start = strrpos($content, '<x:xmpmeta');
		$metaString = substr($content, $start, strrpos($content, '/x:xmpmeta>')-$start+12);
		$metaString = $this->decodeMeta($metaString);
		
		$this->metaXml = new SimpleXMLElement($metaString);
	}
	
	function decodeMeta($string) {
		return str_replace($this->encodeArray, $this->decodeArray, $string);
	}
	
	function encodeMeta($string) {
		//$this->encodeMeta($this->metaXml->asXML())
		return str_replace($this->decodeArray, $this->encodeArray, $string);
	}
	
	function getTitle() {
		return (string) $this->metaXml->rdf_RDF->rdf_Description[2]->dc_title->rdf_Alt->rdf_li;
	}
	
	function getCreator() {
		return (string) $this->metaXml->rdf_RDF->rdf_Description[2]->dc_creator->rdf_Seq->rdf_li;
	}
	
	function getDescription() {
		return (string) $this->metaXml->rdf_RDF->rdf_Description[2]->dc_description->rdf_Alt->rdf_li;
	}
	
	function getKeywords() {
		return (string) $this->metaXml->rdf_RDF->rdf_Description[0]->pdf_Keywords;
	}
	
}
?>