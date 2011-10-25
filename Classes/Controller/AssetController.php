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
 class Tx_Assets_Controller_AssetController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * assetRepository
	 *
	 * @var Tx_Assets_Domain_Repository_AssetRepository
	 */
	protected $assetRepository;

	/**
	 * imageRepository
	 *
	 * @var Tx_Assets_Domain_Repository_ImageRepository
	 */
	protected $imageRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->assetRepository = t3lib_div::makeInstance('Tx_Assets_Domain_Repository_AssetRepository');
		//$this->imageRepository = t3lib_div::makeInstance('Tx_Assets_Domain_Repository_ImageRepository');
	}

	/**
	 * Displays all Assets
	 *
	 * @return void
	 */
	public function listAction() {
		//$this->assetRepository->setDefaultOrderings(array('sorting' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING));
		$assets = $this->assetRepository->findAll();
		//$assets = $this->imageRepository->findAll();
		
		$this->view->assign('assets', $assets);
	}

	/**
	 * Displays a single Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $asset the Asset to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Assets_Domain_Model_Asset $asset) {
		$this->view->assign('asset', $asset);
	}

	/**
	 * Displays a form for creating a new  Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $newAsset a fresh Asset object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newAsset
	 */
	public function newAction(Tx_Assets_Domain_Model_Asset $newAsset = null) {
		$this->view->assign('newAsset', $newAsset);
	}

	/**
	 * Creates a new Asset and forwards to the list action.
	 *
	 * @param Tx_Assets_Domain_Model_Asset $newAsset a fresh Asset object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Assets_Domain_Model_Asset $newAsset) {
		$this->assetRepository->add($newAsset);
		$this->flashMessageContainer->add('Your new Asset was created.');
		
			
			if(!empty($_FILES)){
				$this->flashMessageContainer->add('File upload is not yet supported by the Persistence Manager. You have to implement it yourself.');
			}
			
		$this->redirect('list');
	}

	/**
	 * Displays a form for editing an existing Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $asset the Asset to display
	 * @return string A form to edit a Asset
	 */
	public function editAction(Tx_Assets_Domain_Model_Asset $asset) {
		$this->view->assign('asset', $asset);
	}

	/**
	 * Updates an existing Asset and forwards to the list action afterwards.
	 *
	 * @param Tx_Assets_Domain_Model_Asset $asset the Asset to display
	 * @return 
	 */
	public function updateAction(Tx_Assets_Domain_Model_Asset $asset) {
		$this->assetRepository->update($asset);
		$this->flashMessageContainer->add('Your Asset was updated.');
		$this->redirect('list');
	}

	/**
	 * Deletes an existing Asset
	 *
	 * @param Tx_Assets_Domain_Model_Asset $asset the Asset to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Assets_Domain_Model_Asset $asset) {
		$this->assetRepository->remove($asset);
		$this->flashMessageContainer->add('Your Asset was removed.');
		$this->redirect('list');
	}

}
?>