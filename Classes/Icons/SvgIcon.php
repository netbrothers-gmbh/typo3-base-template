<?php
declare(strict_types = 1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Icons;

use NetBrothers\TYPO3BaseTemplate\Utility\SvgUtility;

/**
 * SvgIcon
 */
class SvgIcon extends AbstractIcon
{
    /**
     * @var string
     */
    protected $src;

    /**
     * @param string $src
     * @return self
     */
    public function setSrc(string $src): self
    {
        $this->src = $src;
        return $this;
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $src = $this->getSrc();
        $height = $this->getHeight();
        $width = $this->getWidth();

        return SvgUtility::getInlineSvg($src, null, $width, $height);
    }
}
