<?php 


namespace App;


class ExceptionHandler extends \Exception
{
    public function handle(Exception $ex)
	{
		// code to handle the exception
        $time = date('F j, Y, g:i a e O');

        // format the exception message
        $message = "[{$time}] {$ex->getMessage()}\n";

        // append to the error log
        error_log($message, 3, 'logs/errors.log');

        // show a user-friendly message
        echo 'Whoops, looks like something went wrong!';
	}
}

set_exception_handler(['ExceptionHandler', 'handle']);
