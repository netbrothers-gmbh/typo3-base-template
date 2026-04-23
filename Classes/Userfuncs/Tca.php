<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Userfuncs;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class Tca
{
    public function timelineItemLabel(array &$parameters): void
    {
        if (!isset($parameters['table'])
            || $parameters['table'] !== 'tx_nbbasetemplate_timeline_item'
            || !isset($parameters['row']['uid'])) {
            return;
        }

        $record = BackendUtility::getRecord($parameters['table'], $parameters['row']['uid']) ?? [];
        $parameters['title'] = ($record['date'] ?? '') . ' - ' . ($record['header'] ?? '');
    }
}
