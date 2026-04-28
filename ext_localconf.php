<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

/*
 * Register custom EXT:form configuration
 * See https://docs.typo3.org/c/typo3/cms-form/13.4/en-us/I/Concepts/Configuration/Index.html
 * Since we have to load the TypoScript for the backend (`module.tx_form`) here
 * anyways, we can also load the frontend TypoScript (`plugin.tx_form`) here.
 *
 * NOTE: Auto-discovery is available beginning with TYPO3 v14.2. See
 * https://docs.typo3.org/c/typo3/cms-form/14.2/en-us/I/Concepts/Configuration/Index.html
 * for details.
 *
 * NOTE: Also beginning with TYPO3 v14.2 backend and frontend configuration is
 * centralised in the form set: "All configuration is placed in a single
 * config.yaml per form set and is loaded for both frontend and backend."
 *
 * TODO v14 Use auto-discovery and combined config, when available.
 */
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
        <<<'TYPOSCRIPT'
        plugin.tx_form {
            settings {
                yamlConfigurations {
                    1777380058 = EXT:nb_basetemplate/Configuration/Form/Setup.yaml
                }
            }
        }
        module.tx_form {
            settings {
                yamlConfigurations {
                    1777380058 = EXT:nb_basetemplate/Configuration/Form/Setup.yaml
                }
            }
        }
        TYPOSCRIPT
    );
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
