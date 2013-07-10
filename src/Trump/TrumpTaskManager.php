<?php namespace Trump;

use \Trump\Exception\NotImplementsMakerInterfaceException;
use \Trump\Exception\NotLoadedTrumpFileException;
use \Trump\Exception\NotExistMakerException;
use Symfony\Component\Yaml\Parser;

class TrumpTaskManager {

	private $maker;
	private $trumpFile;

	public function setMaker($maker)
	{
		$this->maker = $maker;
		return $this;
	}
	public function getMaker()
	{
		$this->setMaker($this->resolveMaker($this->maker));
		if (!is_object($this->maker) or !in_array("Trump\Maker\MakerInterface", class_implements($this->maker))) {
    		throw new NotImplementsMakerInterfaceException();
		}
		return $this->maker;
	}

	public function run($task, array $param = [])
	{
		$maker = $this->getMaker();
		return $maker->run($task, $param);
	}


	public function getTrumpFile()
	{
		if(!is_array($this->trumpFile)) throw new NotLoadedTrumpFileException();
		return $this->trumpFile;
	}

	public function setTrumpFile($file)
	{
		$yaml = new Parser();
		$this->trumpFile = $yaml->parse(file_get_contents($file));
	}

	public function resolveMaker($maker)
	{
		$trumpFile = $this->getTrumpFile();
		if (!isset($trumpFile['makers'][$maker])) throw new NotExistMakerException();
		return new $trumpFile['makers'][$maker];
	}
}