<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add content element group to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'nb_basetemplate',
    'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:theme_name',
    'after:default'
);
