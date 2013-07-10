<?php namespace Trump\Exception;


class NotImplementsMakerInterfaceException extends \Exception {

  	public function __construct($message = null, $code = 903)
  	{
    parent::__construct($message ?: 'Not Implements Maker Interface Exception', $code);
  	}
}