<?php
namespace R3H6\LocallangTools\Domain\Repository;

use TYPO3\CMS\Core\Utility\PathUtility;

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
 * The repository for Locallangs
 */
class TranslationRepository
{

    public function findAll()
    {
        $files = $this->findLocallangFiles();
    }
    
    protected function findLocallangFiles()
    {
        $extensionPaths = array('typo3conf/ext/', 'typo3/sysext/');
        $files = array();
        // Traverse extension locations:
        foreach ($extensionPaths as $path) {
            $path = GeneralUtility::getFileAbsFileName(PathUtility::sanitizeTrailingSeparator($path));
            if (is_dir($path)) {
                $files = array_merge($files, GeneralUtility::getAllFilesAndFoldersInPath(array(), $path, 'xml,xlf', false, 99, 'Tests'));
            }
        }
        return $files;
    }

}