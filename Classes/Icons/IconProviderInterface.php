<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Icons;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/**
 * IconProviderInterface
 */
#[AutoconfigureTag('nbTYPO3BaseTemplate.iconProvider')]
interface IconProviderInterface
{
    /**
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $identifier
     * @return bool
     */
    public function supports(string $identifier): bool;

    /**
     * @return IconList
     */
    public function getIconList(): IconList;
}
