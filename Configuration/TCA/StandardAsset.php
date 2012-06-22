<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_assets_domain_model_standardasset'] = array(
	'ctrl' => $TCA['tx_assets_domain_model_standardasset']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, use_in_preview, add_as_download, override_name, override_description, override_copyright, override_caption, asset',
	),
	'types' => array(
		'0' => array('showitem' => 'record_type, asset'),
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, use_in_preview, add_as_download, override_name, override_description, override_copyright, override_caption, asset,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_StandardAsset' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, override_name, override_description, override_copyright, override_caption, asset,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_ItemAsset' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, use_in_preview, add_as_download, override_name, override_description, override_copyright, override_caption, asset,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'record_type' => array(
			'label' => 'Asset Type',
			'config' => array(
				'type' => 'select',
				'size' => 1,
				'items' => array(
					array('undefined', -1),
					array('Standard Asset', 'Tx_Assets_Domain_Model_StandardAsset'),
					array('Item Asset', 'Tx_Assets_Domain_Model_ItemAsset'),
				),
				'default' => 'Tx_Assets_Domain_Model_StandardAsset',
			),
		),
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_assets_domain_model_standardasset',
				'foreign_table_where' => 'AND tx_assets_domain_model_standardasset.pid=###CURRENT_PID### AND tx_assets_domain_model_standardasset.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'use_in_preview' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.use_in_preview',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'add_as_download' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.add_as_download',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'override_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.override_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'override_description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.override_description',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'override_copyright' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.override_copyright',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'override_caption' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.override_caption',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'asset' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_standardasset.asset',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_assets_domain_model_asset',
				'foreign_table_where' => 'AND 1 = 1 ORDER BY tx_assets_domain_model_asset.name',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'item' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
?>