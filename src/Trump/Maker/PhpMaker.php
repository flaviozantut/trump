<?php
namespace Trump\Maker;
use \Trump\Maker\MakerInterface;


class PhpMaker implements MakerInterface
{
	public function run($task, $params)
	{
		eval($task);
		return true;
	}
}