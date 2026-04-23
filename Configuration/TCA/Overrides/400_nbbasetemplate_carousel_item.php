<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Activate T3EDITOR if extension is activated
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('t3editor')) {
    $GLOBALS['TCA']['tx_nbbasetemplate_carousel_item']['types']['html']['columnsOverrides'] = [
        'bodytext' => [
            'config' => [
                'renderType' => 't3editor',
                'wrap' => 'off',
                'format' => 'html',
            ],
        ],
    ];
}
