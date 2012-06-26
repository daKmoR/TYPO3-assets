<?php

/*                                                                        *
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
 * This view helper implements an if/else condition, where multiple conditions can be supplied which will be placed as or to each other
 * @see Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode::convertArgumentValue() to find see how boolean arguments are evaluated
 *
 * <a:ifOr condition="{rank} > 100" condition1="{level} > 10">
 *   Will be shown if rank is > 100 or level is > 10
 * </a:ifOr>
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_Assets_ViewHelpers_IfOrViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractConditionViewHelper {

	/**
	 * renders <f:then> child if $condition is true, otherwise renders <f:else> child.
	 *
	 * @param boolean $condition View helper condition
	 * @param boolean $condition1 View helper condition
	 * @param boolean $condition2 View helper condition
	 * @param boolean $condition3 View helper condition
	 * @return string the rendered string
	 * @author Thomas Allmer <at@delusionworld.com>
	 */
	public function render($condition, $condition1 = false, $condition2 = false, $condition3 = false) {
		if ($condition || $condition1 || $condition2 || $condition3) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
}