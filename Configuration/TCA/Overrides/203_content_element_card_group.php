<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['card_group'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['card_group'] = [];
}

// Add content element PageTSConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'nb_basetemplate',
    'Configuration/TsConfig/Page/ContentElement/Element/CardGroup.tsconfig',
    'TYPO3 Base Template Content Element: Card Group'
);

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:content_element.card_group',
        'description' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:content_element.card_group.description',
        'value' => 'card_group',
        'icon' => 'content-nbbasetemplate-card-group',
        'group' => 'nb_basetemplate',
    ],
    'audio',
    'after'
);

// Assign Icon
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['card_group'] = 'content-nbbasetemplate-card-group';

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['card_group'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['card_group'],
    [
        'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
            subitems_header_layout,
            tx_nbbasetemplate_card_group_item,
        --div--;LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:content_element.card_group.options,
            pi_flexform;LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:advanced,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
    ]
);

// Register fields
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'tx_nbbasetemplate_card_group_item' => [
            'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:card_group_item',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_nbbasetemplate_card_group_item',
                'foreign_field' => 'tt_content',
                'appearance' => [
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'expandSingle' => true,
                    'enabledControls' => [
                        'localize' => true,
                    ],
                ],
                'behaviour' => [
                    'mode' => 'select',
                ],
            ],
        ],
    ]
);

// Add flexForms for content element configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:nb_basetemplate/Configuration/FlexForms/CardGroup.xml',
    'card_group'
);
