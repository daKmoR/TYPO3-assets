<?php

########################################################################
# Extension Manager/Repository config file for ext "assets".
#
# Auto generated 30-11-2011 15:39
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Assets',
	'description' => 'based on extbase it lists your assets/files from a Database or a Directory Structure, usable for galleries, file directories, image databases... it can read basic metadata from pdf, jpg, doc, xls',
	'category' => 'fe',
	'author' => 'Thomas Allmer',
	'author_email' => 'at@delusionworld.com',
	'author_company' => '',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.2',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:93:{s:21:"ExtensionBuilder.json";s:4:"c03b";s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"0aa3";s:14:"ext_tables.php";s:4:"badc";s:14:"ext_tables.sql";s:4:"434d";s:38:"Classes/Controller/AssetController.php";s:4:"64d1";s:47:"Classes/Controller/AssetDirectoryController.php";s:4:"0b38";s:30:"Classes/Domain/Model/Asset.php";s:4:"5e9e";s:33:"Classes/Domain/Model/Category.php";s:4:"27d8";s:28:"Classes/Domain/Model/Doc.php";s:4:"3641";s:29:"Classes/Domain/Model/File.php";s:4:"aefc";s:30:"Classes/Domain/Model/Files.php";s:4:"a99a";s:29:"Classes/Domain/Model/Html.php";s:4:"5c24";s:30:"Classes/Domain/Model/Image.php";s:4:"5221";s:28:"Classes/Domain/Model/Jpg.php";s:4:"4621";s:28:"Classes/Domain/Model/Mp3.php";s:4:"4b3f";s:28:"Classes/Domain/Model/Pdf.php";s:4:"f641";s:38:"Classes/Domain/Model/StandardAsset.php";s:4:"c90b";s:29:"Classes/Domain/Model/Text.php";s:4:"ca7e";s:28:"Classes/Domain/Model/Url.php";s:4:"41ee";s:28:"Classes/Domain/Model/Xls.php";s:4:"8e01";s:32:"Classes/Domain/Model/Youtube.php";s:4:"1701";s:28:"Classes/Domain/Model/Zip.php";s:4:"c4cd";s:61:"Classes/Domain/Repository/AssetDirectoryAndFileRepository.php";s:4:"c613";s:54:"Classes/Domain/Repository/AssetDirectoryRepository.php";s:4:"5119";s:49:"Classes/Domain/Repository/AssetFileRepository.php";s:4:"f6b7";s:49:"Classes/Domain/Repository/AssetPathRepository.php";s:4:"bb60";s:45:"Classes/Domain/Repository/AssetRepository.php";s:4:"0e70";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"6597";s:45:"Classes/Domain/Repository/ImageRepository.php";s:4:"ff68";s:31:"Classes/Service/DocMetadata.php";s:4:"ccf0";s:24:"Classes/Service/Exif.php";s:4:"66ed";s:31:"Classes/Service/PdfMetadata.php";s:4:"3409";s:31:"Classes/Service/XlsMetadata.php";s:4:"6f1f";s:24:"Classes/Service/Yaml.php";s:4:"5166";s:46:"Classes/ViewHelpers/GetClassNameViewHelper.php";s:4:"00c7";s:52:"Classes/ViewHelpers/GroupedForDateTimeViewHelper.php";s:4:"20e6";s:41:"Classes/ViewHelpers/IsAudioViewHelper.php";s:4:"15a5";s:41:"Classes/ViewHelpers/IsImageViewHelper.php";s:4:"81e5";s:43:"Classes/ViewHelpers/IsYoutubeViewHelper.php";s:4:"46e8";s:49:"Classes/ViewHelpers/Format/DurationViewHelper.php";s:4:"2f64";s:49:"Classes/ViewHelpers/Format/FileSizeViewHelper.php";s:4:"fc2e";s:50:"Classes/ViewHelpers/Uri/FileDownloadViewHelper.php";s:4:"5dc3";s:51:"Classes/ViewHelpers/Uri/ImageDownloadViewHelper.php";s:4:"fcb5";s:61:"Configuration/FlexForms/flexform_displayassetsdirectories.xml";s:4:"a427";s:27:"Configuration/TCA/Asset.php";s:4:"b5da";s:30:"Configuration/TCA/Category.php";s:4:"0131";s:35:"Configuration/TCA/StandardAsset.php";s:4:"2d1c";s:38:"Configuration/TypoScript/constants.txt";s:4:"d41d";s:34:"Configuration/TypoScript/setup.txt";s:4:"86b6";s:40:"Resources/Private/Language/locallang.xml";s:4:"60e3";s:73:"Resources/Private/Language/locallang_csh_tx_assets_domain_model_asset.xml";s:4:"7a1d";s:76:"Resources/Private/Language/locallang_csh_tx_assets_domain_model_category.xml";s:4:"c002";s:81:"Resources/Private/Language/locallang_csh_tx_assets_domain_model_standardasset.xml";s:4:"33dc";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"c4bf";s:38:"Resources/Private/Layouts/Default.html";s:4:"06f8";s:46:"Resources/Private/Partials/Asset/AllTypes.html";s:4:"8604";s:43:"Resources/Private/Partials/Asset/Image.html";s:4:"333a";s:45:"Resources/Private/Partials/Asset/Youtube.html";s:4:"4645";s:33:"Resources/Private/PHP/pel/Pel.php";s:4:"79fd";s:40:"Resources/Private/PHP/pel/PelConvert.php";s:4:"9b6b";s:43:"Resources/Private/PHP/pel/PelDataWindow.php";s:4:"b773";s:38:"Resources/Private/PHP/pel/PelEntry.php";s:4:"526a";s:43:"Resources/Private/PHP/pel/PelEntryAscii.php";s:4:"e3b4";s:42:"Resources/Private/PHP/pel/PelEntryByte.php";s:4:"c25c";s:42:"Resources/Private/PHP/pel/PelEntryLong.php";s:4:"2194";s:44:"Resources/Private/PHP/pel/PelEntryNumber.php";s:4:"06ab";s:46:"Resources/Private/PHP/pel/PelEntryRational.php";s:4:"0c12";s:43:"Resources/Private/PHP/pel/PelEntryShort.php";s:4:"eaec";s:47:"Resources/Private/PHP/pel/PelEntryUndefined.php";s:4:"cb16";s:42:"Resources/Private/PHP/pel/PelException.php";s:4:"f7e8";s:37:"Resources/Private/PHP/pel/PelExif.php";s:4:"bccb";s:39:"Resources/Private/PHP/pel/PelFormat.php";s:4:"cba9";s:36:"Resources/Private/PHP/pel/PelIfd.php";s:4:"e3d1";s:37:"Resources/Private/PHP/pel/PelJpeg.php";s:4:"2cf7";s:44:"Resources/Private/PHP/pel/PelJpegComment.php";s:4:"c657";s:44:"Resources/Private/PHP/pel/PelJpegContent.php";s:4:"3920";s:43:"Resources/Private/PHP/pel/PelJpegMarker.php";s:4:"29f7";s:36:"Resources/Private/PHP/pel/PelTag.php";s:4:"a91b";s:37:"Resources/Private/PHP/pel/PelTiff.php";s:4:"722c";s:34:"Resources/Private/PHP/spyc/COPYING";s:4:"b098";s:33:"Resources/Private/PHP/spyc/README";s:4:"7d8a";s:35:"Resources/Private/PHP/spyc/spyc.php";s:4:"fcc5";s:36:"Resources/Private/PHP/spyc/spyc.yaml";s:4:"7bf9";s:43:"Resources/Private/Templates/Asset/List.html";s:4:"6eef";s:52:"Resources/Private/Templates/AssetDirectory/List.html";s:4:"6eef";s:44:"Resources/Public/Css/AssetDirectory/List.css";s:4:"4402";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:55:"Resources/Public/Icons/tx_assets_domain_model_asset.gif";s:4:"905a";s:58:"Resources/Public/Icons/tx_assets_domain_model_category.gif";s:4:"905a";s:62:"Resources/Public/Icons/tx_items_domain_model_standardasset.gif";s:4:"1103";s:32:"Tests/Domain/Model/AssetTest.php";s:4:"4ce3";s:35:"Tests/Domain/Model/CategoryTest.php";s:4:"4f0b";}',
);

?>