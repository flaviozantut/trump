<?php namespace Trump\Exception;


class NotExistMakerException extends \Exception {

  	public function __construct($message = null, $code = 901)
  	{
    parent::__construct($message ?: 'Not Exist Maker Exception', $code);
  	}
}