<?php

declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Events;

use NetBrothers\TYPO3BaseTemplate\Icons\IconProviderInterface;

final class ModifyIconProvidersEvent
{
    /**
     * @param IconProviderInterface[] $iconProviders
     */
    public function __construct(
        private array $iconProviders,
    ) {
    }

    /**
     * @return IconProviderInterface[]
     */
    public function getIconProviders(): array
    {
        return $this->iconProviders;
    }

    /**
     * @param IconProviderInterface[] $iconProviders
     */
    public function setIconProviders(array $iconProviders): void
    {
        $this->iconProviders = $iconProviders;
    }
}
