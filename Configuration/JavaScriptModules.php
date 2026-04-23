<?php

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'dependencies' => [
        'core',
        'form',
        'rte_ckeditor',
    ],
    'tags' => [
        'backend.form',
    ],
    'imports' => [
        '@netbrothers-gmbh/typo3-base-template/' => 'EXT:nb_basetemplate/Resources/Public/JavaScript/ESM/',
    ],
];
