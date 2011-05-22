<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'DisplayAssets',
	array(
		'Asset' => 'list, show, new, create, edit, update, delete',
		'Category' => 'list, show, new, create, edit, update, delete',
	),
	array(
		'Asset' => 'create, update, delete',
		'Category' => 'create, update, delete',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'DisplayAssetsDirectories',
	array(
		'AssetDirectory' => 'list, show, new, create, edit, update, delete',
	),
	array(
		'AssetDirectory' => 'create, update, delete',
	)
);

?>