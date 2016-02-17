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
class Translation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * key
     *
     * @var string
     */
    protected $key = '';
    
    /**
     * source
     *
     * @var string
     */
    protected $source = '';
    
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

}