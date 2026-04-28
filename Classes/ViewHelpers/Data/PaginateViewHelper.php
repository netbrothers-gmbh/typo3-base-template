<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\ViewHelpers\Data;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;
use TYPO3\CMS\Core\View\ViewInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * PaginateViewHelper
 */
class PaginateViewHelper extends AbstractViewHelper
{
    public function __construct(
        private readonly ViewFactoryInterface $viewFactory,
    ) {
    }

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('id', 'string', 'Identifier of the pagination', true);
        $this->registerArgument('objects', 'mixed', 'Object', true);
        $this->registerArgument('configuration', 'array', 'configuration', false, ['itemsPerPage' => 10, 'insertAbove' => false, 'insertBelow' => true]);
    }

    public function render(): string
    {
        $renderingContext = $this->renderingContext;
        $request = $this->getRequestFromRenderingContext($renderingContext);
        if ($request !== null) {
            $objects = $this->arguments['objects'];
            if (!($objects instanceof QueryResultInterface || is_array($objects))) {
                throw new \UnexpectedValueException('Supplied file object type ' . get_class($objects) . ' must be QueryResultInterface or be an array.', 1623322979);
            }

            $configuration = [
                'itemsPerPage' => 10,
                'insertAbove' => false,
                'insertBelow' => true,
                'section' => '',
            ];
            ArrayUtility::mergeRecursiveWithOverrule($configuration, $this->arguments['configuration'], false);

            $id = $this->arguments['id'];
            $itemsPerPage = (int) $configuration['itemsPerPage'];
            $currentPage = (int) ($request->getQueryParams()['paginate'][$id]['page'] ?? 1);

            if ($objects instanceof QueryResultInterface) {
                $paginator = new QueryResultPaginator($objects, $currentPage, $itemsPerPage);
            } else {
                $paginator = new ArrayPaginator($objects, $currentPage, $itemsPerPage);
            }
            $pagination = new SimplePagination($paginator);

            $paginationView = $this->getTemplateObject($request);
            $paginationView->assignMultiple([
                'id' => $id,
                'paginator' => $paginator,
                'pagination' => $pagination,
                'configuration' => $configuration,
            ]);
            $paginationRendered = $paginationView->render('Paginate/Index');

            $variableProvider = $renderingContext->getVariableProvider();
            $variableProvider->add('paginator', $paginator);

            $contents = [];
            $contents[] = $configuration['insertAbove'] === true ? $paginationRendered : '';
            $contents[] = $this->renderChildren();
            $contents[] = $configuration['insertBelow'] === true ? $paginationRendered : '';

            $variableProvider->remove('paginator');

            return implode('', $contents);
        }

        throw new \RuntimeException(
            'ViewHelper nb:data.paginate needs a request implementing ServerRequestInterface.',
            1639819269
        );
    }

    protected function getTemplateObject(ServerRequestInterface $request): ViewInterface
    {
        $setup = $this->getConfigurationManager()->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        $context = GeneralUtility::makeInstance(RenderingContextFactory::class)->create([], $request);
        if ((new \ReflectionMethod(RenderingContextFactory::class, 'create'))->getNumberOfParameters() === 1) {
            $context->setRequest($request);
        }

        $layoutRootPaths = [];
        $layoutRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:nb_basetemplate/Resources/Private/Layouts/ViewHelpers/');
        if (isset($setup['plugin.']['tx_nbbasetemplate.']['view.']['layoutRootPaths.'])) {
            foreach ($setup['plugin.']['tx_nbbasetemplate.']['view.']['layoutRootPaths.'] as $layoutRootPath) {
                $layoutRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($layoutRootPath, '/') . '/ViewHelpers/');
            }
        }
        $partialRootPaths = [];
        $partialRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:nb_basetemplate/Resources/Private/Partials/ViewHelpers/');
        if (isset($setup['plugin.']['tx_nbbasetemplate.']['view.']['partialRootPaths.'])) {
            foreach ($setup['plugin.']['tx_nbbasetemplate.']['view.']['partialRootPaths.'] as $partialRootPath) {
                $partialRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($partialRootPath, '/') . '/ViewHelpers/');
            }
        }
        $templateRootPaths = [];
        $templateRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:nb_basetemplate/Resources/Private/Templates/ViewHelpers/');
        if (isset($setup['plugin.']['tx_nbbasetemplate.']['view.']['templateRootPaths.'])) {
            foreach ($setup['plugin.']['tx_nbbasetemplate.']['view.']['templateRootPaths.'] as $templateRootPath) {
                $templateRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($templateRootPath, '/') . '/ViewHelpers/');
            }
        }

        return $this->viewFactory->create(new ViewFactoryData(
            layoutRootPaths: $layoutRootPaths,
            partialRootPaths: $partialRootPaths,
            templateRootPaths: $templateRootPaths,
        ));
    }

    protected function getConfigurationManager(): ConfigurationManagerInterface
    {
        /** @var ConfigurationManager $configurationManager  */
        $configurationManager = GeneralUtility::getContainer()->get(ConfigurationManager::class);

        return $configurationManager;
    }

    protected function getRequestFromRenderingContext(RenderingContextInterface $renderingContext): ?ServerRequestInterface
    {
        if ($renderingContext->hasAttribute(ServerRequestInterface::class)) {
            return $renderingContext->getAttribute(ServerRequestInterface::class);
        } elseif ($renderingContext instanceof RenderingContext) {
            return $renderingContext->getRequest();
        }

        return null;
    }
}
