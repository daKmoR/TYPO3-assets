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
 * Controller for the Asset object
 */
class Tx_Assets_Controller_AssetDirectoryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @return void
	 */
	public function initializeAction() {
		$this->settings = $this->settings['DisplayAssetsDirectories'];
		$this->root = $this->settings['root'];

		$this->assetDirectoryAndFileRepository = t3lib_div::makeInstance('Tx_Assets_Domain_Repository_AssetDirectoryAndFileRepository');
		$this->assetDirectoryAndFileRepository->setRoot($this->root);
		$this->assetDirectoryAndFileRepository->setSettings($this->settings);
		$this->assetDirectoryAndFileRepository->init();
	}

	/**
	 * @return void
	 */
	public function listAction() {
		$categories = $this->assetDirectoryAndFileRepository->assetDirectoryRepository->findWithNoParent();
		$assets = $this->assetDirectoryAndFileRepository->assetFileRepository->findWithNoCategory();

		$this->view->assign('categories', $categories);
		$this->view->assign('assets', $assets);

		if ($this->settings['templatePath'] != '') {
			$templateRootPath = t3lib_div::getFileAbsFileName($this->settings['templatePath']);
			$this->view->setTemplatePathAndFilename($templateRootPath);
		}
	}

}
?>