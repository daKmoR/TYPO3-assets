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
*  the Free Software Foundation; either version 2 of the License, or
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
 * Testcase for class Tx_Assets_Domain_Model_Category.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Assets
 * 
 * @author Thomas Allmer <at@delusionworld.com>
 */
class Tx_Assets_Domain_Model_CategoryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Assets_Domain_Model_Category
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Assets_Domain_Model_Category();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getParentCategoryReturnsInitialValueForTx_Assets_Domain_Model_Category() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getParentCategory()
		);
	}

	/**
	 * @test
	 */
	public function setParentCategoryForTx_Assets_Domain_Model_CategorySetsParentCategory() { 
		$dummyObject = new Tx_Assets_Domain_Model_Category();
		$this->fixture->setParentCategory($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getParentCategory()
		);
	}
	
	/**
	 * @test
	 */
	public function getPreviewReturnsInitialValueForObjectStorageContainingTx_Assets_Domain_Model_Asset() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getPreview()
		);
	}

	/**
	 * @test
	 */
	public function setPreviewForObjectStorageContainingTx_Assets_Domain_Model_AssetSetsPreview() { 
		$preview = new Tx_Assets_Domain_Model_Asset();
		$objectStorageHoldingExactlyOnePreview = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOnePreview->attach($preview);
		$this->fixture->setPreview($objectStorageHoldingExactlyOnePreview);

		$this->assertSame(
			$objectStorageHoldingExactlyOnePreview,
			$this->fixture->getPreview()
		);
	}
	
	/**
	 * @test
	 */
	public function addPreviewToObjectStorageHoldingPreview() {
		$preview = new Tx_Assets_Domain_Model_Asset();
		$objectStorageHoldingExactlyOnePreview = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOnePreview->attach($preview);
		$this->fixture->addPreview($preview);

		$this->assertEquals(
			$objectStorageHoldingExactlyOnePreview,
			$this->fixture->getPreview()
		);
	}

	/**
	 * @test
	 */
	public function removePreviewFromObjectStorageHoldingPreview() {
		$preview = new Tx_Assets_Domain_Model_Asset();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($preview);
		$localObjectStorage->detach($preview);
		$this->fixture->addPreview($preview);
		$this->fixture->removePreview($preview);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getPreview()
		);
	}
	
}
?>