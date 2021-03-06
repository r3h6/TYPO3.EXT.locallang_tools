<?php

namespace R3H6\LocallangTools\Tests\Unit\Domain\Model;

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
 * Test case for class \R3H6\LocallangTools\Domain\Model\Locallang.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class LocallangTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \R3H6\LocallangTools\Domain\Model\Locallang
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \R3H6\LocallangTools\Domain\Model\Locallang();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getKeyReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getKey()
		);
	}

	/**
	 * @test
	 */
	public function setKeyForStringSetsKey()
	{
		$this->subject->setKey('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'key',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSourceReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getSource()
		);
	}

	/**
	 * @test
	 */
	public function setSourceForStringSetsSource()
	{
		$this->subject->setSource('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'source',
			$this->subject
		);
	}
}
