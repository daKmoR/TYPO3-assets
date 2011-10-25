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
 * Resizes a given image (if required) and returns its relative path.
 *
 * = Examples =
 *
 * <code title="Default">
 * <a:uri.imageDownload src="EXT:myext/Resources/Public/typo3_logo.png" />
 * </code>
 * <output>
 * index.php?eID=pmkfdl&file=typo3conf/ext/myext/Resources/Public/typo3_logo.png&ck=[8cc56c943a97231f486a064be97de545]
 * (depending on your TYPO3s encryption key)
 * </output>
 *
 * <code title="Inline notation">
 * {a:uri.imageDownload(src: 'EXT:myext/Resources/Public/typo3_logo.png' minWidth: 30, maxWidth: 40)}
 * </code>
 * <output>
 * index.php?eID=pmkfdl&file=typo3temp/pics/[b4c0e7ed5c].png&ck=[8cc56c943a97231f486a064be97de545]
 * (depending on your TYPO3s encryption key)
 * </output>
 *
 * <code title="non existing image">
 * <a:uri.imageDownload src="NonExistingImage.png" />
 * </code>
 * <output>
 * Could not get image resource for "NonExistingImage.png".
 * </output>
 */
 
require_once(t3lib_extMgm::extPath('pmkfdl').'class.tx_pmkfdl.php');
 
class Tx_Assets_ViewHelpers_Uri_ImageDownloadViewHelper extends Tx_Fluid_ViewHelpers_Uri_ImageViewHelper {

	/**
	 * Resizes the image (if required) and returns its path. If the image was not resized, the path will be equal to $src
	 * @see http://typo3.org/documentation/document-library/references/doc_core_tsref/4.2.0/view/1/5/#id4164427
	 *
	 * @param string $src
	 * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
	 * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
	 * @param integer $minWidth minimum width of the image
	 * @param integer $minHeight minimum height of the image
	 * @param integer $maxWidth maximum width of the image
	 * @param integer $maxHeight maximum height of the image
	 * @return string path to the image
	 * @author Bastian Waidelich <bastian@typo3.org>
	 * @author Christian Baer <chr.baer@googlemail.com>
	 */
	public function render($src, $width = NULL, $height = NULL, $minWidth = NULL, $minHeight = NULL, $maxWidth = NULL, $maxHeight = NULL) {
		$imageSource = parent::render($src, $width, $height, $minWidth, $minHeight, $maxWidth, $maxHeight);
		$imageSource = tx_pmkfdl::makeDownloadLink($imageSource);
		return $imageSource;
	}

}