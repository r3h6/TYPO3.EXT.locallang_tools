<?php
namespace R3H6\LocallangTools\Domain\Model;

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

/**
 * Locallang
 */
class Translation
{

    const STATE_TRANSLATED = 'translated';
    const STATE_NEEDS_TRANSLATION = 'needs-translation';
    const STATE_NEEDS_REVIEW_TRANSLATION = 'needs-review-translation';

    /**
     * file
     *
     * @var string
     */
    protected $file = '';


    /**
     * key
     *
     * @var string
     */
    protected $key = '';

    /**
     * language
     *
     * @var string
     */
    protected $language = '';

    /**
     * source
     *
     * @var string
     */
    protected $source;

    /**
     * target
     *
     * @var string
     */
    protected $target;

    /**
     * default source
     *
     * @var string
     */
    protected $default;

    public function __construct($file, $key, $language, $default, $source, $target)
    {
        $this->file = $file;
        $this->key = $key;
        $this->language = $language;
        $this->default = $default;
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Returns the key
     *
     * @return string $key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the key
     *
     * @param string $key
     * @return void
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get langauge
     *
     * @return string
     */
    public function getLangauge()
    {
        return $this->langauge;
    }

    /**
     * Set langauge
     *
     * @param string $langauge
     */
    public function setLangauge($langauge)
    {
        $this->langauge = $langauge;
    }

    /**
     * Get default
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set default
     *
     * @param string $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * Get target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set target
     *
     * @param string $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * Returns the source
     *
     * @return string $source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets the source
     *
     * @param string $source
     * @return void
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Get state
     *
     * @return  string
     */
    public function getState()
    {
        if (empty($this->target)) {
            return self::STATE_NEEDS_TRANSLATION;
        } elseif ($this->source !== $this->default) {
            return self::STATE_NEEDS_REVIEW_TRANSLATION;
        }
        return self::STATE_TRANSLATED;
    }
}
