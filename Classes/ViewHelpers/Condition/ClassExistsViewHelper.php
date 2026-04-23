<?php

declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\ViewHelpers\Condition;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

final class ClassExistsViewHelper extends AbstractConditionViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('class', 'string', 'The class name. The name is matched in a case-insensitive manner.', true);
    }

    public static function verdict(array $arguments, RenderingContextInterface $renderingContext): bool
    {
        return class_exists($arguments['class']);
    }
}
