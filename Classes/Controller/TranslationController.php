<?php
namespace R3H6\LocallangTools\Controller;

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
 * TranslationController
 */
class TranslationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * translationRepository
     *
     * @var \R3H6\LocallangTools\Domain\Repository\TranslationRepository
     * @inject
     */
    protected $translationRepository = NULL;
    
    /**
     * action list
     *
     * @param R3H6\TranslationTools\Domain\Model\Translation
     * @return void
     */
    public function listAction()
    {
        $locallangs = $this->locallangRepository->findAll();
        $this->view->assign('locallangs', $locallangs);
    }
    
    /**
     * action delete
     *
     * @param R3H6\TranslationTools\Domain\Model\Translation
     * @return void
     */
    public function deleteAction(\R3H6\LocallangTools\Domain\Model\Translation $translation)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->locallangRepository->remove($locallang);
        $this->redirect('list');
    }
    
    /**
     * action update
     *
     * @param R3H6\TranslationTools\Domain\Model\Translation
     * @return void
     */
    public function updateAction(\R3H6\LocallangTools\Domain\Model\Translation $translation)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->locallangRepository->update($locallang);
        $this->redirect('list');
    }

}