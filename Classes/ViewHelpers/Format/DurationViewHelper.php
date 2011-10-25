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
 * <a:format.duration start="{startDateObject}" end="{endDateObject}" />
 * </code>
 * <output>
 * 13. - 15.10.2011
 * 27.10. - 02.11.2011
 * (depending on the dates)
 * </output>
 *
 * <code title="Custom date format">
 * * <a:format.duration start="{startDateObject}" end="{endDateObject}" $format = 'd.F Y' />
 * </code>
 * <output>
 * 13. - 15.October 2011
 * 27.October - 02.November 2011
 * (depending on the dates)
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
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 */
class Tx_Assets_ViewHelpers_Format_DurationViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the supplied DateTime object as a formatted date.
	 *
	 * @param int $start DateTime
	 * @param int $end DateTime
	 * @param string $format 
	 * @param string $seperator
	 * @param array $compareFormat 
	 * @return string Formatted date
	 * @author Thomas Allmer <at@delusionworld.com>
	 * @api
	 */
	public function render($start = NULL, $end, $format = 'd.m.Y', $seperator = '–', $compareFormat = array('Y', 'm', 'd')) {
		$formatTable = array(
			'Y' => array('Y', 'Y', 'y', 'o'),
			'm' => array('F', 'm', 'M', 'n', 't')
		);
	
		if ($start === NULL) {
			$start = $this->renderChildren();
			if ($start === NULL) {
				return '';
			}
		}
		
		if ($end === NULL) {
			if (!$start instanceof DateTime) {
				try {
					$start = new DateTime($start);
				} catch (Exception $exception) {
					throw new Tx_Fluid_Core_ViewHelper_Exception('"' . $start . '" could not be parsed by DateTime constructor.', 1315842318);
				}
			}
			return $start->format($format);
		}
		
		if (!$end instanceof DateTime) {
			try {
				$end = new DateTime($end);
			} catch (Exception $exception) {
				throw new Tx_Fluid_Core_ViewHelper_Exception('"' . $end . '" could not be parsed by DateTime constructor.', 1315842318);
			}
		}
		
		$startFormat = $format;
		foreach($compareFormat as $formatPart) {
			if ($start->format($formatPart) === $end->format($formatPart)) {
				$startFormat = str_replace($formatTable[$formatPart], '', $startFormat);
			}
		}
		$startFormat = str_replace(array('...', '..', '///', '//'), array('.', '.', '/', '/'), $startFormat);
		
		return $start->format($startFormat) . $seperator . $end->format($format);
	}
	
}
?>