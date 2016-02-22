<?php
namespace R3H6\LocallangTools\Utility;

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

/**
 * PathUtility
 */
class PathUtility
{
    const RELATIVE_EXT_PATH = 'typo3conf/ext/';
    const RELATIVE_SYSEXT_PATH = 'typo3/sysext/';
    const RELATIVE_L10N_PATH = 'typo3conf/l10n/';
    const EXT_PREFIX = 'EXT:';

    public static function getTypo3PathTo($path)
    {
        $relativePath = static::getRelativePathTo($path);

        if (strpos($relativePath, self::RELATIVE_EXT_PATH) === 0) {
            return self::EXT_PREFIX . substr($relativePath, strlen(self::RELATIVE_EXT_PATH));
        }
        if (strpos($relativePath, self::RELATIVE_SYSEXT_PATH) === 0) {
            return self::EXT_PREFIX . substr($relativePath, strlen(self::RELATIVE_SYSEXT_PATH));
        }
        return $relativePath;
    }

    public static function getRelativePathTo($path)
    {
        $absolutePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($path);
        $relativePath = str_replace(PATH_site, '', $absolutePath);
        return $relativePath;
    }

    public static function getL10nPathTo($path, $language, $base = self::RELATIVE_L10N_PATH)
    {
        if (!preg_match('/[a-z]{2}/', $language)) {
            throw new \InvalidArgumentException("Argument language '$language' is not a valid language code", 1455831055);
        }
        $typo3Path = static::getTypo3PathTo($path);
        if (strpos($typo3Path, self::EXT_PREFIX) !== 0) {
            throw new InvalidArgumentException("Path '$path' doesn't belong to an extension!", 1455832193);
        }
        $extensionPath = substr($typo3Path, strlen(self::EXT_PREFIX));
        $pathParts = \TYPO3\CMS\Core\Utility\PathUtility::pathinfo($extensionPath);

        $l10nPath =  \TYPO3\CMS\Core\Utility\PathUtility::sanitizeTrailingSeparator($base) . $language . '/' . \TYPO3\CMS\Core\Utility\PathUtility::sanitizeTrailingSeparator($pathParts['dirname']) . $language . '.' . $pathParts['basename'];
        return $l10nPath;
    }

    public static function getAbsolutePath($path)
    {
        if (\TYPO3\CMS\Core\Utility\PathUtility::isAbsolutePath($path)) {
            return $path;
        }
        if (strpos($path, self::EXT_PREFIX) === 0) {
            $relativePath = substr($path, strlen(self::EXT_PREFIX));
            if (file_exists(PATH_site . self::RELATIVE_EXT_PATH . $relativePath)) {
                return PATH_site . self::RELATIVE_EXT_PATH . $relativePath;
            } elseif (file_exists(PATH_site . self::RELATIVE_SYSEXT_PATH . $relativePath)) {
                return PATH_site . self::RELATIVE_SYSEXT_PATH . $relativePath;
            }
        }
        if (file_exists(PATH_site . $path)) {
            return PATH_site . $path;
        }
        throw new \InvalidArgumentException("Path '$path' can not be converted to an absolute path!", 1456179408);
    }

    public static function getLocallangPaths(array $directories = null)
    {
        $directories = array('typo3conf/ext/', 'typo3/sysext/');
        $directories = array('typo3conf/ext/');
        $files = array();
        // Traverse extension locations:
        foreach ($directories as $path) {
            $path = GeneralUtility::getFileAbsFileName(\TYPO3\CMS\Core\Utility\PathUtility::sanitizeTrailingSeparator($path));
            if (is_dir($path)) {
                $files = array_merge($files, GeneralUtility::getAllFilesAndFoldersInPath(array(), $path, 'xml,xlf', false, 99, 'Tests'));
            }
        }
        // Remove all non-locallang files (looking at the prefix)
        foreach ($files as $key => $value) {
            if (strpos(basename($value), 'locallang') !== 0) {
                unset($files[$key]);
            } else {
                $files[$key] = PathUtility::getTypo3PathTo($value);
            }
        }
        return $files;
    }
}
