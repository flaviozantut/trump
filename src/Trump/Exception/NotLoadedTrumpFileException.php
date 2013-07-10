<?php namespace Trump\Exception;


class NotLoadedTrumpFileException extends \Exception {

  	public function __construct($message = null, $code = 902)
  	{
    parent::__construct($message ?: 'Not Loaded TrumpFile Exception', $code);
  	}
}