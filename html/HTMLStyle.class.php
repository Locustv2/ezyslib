<?php

class HTMLStyle extends Map
{
	protected $property = array(
		"CSSAnimation" => null,
	);

	public function __construct()
	{
		foreach ($this->property as $key => $value)
		{
			$this->add($key, new $key);
		}
	}

	public function __get($property)
	{
		if(isset($this[$property]))
		{
			return $this[$property];
		}
		else
		{
			Event::notify("'$property' is not a valid CSS Property Group.");
		}
	}

	public function __set($property, $value)
	{
		if(in_array($property, $this->property))
		{
			Event::notify("'$property' cannot be altered. You can only modify its properties.");
		}
		else
		{
			Event::notify("'$property' is not a valid CSS Property Group.");
		}
	}

}