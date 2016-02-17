<?php
namespace R3H6\LocallangTools\Tests\Unit\Controller;
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

/**
 * Test case for class R3H6\LocallangTools\Controller\LocallangController.
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class LocallangControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \R3H6\LocallangTools\Controller\LocallangController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('R3H6\\LocallangTools\\Controller\\LocallangController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllLocallangsFromRepositoryAndAssignsThemToView()
	{

		$allLocallangs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$locallangRepository = $this->getMock('R3H6\\LocallangTools\\Domain\\Repository\\LocallangRepository', array('findAll'), array(), '', FALSE);
		$locallangRepository->expects($this->once())->method('findAll')->will($this->returnValue($allLocallangs));
		$this->inject($this->subject, 'locallangRepository', $locallangRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('locallangs', $allLocallangs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenLocallangFromLocallangRepository()
	{
		$locallang = new \R3H6\LocallangTools\Domain\Model\Locallang();

		$locallangRepository = $this->getMock('R3H6\\LocallangTools\\Domain\\Repository\\LocallangRepository', array('remove'), array(), '', FALSE);
		$locallangRepository->expects($this->once())->method('remove')->with($locallang);
		$this->inject($this->subject, 'locallangRepository', $locallangRepository);

		$this->subject->deleteAction($locallang);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenLocallangInLocallangRepository()
	{
		$locallang = new \R3H6\LocallangTools\Domain\Model\Locallang();

		$locallangRepository = $this->getMock('R3H6\\LocallangTools\\Domain\\Repository\\LocallangRepository', array('update'), array(), '', FALSE);
		$locallangRepository->expects($this->once())->method('update')->with($locallang);
		$this->inject($this->subject, 'locallangRepository', $locallangRepository);

		$this->subject->updateAction($locallang);
	}
}
