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
 * Repository for Tx_Assets_Domain_Model_Asset
 */
class Tx_Assets_Domain_Repository_AssetPathRepository implements Tx_Extbase_Persistence_RepositoryInterface {

	/**
	 * Root of this AssetDirectoryRepository
	 *
	 * @var string
	 */
	protected $root;
	
	/**
	 * Settings for this Repository
	 *
	 * @var string
	 */
	protected $settings;

	/**
	 * Objects of this repository
	 *
	 * @var array
	 */
	protected $objects;

	/**
	 * Objects removed but not found in $this->addedObjects at removal time
	 *
	 * @var array
	 */
	protected $removedObjects;
	
	/**
	 * Constructor
	 **/
	public function __construct($root = NULL, $settings = NULL) {
		$this->setRoot($root);
		if ($this->root) {
			$this->init();
		}
		if (is_array($settings)) {
			$this->setSettings($settings);
		}
	}
	
	/**
	 * @param string $root The Root Path to set
	 * @return void
	 */
	public function setRoot($root) {
		$this->root = $root;
	}
	
	/**
	 * @param array $settings 
	 * @return void
	 */
	public function setSettings($settings) {
		$this->settings = $settings;
	}
	
	/**
	 * @param array $settings 
	 * @return void
	 */
	public function deleteLeadingNumbers($string) {
		$pos = strpos($string, '_');
		if ($pos !== false) {
			if (is_numeric(substr($string, 0, $pos)) === true) {
				return substr($string, $pos+1);
			}
		}
		return $string;
	}
	
	/**
	 * inits 
	 *
	 * @return void
	 * @api
	 */
	public function init() {
		$this->objects = array();
		$dirs = t3lib_div::get_dirs($this->root);
		foreach($dirs as $dir) {
			$category = t3lib_div::makeInstance('Tx_Assets_Domain_Model_Category');
			$category->setName($dir);
			$this->add($category);
		}
	}	

	/**
	 * Adds an object to this repository.
	 *
	 * @param object $object The object to add
	 * @return void
	 * @api
	 */
	public function add($object) {
		return array_push($this->objects, $object);
	}

	/**
	 * Removes an object from this repository.
	 *
	 * @param object $object The object to remove
	 * @return void
	 * @api
	 */
	public function remove($object){
		$key = array_search($object, $this->objects);
		unset($this->objects[$key]);
	}

	/**
	 * Replaces an object by another.
	 *
	 * @param object $existingObject The existing object
	 * @param object $newObject The new object
	 * @return void
	 * @api
	 */
	public function replace($existingObject, $newObject) {
		array_splice();
	}

	/**
	 * Replaces an existing object with the same identifier by the given object
	 *
	 * @param object $modifiedObject The modified object
	 * @api
	 */
	public function update($modifiedObject) {
		foreach($this->objects as &$object) {
			if ($object->getPath() === $modifiedObject->getPath()) {
				$object = $modifiedObject;
				//TODO: we should be able to just return here?
			}
		}
	}

	/**
	 * Returns all objects of this repository add()ed but not yet persisted to
	 * the storage layer.
	 *
	 * @return array An array of objects
	 */
	public function getAddedObjects() {
		return;
	}

	/**
	 * Returns an array with objects remove()d from the repository that
	 * had been persisted to the storage layer before.
	 *
	 * @return array
	 */
	public function getRemovedObjects() {
		return;
	}

	/**
	 * Returns all objects of this repository.
	 *
	 * @return array An array of objects, empty if no objects found
	 * @api
	 */
	public function findAll() {
		return (array) $this->objects;
	}

	/**
	 * Returns the total number objects of this repository.
	 *
	 * @return integer The object count
	 * @api
	 */
	public function countAll() {
		return count($this->objects);
	}

	/**
	 * Removes all objects of this repository as if remove() was called for
	 * all of them.
	 *
	 * @return void
	 * @api
	 */
	public function removeAll() {
		return;
	}

	/**
	 * Finds an object matching the given identifier.
	 *
	 * @param int $uid The identifier of the object to find
	 * @return object The matching object if found, otherwise NULL
	 * @api
	 */
	public function findByUid($uid) {
		return;
	}

	/**
	 * Sets the property names to order the result by per default.
	 * Expected like this:
	 * array(
	 *  'foo' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
	 *  'bar' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
	 * )
	 *
	 * @param array $defaultOrderings The property names to order by
	 * @return void
	 * @api
	 */
	public function setDefaultOrderings(array $defaultOrderings) {
		return;
	}

	/**
	 * Sets the default query settings to be used in this repository
	 *
	 * @param Tx_Extbase_Persistence_QuerySettingsInterface $defaultQuerySettings The query settings to be used by default
	 * @return void
	 * @api
	 */
	public function setDefaultQuerySettings(Tx_Extbase_Persistence_QuerySettingsInterface $defaultQuerySettings) {
		return;
	}

	/**
	 * Returns a query for objects of this repository
	 *
	 * @return Tx_Extbase_Persistence_QueryInterface
	 * @api
	 */
	public function createQuery() {
		return;
	}

}
?>