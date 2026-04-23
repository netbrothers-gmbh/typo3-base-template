<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\DataProcessing;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This processor generates a set of file objects.
 *
 * 10 = NetBrothers\TYPO3BaseTemplate\DataProcessing\StaticFilesProcessor
 * 10 {
 *   files {
 *     0.field = image
 *     1 = EXT:nb_basetemplate/Resources/Public/Images/Icons/icon-1.png
 *     circle = EXT:nb_basetemplate/Resources/Public/Images/Icons/icon-circle.png
 *   }
 *   as = staticFiles
 * }
 */
class StaticFilesProcessor implements DataProcessorInterface
{
    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        // Collect possible files
        $files = [];
        if (count($processorConfiguration['files.']) > 0) {
            $filesConfiguration = $processorConfiguration['files.'];
            foreach ($filesConfiguration as $key => $file) {
                $key = substr($key, -1) === '.' ? substr_replace($key, '', -1) : $key;
                $value = (string) $cObj->stdWrapValue($key, $filesConfiguration);
                if ($value !== '') {
                    $files[$key] = $value;
                }
            }
        }

        // Get file objects
        $images = [];
        if (count($files) !== 0) {
            $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
            foreach ($files as $key => $file) {
                $absFilename = GeneralUtility::getFileAbsFileName($file);
                if (file_exists($absFilename)) {
                    // Do not use absolute file name to ensure correct path resolution from ResourceFactory.
                    $images[$key] = $resourceFactory->retrieveFileOrFolderObject($file);
                }
            }
        }

        // Set the target variable
        $targetVariableName = (string) $cObj->stdWrapValue('as', $processorConfiguration);
        if ($targetVariableName !== '') {
            $processedData[$targetVariableName] = $images;
        } else {
            $processedData['staticFiles'] = $images;
        }

        return $processedData;
    }
}
