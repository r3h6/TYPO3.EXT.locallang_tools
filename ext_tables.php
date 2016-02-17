<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'R3H6.' . $_EXTKEY,
		'user',	 // Make module a submodule of 'user'
		'locallang',	// Submodule key
		'',						// Position
		array(
			'Locallang' => 'list, update, delete',

		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_locallang.xlf',
		)
	);

}