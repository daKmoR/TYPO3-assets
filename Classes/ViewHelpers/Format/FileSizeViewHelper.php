<?php

/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
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
 * Formats a DateTime object.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <f:format.date>{dateObject}</f:format.date>
 * </code>
 * <output>
 * 1980-12-13
 * (depending on the current date)
 * </output>
 *
 * <code title="Custom date format">
 * <f:format.date format="H:i">{dateObject}</f:format.date>
 * </code>
 * <output>
 * 01:23
 * (depending on the current time)
 * </output>
 *
 * <code title="Localized dates using strftime date format">
 * <f:format.date format="%d. %B %Y">{dateObject}</f:format.date>
 * </code>
 * <output>
 * 13. Dezember 1980
 * (depending on the current date and defined locale. In the example you see the 1980-12-13 in a german locale)
 * </output>
 *
 * <code title="strtotime string">
 * <f:format.date format="d.m.Y - H:i:s">+1 week 2 days 4 hours 2 seconds</f:format.date>
 * </code>
 * <output>
 * 13.12.1980 - 21:03:42
 * (depending on the current time, see http://www.php.net/manual/en/function.strtotime.php)
 * </output>
 *
 * <code title="output date from unix timestamp">
 * <f:format.date format="d.m.Y - H:i:s">@{someTimestamp}</f:format.date>
 * </code>
 * <output>
 * 13.12.1980 - 21:03:42
 * (depending on the current time. Don't forget the "@" in front of the timestamp see http://www.php.net/manual/en/function.strtotime.php)
 * </output>
 *
 * <code title="Inline notation">
 * {f:format.date(date: dateObject)}
 * </code>
 * <output>
 * 1980-12-13
 * (depending on the value of {dateObject})
 * </output>
 *
 * <code title="Inline notation (2nd variant)">
 * {dateObject -> f:format.date()}
 * </code>
 * <output>
 * 1980-12-13
 * (depending on the value of {dateObject})
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
    if ($size == 0) return('n/a');
		$convertedSize = $size/pow(1024, ($i = floor(log($size, 1024))));
    return number_format($convertedSize, $decimals, $decimalSeparator, $thousandsSeparator) . ' ' . $sizes[$i];
	}
	
}
?>