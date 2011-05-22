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
 * Testcase for class Tx_Assets_Domain_Model_Asset.
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
class Tx_Assets_Domain_Model_AssetTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Assets_Domain_Model_Asset
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Assets_Domain_Model_Asset();
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
	public function getCaptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCaptionForStringSetsCaption() { 
		$this->fixture->setCaption('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCaption()
		);
	}
	
	/**
	 * @test
	 */
	public function getAlternateTextReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAlternateTextForStringSetsAlternateText() { 
		$this->fixture->setAlternateText('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAlternateText()
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
	public function getFileReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFileForStringSetsFile() { 
		$this->fixture->setFile('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFile()
		);
	}
	
	/**
	 * @test
	 */
	public function getUrlReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setUrlForStringSetsUrl() { 
		$this->fixture->setUrl('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getUrl()
		);
	}
	
	/**
	 * @test
	 */
	public function getContentReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setContentForStringSetsContent() { 
		$this->fixture->setContent('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getContent()
		);
	}
	
	/**
	 * @test
	 */
	public function getCopyrightReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCopyrightForStringSetsCopyright() { 
		$this->fixture->setCopyright('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCopyright()
		);
	}
	
	/**
	 * @test
	 */
	public function getWidthReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getWidth()
		);
	}

	/**
	 * @test
	 */
	public function setWidthForIntegerSetsWidth() { 
		$this->fixture->setWidth(12);

		$this->assertSame(
			12,
			$this->fixture->getWidth()
		);
	}
	
	/**
	 * @test
	 */
	public function getHeightReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getHeight()
		);
	}

	/**
	 * @test
	 */
	public function setHeightForIntegerSetsHeight() { 
		$this->fixture->setHeight(12);

		$this->assertSame(
			12,
			$this->fixture->getHeight()
		);
	}
	
	/**
	 * @test
	 */
	public function getPreferedWidthReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPreferedWidth()
		);
	}

	/**
	 * @test
	 */
	public function setPreferedWidthForIntegerSetsPreferedWidth() { 
		$this->fixture->setPreferedWidth(12);

		$this->assertSame(
			12,
			$this->fixture->getPreferedWidth()
		);
	}
	
	/**
	 * @test
	 */
	public function getPreferedHeightReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPreferedHeightForStringSetsPreferedHeight() { 
		$this->fixture->setPreferedHeight('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPreferedHeight()
		);
	}
	
	/**
	 * @test
	 */
	public function getFileSizeReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getFileSize()
		);
	}

	/**
	 * @test
	 */
	public function setFileSizeForFloatSetsFileSize() { 
		$this->fixture->setFileSize(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getFileSize()
		);
	}
	
	/**
	 * @test
	 */
	public function getCreateDateReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setCreateDateForDateTimeSetsCreateDate() { }
	
	/**
	 * @test
	 */
	public function getPreviewReturnsInitialValueForTx_Assets_Domain_Model_Asset() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getPreview()
		);
	}

	/**
	 * @test
	 */
	public function setPreviewForTx_Assets_Domain_Model_AssetSetsPreview() { 
		$dummyObject = new Tx_Assets_Domain_Model_Asset();
		$this->fixture->setPreview($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getPreview()
		);
	}
	
	/**
	 * @test
	 */
	public function getCategoriesReturnsInitialValueForObjectStorageContainingTx_Assets_Domain_Model_Category() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function setCategoriesForObjectStorageContainingTx_Assets_Domain_Model_CategorySetsCategories() { 
		$category = new Tx_Assets_Domain_Model_Category();
		$objectStorageHoldingExactlyOneCategories = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCategories->attach($category);
		$this->fixture->setCategories($objectStorageHoldingExactlyOneCategories);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCategories,
			$this->fixture->getCategories()
		);
	}
	
	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategories() {
		$category = new Tx_Assets_Domain_Model_Category();
		$objectStorageHoldingExactlyOneCategory = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCategory->attach($category);
		$this->fixture->addCategory($category);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCategory,
			$this->fixture->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategories() {
		$category = new Tx_Assets_Domain_Model_Category();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($category);
		$localObjectStorage->detach($category);
		$this->fixture->addCategory($category);
		$this->fixture->removeCategory($category);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCategories()
		);
	}
	
}
?>