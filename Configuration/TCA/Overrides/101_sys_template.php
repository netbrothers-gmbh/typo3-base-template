<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

/***************
 * TypoScript Include
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'nb_basetemplate',
    'Configuration/TypoScript',
    'NetBrothers TYPO3 Base Template'
);
