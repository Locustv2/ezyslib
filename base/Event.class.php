<?php

ini_set('display_errors',0);
function customErrorHandler($level, $message, $file, $line, $context)
{
	$stackTrace = array_reverse(debug_backtrace());
	$trace = generateTrace($stackTrace[0], $message);

	echo "<div style='border:1px solid red; padding:10px; margin: 10px; position:relative'><strong>Notice:</strong> ".$trace['message']."<br/><strong>File:</strong> ".$trace['file']."<br/><strong>Line:</strong> ".$trace['line']."</div>";

	//var_dump($trace);
}

function shutdownErrorHandler()
{
	$stackTrace = error_get_last();
	$trace = generateTrace($stackTrace);

	echo "<div style='border:1px solid red; padding:10px; margin: 10px; position:relative'><strong>Error:</strong> ".$trace['message']."<br/><strong>File:</strong> ".$trace['file']."<br/><strong>Line:</strong> ".$trace['line']."</div>";

	//var_dump($trace);
}

function generateTrace(array $array, $message = null)
{
	$trace = array(
		'message' => isset($array['message']) ? $array['message'] : $message,
		'line' => isset($array['line']) ? $array['line'] : null,
		'function' => isset($array['function']) ? $array['function'] : null,
		'file' => isset($array['file']) ? $array['file'] : null,
		'class' => isset($array['class']) ? $array['class'] : null,
		'object' => isset($array['object']) ? $array['object'] : null,
		'type' => isset($array['type']) ? $array['type'] : null,
		'args' => isset($array['args']) ? $array['args'] : null,
	);

	return $trace;
}

set_error_handler('customErrorHandler', E_ALL);

register_shutdown_function('shutdownErrorHandler');


class Event
{
	public static function error()
	{
		
	}

	public static function notify($message)
	{
		trigger_error($message);
	}

	public static function warn()
	{
		
	}
}