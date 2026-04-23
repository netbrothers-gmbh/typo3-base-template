<?php declare(strict_types=1);

/*
 * This file is part of the package netbrothers-gmbh/typo3-base-template.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace NetBrothers\TYPO3BaseTemplate\Parser;

/**
 * ParserInterface
 */
interface ParserInterface
{
    /**
     * @param string $extension
     * @return bool
     */
    public function supports(string $extension): bool;

    /**
     * @param string $file
     * @param array $settings
     * @return string
     */
    public function compile(string $file, array $settings): string;
}
