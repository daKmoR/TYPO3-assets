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
			'Y' => array('Y', 'L', 'y', 'o'),
			'm' => array('F', 'm', 'M', 'n', 't'),
			'd' => array('d', 'D', 'j', 'l', 'N', 'S', 'W', 'z')
		);
		$allYearMonthDayFormats = array('Y', 'L', 'y', 'o', 'F', 'm', 'M', 'n', 't', 'd', 'D', 'j', 'l', 'N', 'S', 'W', 'z');
		$allTimeFormats = array('a', 'A', 'B', 'g', 'G', 'h', 'H', 'i', 's', 'u');

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

		// same day - show day once, time-duration if available
		if ($start->format('d.m.Y') === $end->format('d.m.Y')) {
			$timeFormat = $format;
			foreach($allYearMonthDayFormats as $formatPart) {
				$timeFormat = str_replace($formatPart, '', $timeFormat);
			}
			$timeFormat = str_replace(array('...', '..', '.', '///', '//', '/', ' '), array(''), $timeFormat);

			$yearMonthDayFormat = $format;
			foreach($allTimeFormats as $formatPart) {
				$yearMonthDayFormat = str_replace($formatPart, '', $yearMonthDayFormat);
			}
			$yearMonthDayFormat = str_replace(array(':', ' '), array('', ''), $yearMonthDayFormat);

			return $start->format($yearMonthDayFormat) . ' ' . $start->format($timeFormat) . $seperator . $end->format($timeFormat);
		}

		// separate days
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