<?php
declare(strict_types = 1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Icons;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * IoniconsProvider
 */
class IoniconsProvider implements IconProviderInterface
{
    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'EXT:nb_basetemplate/Resources/Public/Images/Icons/Ionicons/';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Ionicons';
    }

    /**
     * @param string $identifier
     * @return bool
     */
    public function supports(string $identifier): bool
    {
        return 'EXT:nb_basetemplate/Resources/Public/Images/Icons/Ionicons/' === $identifier;
    }

    /**
     * @return IconList
     */
    public function getIconList(): IconList
    {
        $icons = new IconList();

        $directory = 'EXT:nb_basetemplate/Resources/Public/Images/Icons/Ionicons/';
        $path = GeneralUtility::getFileAbsFileName($directory);
        $files = iterator_to_array(new \FilesystemIterator($path, \FilesystemIterator::KEY_AS_PATHNAME));
        ksort($files);

        foreach ($files as $key => $fileinfo) {
            if ($fileinfo instanceof \SplFileInfo
                && $fileinfo->isFile()
                && strtolower($fileinfo->getExtension()) === 'svg'
            ) {
                $icons->addIcon(
                    (new SvgIcon())
                        ->setSrc($directory . $fileinfo->getFilename())
                        ->setIdentifier($directory . $fileinfo->getFilename())
                        ->setName($fileinfo->getBasename('.' . $fileinfo->getExtension()))
                        ->setPreviewImage($directory . $fileinfo->getFilename())
                );
            }
        }

        return $icons;
    }
}
