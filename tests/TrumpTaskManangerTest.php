<?php

use \Mockery as m;
use \Trump\TrumpTaskManager;

class TrumpTaskManangerTest extends \PHPUnit_Framework_TestCase
{

	 public function tearDown()
    {
        m::close();
    }


	public function testSetMaker()
	{
		/*$maker = m::mock('\Trump\Maker\MakerInterface');
		$maker->shouldReceive('run')->andReturn(true);*/
		$trump = new TrumpTaskManager;
		$trump->setTrumpFile(__DIR__ . '/Trumpfile');
		$trump->setMaker('php');
		$this->assertTrue(in_array("Trump\Maker\MakerInterface", class_implements($trump->getMaker())));
	}


	public function testTrumpRun()
	{
		$maker = m::mock('\Trump\Maker\MakerInterface');
		$maker->shouldReceive('run')->andReturn(true);
		$trump = new TrumpTaskManager;
		$trump->setTrumpFile(__DIR__ . '/Trumpfile');
		$trump->setMaker('php');
		$this->assertTrue($trump->run('return true;'));
	}

	public function testRunTrumpException()
	{

		try {
            $trump = new TrumpTaskManager;
            $trump->setTrumpFile(__DIR__ . '/Trumpfile');
            $trump->setMaker('foo')->run('task');
        } catch (Trump\Exception\NotExistMakerException $expected) {
            return;
        }
		$this->fail('An expected exception has not been raised.');
	}

	public function testTrumpFile()
	{
		$trump = new TrumpTaskManager;
		$trump->setTrumpFile(__DIR__ . '/Trumpfile');
	    $this->assertTrue(is_array($trump->getTrumpFile()));
	}

	public function testResolveMaker()
	{
		$trump = new TrumpTaskManager;
		$trump->setTrumpFile(__DIR__ . '/Trumpfile');
		$this->assertTrue(in_array("Trump\Maker\MakerInterface", class_implements($trump->resolveMaker('php'))));
	}
}