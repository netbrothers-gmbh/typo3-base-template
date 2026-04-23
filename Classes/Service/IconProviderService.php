<?php
declare(strict_types = 1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Service;

use NetBrothers\TYPO3BaseTemplate\Events\ModifyIconProvidersEvent;
use NetBrothers\TYPO3BaseTemplate\Icons\IconProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final class IconProviderService
{
    public function __construct(
        #[AutowireIterator('nbTYPO3BaseTemplate.iconProvider')]
        private readonly iterable $iconProviders
    ) {
    }

    public function __invoke(ModifyIconProvidersEvent $event): void
    {
        $classList = [];
        $iconProviders = $event->getIconProviders();

        // add already registered class names to prevent duplicate registration
        array_walk($iconProviders, static function (IconProviderInterface $iconProvider) use (&$classList) {
            $classList[] = get_class($iconProvider);
        });

        /** @var IconProviderInterface $iconProvider */
        foreach ($this->iconProviders as $iconProvider) {
            $className = get_class($iconProvider);
            if (in_array($className, $classList, true)) {
                continue;
            }
            $iconProviders[] = $iconProvider;
            $classList[] = $className;
        }

        $event->setIconProviders($iconProviders);
    }
}
