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
 * This ViewHelper checks if a given object is of type Tx_Assets_Domain_Model_Image
 *
 * = Examples =
 *
 * <code title="Show only if of type Tx_Assets_Domain_Model_Image">
 * <f:if condition="{objects -> a:isImage()}">
 *   show only if of type Tx_Assets_Domain_Model_Image
 * </f:if>
 * </code>
 * <output>
 * show only if of type Tx_Assets_Domain_Model_Image (depending on {object})
 * </output>
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 */
class Tx_Assets_ViewHelpers_IsImageViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Check if the object is an Asset Image
	 *
	 * @param object $subject The Object to check
	 * @return boolean Tx_Assets_Domain_Model_Image yes/no
	 * @author Thomas Allmer <at@delusionworld.com>
	 * @api
	 */
	public function render($subject = NULL) {
		if ($subject === NULL) {
			$subject = $this->renderChildren();
		}	
		if (is_object($subject) && get_class($subject) === 'Tx_Assets_Domain_Model_Image') {
			return true;
		}
		return false;
	}
}

?>