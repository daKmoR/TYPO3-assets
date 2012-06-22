<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);

$configurationArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
$configurationArray['manualSorting'] = 1;

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'DisplayAssets',
	'Display Assets'
);
// $pluginSignature = strtolower($extensionName) . '_displayassets';
// $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
// t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_displayassets.xml');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'DisplayAssetsDirectories',
	'Display Assets from Directories'
);
$pluginSignature = strtolower($extensionName) . '_displayassetsdirectories';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_displayassetsdirectories.xml');


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Assets');


t3lib_extMgm::addLLrefForTCAdescr('tx_assets_domain_model_asset', 'EXT:assets/Resources/Private/Language/locallang_csh_tx_assets_domain_model_asset.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_assets_domain_model_asset');
$TCA['tx_assets_domain_model_asset'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset',
		'label' 			=> 'name',
		'type'				=> 'record_type',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'default_sortby' => 'ORDER BY name',
#		'sortby' => ($configurationArray['manualSorting'] == 1 ? 'sorting' : 'name'),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Asset.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_assets_domain_model_asset.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_assets_domain_model_category', 'EXT:assets/Resources/Private/Language/locallang_csh_tx_assets_domain_model_category.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_assets_domain_model_category');
$TCA['tx_assets_domain_model_category'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_category',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_assets_domain_model_category.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_assets_domain_model_standardasset', 'EXT:assets/Resources/Private/Language/locallang_csh_tx_assets_domain_model_standardasset.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_assets_domain_model_standardasset');
$TCA['tx_assets_domain_model_standardasset'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset',
		'label' => 'asset',
		'type' => 'record_type',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'default_sortby' => 'ORDER BY crdate',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/StandardAsset.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_items_domain_model_standardasset.gif'
	),
);

?>