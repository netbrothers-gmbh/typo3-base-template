<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Service;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Package\Event\AfterPackageActivationEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * BrandingService
 */
class BrandingService
{
    public function __invoke(AfterPackageActivationEvent $event): void
    {
        if ($event->getPackageKey() === 'nb_basetemplate') {
            $this->setBackendStyling();
        }
    }

    public function setBackendStyling(): void
    {
        if (class_exists(ExtensionConfiguration::class)) {
            $extensionConfiguration = GeneralUtility::makeInstance(
                ExtensionConfiguration::class
            );

            /** @var array $backendConfiguration */
            $backendConfiguration = $extensionConfiguration->get('backend');

            if (!isset($backendConfiguration['loginLogo']) || trim($backendConfiguration['loginLogo']) === '') {
                $backendConfiguration['loginLogo'] = 'EXT:nb_basetemplate/Resources/Public/Images/Backend/login-logo.svg';
            }
            if (!isset($backendConfiguration['loginBackgroundImage']) || trim($backendConfiguration['loginBackgroundImage']) === '') {
                $backendConfiguration['loginBackgroundImage'] = 'EXT:nb_basetemplate/Resources/Public/Images/Backend/login-background-image.jpg';
            }
            if (!isset($backendConfiguration['backendLogo']) || trim($backendConfiguration['backendLogo']) === '') {
                $backendConfiguration['backendLogo'] = 'EXT:nb_basetemplate/Resources/Public/Images/Backend/backend-logo.svg';
            }

            $extensionConfiguration->set('backend', $backendConfiguration);
        }
    }
}
