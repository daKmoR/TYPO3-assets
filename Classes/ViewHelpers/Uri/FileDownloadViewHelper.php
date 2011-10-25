<?php

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/*
 * Modifies the url so it will point to an eID Script to download the given source with corrent mimetype
 *
 * = Examples =
 *
 * <code title="Default">
 * <a:uri.fileDownload src="EXT:myext/Resources/Public/typo3_logo.png" />
 * </code>
 * <output>
 * index.php?eID=pmkfdl&file=typo3conf/ext/myext/Resources/Public/typo3_logo.png&ck=[8cc56c943a97231f486a064be97de545]
 * (depending on your TYPO3s encryption key)
 * </output>
 *
 * <code title="Inline notation">
 * {f:uri.fileDownload(src: 'EXT:myext/Resources/Public/typo3_logo.png')}
 * </code>
 * <output>
 * index.php?eID=pmkfdl&file=typo3temp/pics/[b4c0e7ed5c].png&ck=[8cc56c943a97231f486a064be97de545]
 * (depending on your TYPO3s encryption key)
 * </output>
 */
 
require_once(t3lib_extMgm::extPath('pmkfdl').'class.tx_pmkfdl.php');
 
class Tx_Assets_ViewHelpers_Uri_FileDownloadViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Resizes the image (if required) and returns its path. If the image was not resized, the path will be equal to $src
	 * @see http://typo3.org/documentation/document-library/references/doc_core_tsref/4.2.0/view/1/5/#id4164427
	 *
	 * @param string $src
	 * @return string path to the file
	 * @author Bastian Waidelich <bastian@typo3.org>
	 * @author Christian Baer <chr.baer@googlemail.com>
	 */
	public function render($src) {
		$url = tx_pmkfdl::makeDownloadLink($src);
		return $url;
	}

}