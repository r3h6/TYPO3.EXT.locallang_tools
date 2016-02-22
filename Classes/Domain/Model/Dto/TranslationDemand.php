<?php
namespace R3H6\LocallangTools\Domain\Model\Dto;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 3 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use R3H6\LocallangTools\Domain\Repository\LanguageRepository;
use R3H6\LocallangTools\Utility\PathUtility;

/**
 * TranslationDemand
 */
class TranslationDemand
{

    /**
     * [$extensions description]
     * @var array
     */
    protected $extensions = [];

    /**
     * [$files description]
     * @var array
     */
    protected $files = [];

    /**
     * [$state description]
     * @var string
     */
    protected $state = '';

    /**
     * [$language description]
     * @var string
     */
    protected $language = '';

    /**
     * [$key description]
     * @var string
     */
    protected $key = '';

    /**
     * [$search description]
     * @var string
     */
    protected $search = '';

    /**
     * Get extensions
     *
     * @return array
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Set extensions
     *
     * @param array $extensions
     */
    public function setExtensions($extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * Get files
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set files
     *
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state
     *
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set search
     *
     * @param string $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set key
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getExtensionsOptions()
    {
        /** @var \TYPO3\CMS\Extensionmanager\Utility\ListUtility */
        $listUtility = GeneralUtility::makeInstance(ObjectManager::class)->get(\TYPO3\CMS\Extensionmanager\Utility\ListUtility::class);
        $extensions = $listUtility->getAvailableExtensions();
        $extensions = $listUtility->enrichExtensionsWithEmConfAndTerInformation($extensions);

        usort($extensions, function ($a, $b) {
            return strcasecmp($a["title"], $b["title"]);
        });

        return $extensions;
    }

    public function getLanguageOptions()
    {
        /** @var R3H6\LocallangTools\Domain\Repository\LanguageRepository $languageRepository */
        $languageRepository = GeneralUtility::makeInstance(ObjectManager::class)->get(LanguageRepository::class);
        return $languageRepository->findAllAccessableLanguages();
    }

    public function getFilesOptions()
    {
        return PathUtility::getLocallangPaths();
    }
}
