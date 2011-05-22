<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'DisplayAssets',
	'Display Assets'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . display;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .display. '.xml');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'DisplayAssetsDirectories',
	'Display Assets from Directories'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . asset_directory;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .asset_directory. '.xml');






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

?>