<?php
/*                                                                        *
 * This script belongs to the FLOW3 package "Assets".                     *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Formats a FileSize.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <f:format.fileSize>166.202</f:format.fileSize>
 * </code>
 * <output>
 * 162,31 KB
 * </output>
 *
 * <code title="Custom decimals">
 * <f:format.fileSize decimals="0">166.202</f:format.fileSize>
 * </code>
 * <output>
 * 160 KB
 * </output>
 *
 * <code title="Inline notation">
 * {f:format.fileSize(size: sizeObject)}
 * </code>
 * <output>
 * 1,28 GB
 * (depending on the value of {sizeObject})
 * </output>
 *
 * <code title="Inline notation (2nd variant)">
 * {sizeObject -> f:format.fileSize()}
 * </code>
 * <output>
 * 1,28 GB
 * (depending on the value of {sizeObject})
 * </output>
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 */
class Tx_Assets_ViewHelpers_Format_FileSizeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the supplied DateTime object as a formatted date.
	 *
	 * @param inte $size the byte size of a file
	 * @param string $sizes FileSize Formats
	 * @param int $decimals The number of digits after the decimal point
	 * @param string $decimalSeparator The decimal point character
	 * @param string $thousandsSeparator The character for grouping the thousand digits
	 * @return string Formatted date
	 * @author Thomas Allmer <at@delusionworld.com>
	 * @api
	 */
	public function render($size = NULL, $sizes = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'), $decimals = 2, $decimalSeparator = ',', $thousandsSeparator = '.') {
		if ($size === NULL) {
			$size = $this->renderChildren();
			if ($size === NULL) {
				return '';
			}
		}
		
		// code inspired by http://codebyte.dev7studios.com/post/1590919646/php-format-filesize
		if ($size == 0) {
			return('n/a');
		}
		$convertedSize = $size/pow(1024, ($i = floor(log($size, 1024))));
		return number_format($convertedSize, $decimals, $decimalSeparator, $thousandsSeparator) . ' ' . $sizes[$i];
	}
	
}
?>