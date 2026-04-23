<?php
declare(strict_types = 1);

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

#[UpgradeWizard(AccordionContentElementUpdate::class)]
class AccordionContentElementUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:nb_basetemplate: Migrate accordion content element';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    /**
     * @var string
     */
    protected $field = 'CType';

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createEqualStringCriteria($queryBuilder, $this->field, 'nb_basetemplate_accordion')];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createEqualStringCriteria($queryBuilder, $this->field, 'nb_basetemplate_accordion')];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                [$this->field => 'accordion']
            );
        }

        return true;
    }
}
