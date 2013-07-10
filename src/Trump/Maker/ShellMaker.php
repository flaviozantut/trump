<?php
namespace Trump\Maker;
use \Trump\Maker\MakerInterface;


class ShellMaker implements MakerInterface
{
	public function run($task, $params)
	{
		echo shell_exec($task);
		return true;
	}
}