<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die('Access denied.');

$b13ContainerTcaRegistry = GeneralUtility::makeInstance(Registry::class);

$b13ContainerTcaRegistry->configureContainer(
    (
        new ContainerConfiguration(
            'container_1_columns',
            'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.container_1_columns.name',
            '',
            [
                [
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.middle',
                        'colPos' => 201,
                    ],
                ],
            ]
        )
    )->setIcon('EXT:nb_basetemplate/Resources/Public/Icons/ContentElements/container-columns-1.svg')
);
$b13ContainerTcaRegistry->configureContainer(
    (
        new ContainerConfiguration(
            'container_2_columns',
            'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.container_2_columns.name',
            '',
            [
                [
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.left',
                        'colPos' => 201,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.right',
                        'colPos' => 202,
                    ],
                ],
            ]
        )
    )->setIcon('EXT:nb_basetemplate/Resources/Public/Icons/ContentElements/container-columns-2.svg')
);
$b13ContainerTcaRegistry->configureContainer(
    (
        new ContainerConfiguration(
            'container_2_columns_right',
            'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.container_2_columns_right.name',
            '',
            [
                [
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.left',
                        'colspan' => 1,
                        'colPos' => 201,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.right',
                        'colspan' => 3,
                        'colPos' => 202,
                    ],
                ],
            ]
        )
    )->setIcon('EXT:nb_basetemplate/Resources/Public/Icons/ContentElements/container-columns-2-right.svg')
);
$b13ContainerTcaRegistry->configureContainer(
    (
        new ContainerConfiguration(
            'container_2_columns_left',
            'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.container_2_columns_left.name',
            '',
            [
                [
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.left',
                        'colspan' => 3,
                        'colPos' => 201,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.right',
                        'colspan' => 2,
                        'colPos' => 202,
                    ],
                ],
            ]
        )
    )->setIcon('EXT:nb_basetemplate/Resources/Public/Icons/ContentElements/container-columns-2-left.svg')
);
$b13ContainerTcaRegistry->configureContainer(
    (
        new ContainerConfiguration(
            'container_3_columns',
            'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.container_3_columns.name',
            '',
            [
                [
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.left',
                        'colPos' => 201,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.middle',
                        'colPos' => 203,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.right',
                        'colPos' => 202,
                    ],
                ],
            ]
        )
    )->setIcon('EXT:nb_basetemplate/Resources/Public/Icons/ContentElements/container-columns-3.svg')
);
$b13ContainerTcaRegistry->configureContainer(
    (
        new ContainerConfiguration(
            'container_4_columns',
            'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.container_4_columns.name',
            '',
            [
                [
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.left',
                        'colPos' => 201,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.middle_left',
                        'colPos' => 203,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.middle_right',
                        'colPos' => 204,
                    ],
                    [
                        'name' => 'LLL:EXT:nb_basetemplate/Resources/Private/Language/Backend.xlf:container.column.right',
                        'colPos' => 202,
                    ],
                ],
            ]
        )
    )->setIcon('EXT:nb_basetemplate/Resources/Public/Icons/ContentElements/container-columns-4.svg')
);
