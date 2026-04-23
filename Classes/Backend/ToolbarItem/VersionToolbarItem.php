<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Backend\ToolbarItem;

use TYPO3\CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent;
use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * VersionToolbarItem
 */
class VersionToolbarItem
{
    public function __invoke(SystemInformationToolbarCollectorEvent $event): void
    {
        $this->addVersionInformation($event->getToolbarItem());
    }

    /**
     * Called by the system information toolbar signal/slot dispatch.
     *
     * @param SystemInformationToolbarItem $systemInformation
     */
    public function addVersionInformation(SystemInformationToolbarItem $systemInformation): void
    {
        $value = null;
        $extensionDirectory = ExtensionManagementUtility::extPath('nb_basetemplate');

        // Try to get current version from git
        if (file_exists($extensionDirectory . '.git')) {
            $returnCode = 0;
            CommandUtility::exec('git --version', $_, $returnCode);
            if ((int)$returnCode === 0) {
                $currentDir = (string) getcwd();
                chdir($extensionDirectory);
                $tag = trim((string) CommandUtility::exec('git tag -l --points-at HEAD'));
                if ($tag !== '') {
                    $value = $tag;
                } else {
                    $branch = trim((string) CommandUtility::exec('git rev-parse --abbrev-ref HEAD'));
                    $revision = trim((string) CommandUtility::exec('git rev-parse --short HEAD'));
                    $value = $branch . ', ' . $revision;
                }
                chdir($currentDir);
            }
        }

        // Fallback to version from extension manager
        if ($value === null) {
            $value = ExtensionManagementUtility::getExtensionVersion('nb_basetemplate');
        }

        // Set system information entry
        $systemInformation->addSystemInformation(
            'NetBrothers TYPO3 Base Template',
            htmlspecialchars($value, ENT_QUOTES | ENT_HTML5),
            'systeminformation-nbbasetemplate'
        );
    }
}
