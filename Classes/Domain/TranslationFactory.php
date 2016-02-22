<?php
namespace R3H6\LocallangTools\Domain;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 R3 H6 <r3h6@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use R3H6\LocallangTools\Localization\LocalizationFactory;
use R3H6\LocallangTools\Utility\PathUtility;
use R3H6\LocallangTools\Utility\LocallangUtility;
use R3H6\LocallangTools\Domain\Model\Translation;
use R3H6\LocallangTools\Domain\Model\Dto\TranslationDemand;

/**
 * TranslationFactory
 */
class TranslationFactory implements \TYPO3\CMS\Core\SingletonInterface
{
    public function create($key, $language, $sourceData, $targetData)
    {
        $target = '';
        $state = null;
        $source = $sourceData['source'];
        if ($targetData['source'] !== $sourceData['source']) {
            $state = Translation::STATE_NEEDS_REVIEW_TRANSLATION;
        } elseif (isset($targetData['target']) && !empty($targetData['target'])) {
            $state = Translation::STATE_TRANSLATED;
            $target = $targetData['target'];
        } else {
            $state = Translation::STATE_NEEDS_TRANSLATION;
        }
    }
}
