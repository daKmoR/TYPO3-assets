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

if (!class_exists('Spyc')) {
	require_once(dirname(__FILE__) . '/../../Resources/Private/PHP/spyc/spyc.php');
}

/**
 * Yaml reader
 */
class Tx_Assets_Service_Yaml {

	public static function decode($input){
		return Spyc::YAMLLoadString($input);
	}
	
	public static function decodeFile($file){
		return (file_exists($file)) ? self::decode(file_get_contents($file)) : null;
	}
	
	public static function encode($input){
		return Spyc::YAMLDump($input);
	}

}
?>