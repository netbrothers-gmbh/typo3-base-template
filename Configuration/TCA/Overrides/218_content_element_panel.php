<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['panel'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['panel'] = [];
}

// Add content element PageTSConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'nb_basetemplate',
    'Configuration/TsConfig/Page/ContentElement/Element/Panel.tsconfig',
    'TYPO3 Base Template Content Element: Panel'
);

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:content_element.panel',
        'description' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:content_element.panel.description',
        'value' => 'panel',
        'icon' => 'content-panel',
        'group' => 'nb_basetemplate',
    ],
    'menu_thumbnail_dir',
    'after'
);

// Assign Icon
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['panel'] = 'content-panel';

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['panel'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['panel'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header_minimal,
                bodytext,
                panel_class,
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
        'columnsOverrides' => [
            'bodytext' => [
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
                'config' => [
                    'enableRichtext' => true,
                ],
            ],
        ],
    ]
);

// Register fields
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'panel_class' => [
            'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:field.panel_class',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.default',
                        'value' => 'default',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.primary',
                        'value' => 'primary',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.secondary',
                        'value' => 'secondary',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.tertiary',
                        'value' => 'tertiary',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.quaternary',
                        'value' => 'quaternary',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.success',
                        'value' => 'success',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.info',
                        'value' => 'info',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.warning',
                        'value' => 'warning',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.danger',
                        'value' => 'danger',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.lighter',
                        'value' => 'lighter',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.light',
                        'value' => 'light',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.dark',
                        'value' => 'dark',
                    ],
                    [
                        'label' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:option.darker',
                        'value' => 'darker',
                    ],
                ],
            ],
        ],
    ]
);
