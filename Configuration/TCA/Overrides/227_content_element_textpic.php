<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add content element PageTSConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'nb_basetemplate',
    'Configuration/TsConfig/Page/ContentElement/Element/Textpic.tsconfig',
    'TYPO3 Base Template Content Element: Text and Images'
);

// Add additional fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'file_folder, filelink_sorting',
    'textpic',
    'after:image'
);
