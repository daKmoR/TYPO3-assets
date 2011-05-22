<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_assets_domain_model_asset'] = array(
	'ctrl' => $TCA['tx_assets_domain_model_asset']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, caption, alternate_text, description, file, url, content, copyright, width, height, prefered_width, prefered_height, file_size, create_date, preview, categories',
	),
	'types' => array(
		'0' => array('showitem' => 'record_type, name'),
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, name, caption, alternate_text, description, file, url, content, copyright, width, height, prefered_width, prefered_height, file_size, create_date, preview, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_Image' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, name, caption, alternate_text, description, file, copyright, width, height, prefered_width, prefered_height, file_size, create_date, preview, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_File' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, name, caption, alternate_text, description, file, copyright, width, height, prefered_width, prefered_height, file_size, create_date, preview, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_Text' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, name, caption, content, alternate_text, description, copyright, create_date, preview, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_Url' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, name, caption, url, alternate_text, description, copyright, create_date, preview, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
		'Tx_Assets_Domain_Model_Youtube' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, record_type, hidden;;1, name, caption, url, alternate_text, description, copyright, create_date, preview, categories,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
					array('File', 'Tx_Assets_Domain_Model_File'),
					array('Image', 'Tx_Assets_Domain_Model_Image'),
					array('Text', 'Tx_Assets_Domain_Model_Text'),
					array('Url', 'Tx_Assets_Domain_Model_Url'),
					array('Youtube', 'Tx_Assets_Domain_Model_Youtube'),
				),
				'default' => 'Tx_Assets_Domain_Model_Image',
			),
		),
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_assets_domain_model_asset',
				'foreign_table_where' => 'AND tx_assets_domain_model_asset.pid=###CURRENT_PID### AND tx_assets_domain_model_asset.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' =>array(
				'type' =>'passthrough',
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
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
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
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'caption' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.caption',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'alternate_text' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.alternate_text',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'file' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.file',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_assets',
				'allowed' => '*',
				'disallowed' => 'php',
				'size' => 5,
			),
		),
		'url' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'content' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.content',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'copyright' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.copyright',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'width' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.width',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'height' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'prefered_width' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.prefered_width',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'prefered_height' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.prefered_height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'file_size' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.file_size',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			),
		),
		'create_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.create_date',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'preview' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.preview',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_assets_domain_model_asset',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'categories' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:assets/Resources/Private/Language/locallang_db.xml:tx_assets_domain_model_asset.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_assets_domain_model_category',
				'MM' => 'tx_assets_asset_category_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=>'tx_assets_domain_model_category',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'category' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
?>