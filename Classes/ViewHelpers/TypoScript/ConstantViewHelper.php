<?php
declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\ViewHelpers\TypoScript;

use NetBrothers\TYPO3BaseTemplate\Utility\TypoScriptUtility;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ConstantViewHelper
 *
 * {nb:typoScript.constant(constant: 'identifier')}
 */
class ConstantViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('constant', 'string', 'TypoScript constant');
    }

    public function render(): string
    {
        $renderingContext = $this->renderingContext;
        $request = $this->getRequestFromRenderingContext($renderingContext);
        if ($request !== null) {
            $constant = $this->arguments['constant'] ?? '';
            return TypoScriptUtility::getConstants($request)[$constant] ?? '';
        }

        throw new \RuntimeException(
            'ViewHelper nb:typoScript.constant needs a request implementing ServerRequestInterface.',
            1639819269
        );
    }

    protected function getRequestFromRenderingContext(RenderingContextInterface $renderingContext): ?ServerRequestInterface
    {
        if ($renderingContext->hasAttribute(ServerRequestInterface::class)) {
            return $renderingContext->getAttribute(ServerRequestInterface::class);
        } elseif ($renderingContext instanceof RenderingContext) {
            /** @phpstan-ignore-next-line */
            return $renderingContext->getRequest();
        }

        return null;
    }
}
