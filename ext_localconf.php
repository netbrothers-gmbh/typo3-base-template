<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Define TypoScript as content rendering template
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'nbbasetemplate/Configuration/TypoScript/';
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'nbbasetemplate/Configuration/TypoScript/ContentElement/';

// Make the extension configuration accessible
$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);

// Register custom EXT:form configuration
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
        module.tx_form {
            settings {
                yamlConfigurations {
                    110 = EXT:nb_basetemplate/Configuration/Form/Setup.yaml
                }
            }
        }
        plugin.tx_form {
            settings {
                yamlConfigurations {
                    110 = EXT:nb_basetemplate/Configuration/Form/Setup.yaml
                }
            }
        }
    '));
}

// Add default RTE configuration for base template
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bootstrap'] = 'EXT:nb_basetemplate/Configuration/RTE/Default.yaml';

// Register "nb" as global fluid namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['nb'][] = 'NetBrothers\\TYPO3BaseTemplate\\ViewHelpers';

// Register "icon" wizard
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1687516916] = [
    'nodeName' => 'iconWizard',
    'priority' => 40,
    'class' => \NetBrothers\TYPO3BaseTemplate\Form\FieldWizard\IconWizard::class,
];
