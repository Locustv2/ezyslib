<?php

abstract class CSSProperty extends Map
{
	protected $property = array();

	public function __construct()
	{
		foreach ($this->property as $property)
		{
			//$this->add($property, '');
		}
	}

	public function __get($property)
	{
		if(isset($this[$property]))
		{
			return $this[$property];
		}
		if(!in_array($property, $this->property))
		{
			Event::notify("'$property' is not a valid CSS Property from ". get_class ($this));
		}
	}

	public function __set($property, $value)
	{
		if(in_array($property, $this->property))
		{
			$this->add($property, $value);
		}
		else
		{
			Event::notify("'$property' is not a valid CSS Property from ". get_class ($this));
		}
	}
	
}