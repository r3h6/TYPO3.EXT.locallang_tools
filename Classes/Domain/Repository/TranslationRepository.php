<?php
namespace R3H6\LocallangTools\Domain\Repository;

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
use R3H6\LocallangTools\Domain\Model\Translation;
use R3H6\LocallangTools\Domain\Model\Dto\TranslationDemand;

/**
 * The repository for Locallangs
 */
class TranslationRepository implements \TYPO3\CMS\Core\SingletonInterface
{
    const DEFAULT_LANGUAGE = 'default';

    /**
     * @var R3H6\LocallangTools\Localization\LocalizationFactory
     * @inject
     */
    protected $localizationFactory = null;


    /**
     * @var R3H6\LocallangTools\Domain\TranslationFactory
     * @inject
     */
    protected $translationFactory = null;

    /**
     * [findDemanded description]
     * @param  R3H6\LocallangTools\Domain\Model\Dto\TranslationDemand $demand [description]
     * @return TYPO3\CMS\Extbase\Persistence\ObjectStorage<R3H6\LocallangTools\Domain\Model\Translation>
     */
    public function findDemanded(TranslationDemand $demand)
    {
        $demand->setLanguage('de');
        $translations = new ObjectStorage();

        $files = (array) $demand->getFiles();
        if (empty($files)) {
            $files = PathUtility::getLocallangPaths();
        }

        $language = $demand->getLanguage();
        if (empty($language)) {
            $language = self::DEFAULT_LANGUAGE;
        }

        foreach ($files as $file) {
            $file = PathUtility::getAbsolutePath($file);
            $parsedData = $this->localizationFactory->getParsedData($file, $language, LocalizationFactory::CHARSET, LocalizationFactory::ERROR_MODE_EXCEPTION);
            foreach ($parsedData[self::DEFAULT_LANGUAGE] as $key => $value) {
                $default = $value[0]['source'];
                $source = isset($parsedData[$language][$key][0]['source']) ? $parsedData[$language][$key][0]['source']: null;
                $target = isset($parsedData[$language][$key][0]['target']) ? $parsedData[$language][$key][0]['target']: null;

                $translation = GeneralUtility::makeInstance(Translation::class, $file, $key, $language, $default, $source, $target);

                if ($demand->getState() && $demand->getState() !== $translation->getState()) {
                    continue;
                }
                if ($demand->getKey() && stripos($translation->getKey(), $demand->getKey()) === false) {
                    continue;
                }
                if ($demand->getSearch() && stripos($translation->getTarget(), $demand->getSearch()) === false && stripos($translation->getSource(), $demand->getSearch()) === false) {
                    continue;
                }

                $translations->attach($translation);
            }
        }
        return $translations;
    }
}
