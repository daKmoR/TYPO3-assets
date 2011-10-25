<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'DisplayAssets',
	array(
		'Asset' => 'list',
	),
	array(
		// 'Asset' => 'create, update, delete',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'DisplayAssetsDirectories',
	array(
		'AssetDirectory' => 'list',
	),
	array(
		// 'AssetDirectory' => 'create, update, delete',
	)
);

?>