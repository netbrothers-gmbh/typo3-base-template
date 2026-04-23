<?php
declare(strict_types = 1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Updates\Criteria;

use Doctrine\DBAL\ArrayParameterType;

class InCriteria extends AbstractCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    protected $values = [];

    public function setValues(array $values): self
    {
        $this->values = $values;
        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function __toString(): string
    {
        return $this->queryBuilder->expr()->in(
            $this->getField(),
            $this->queryBuilder->createNamedParameter(
                $this->getValues(),
                ArrayParameterType::STRING
            )
        );
    }
}
