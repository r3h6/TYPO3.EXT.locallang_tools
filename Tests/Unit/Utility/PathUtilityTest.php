<?php
namespace R3H6\LocallangTools\Tests\Unit\Utility;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 R3 H6 <r3h6@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use R3H6\LocallangTools\Utility\PathUtility;

/**
 * Test case for class R3H6\LocallangTools\Utility\PathUtility.
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class PathUtilityTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @test
     * @dataProvider getTypo3PathToDataProvider
     */
    public function getTypo3PathTo($message, $targetPath, $expected)
    {
        $this->assertSame($expected, PathUtility::getTypo3PathTo($targetPath), $message);
    }

    public function getTypo3PathToDataProvider()
    {
        return [
            [
                'Path using "EXT:" prefix should not be changed!',
                'EXT:fluid/Resources/Private/Language/locallang.xlf',
                'EXT:fluid/Resources/Private/Language/locallang.xlf',
            ],
            [
                'Relative path to PATH_site should not be changed!',
                'fileadmin/user_upload/index.html',
                'fileadmin/user_upload/index.html',
            ],
            [
                'Relative extension path should be prefixed with "EXT:"!',
                'typo3conf/ext/fluid/Resources/Private/Language/locallang.xlf',
                'EXT:fluid/Resources/Private/Language/locallang.xlf',
            ],
            [
                'Absolute extension path should be prefixed with "EXT:"!',
                PATH_site . 'typo3conf/ext/fluid/Resources/Private/Language/locallang.xlf',
                'EXT:fluid/Resources/Private/Language/locallang.xlf',
            ],
            [
                'Absolute fileadmin path should be realtive to PATH_site!',
                PATH_site . 'fileadmin/user_upload/index.html',
                'fileadmin/user_upload/index.html',
            ],
            [
                'Path outside of PATH_site is not allowed!',
                '/usr/bin/phpunit',
                '',
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getL10nPathToDataProvider
     * @depends getTypo3PathTo
     */
    public function getL10nPathTo($message, $targetPath, $language, $expected)
    {
        $this->assertSame($expected, PathUtility::getL10nPathTo($targetPath, $language), $message);
    }

    public function getL10nPathToDataProvider()
    {
        return [
            [
                'Extension path points to l10n directory.',
                'EXT:fluid/Resources/Private/Language/locallang.xlf',
                'de',
                'typo3conf/l10n/de/fluid/Resources/Private/Language/de.locallang.xlf',
            ],
            [
                'Extension path points to l10n directory.',
                'typo3/sysext/fluid/Resources/Private/Language/locallang.xlf',
                'de',
                'typo3conf/l10n/de/fluid/Resources/Private/Language/de.locallang.xlf',
            ]
        ];
    }

}
