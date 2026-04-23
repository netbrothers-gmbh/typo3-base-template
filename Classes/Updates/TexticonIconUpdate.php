<?php
declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard(TexticonIconUpdate::class)]
class TexticonIconUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:nb_basetemplate: Migrate text and icon identifier and name';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createLikeCriteria($queryBuilder, 'icon', 'Ionicons%'),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria, AbstractUpdate::CONDITION_OR);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createLikeCriteria($queryBuilder, 'icon', 'Ionicons%'),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria, AbstractUpdate::CONDITION_OR);

        foreach ($records as $record) {
            $icon = explode('__', (string)($record['icon']));
            $this->updateRecord(
                (int) $record['uid'],
                [
                    'icon' => 'EXT:nb_basetemplate/Resources/Public/Images/Icons/' . $icon[0] . '/' . $icon[1] . '.svg',
                    'icon_set' => 'EXT:nb_basetemplate/Resources/Public/Images/Icons/' . $icon[0] . '/',
                ]
            );
        }

        return true;
    }
}
