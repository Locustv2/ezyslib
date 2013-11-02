<?php

require_once('CollectionArray.class.php');

class Queue extends CollectionArray
{
	public function __construct($array = null)
	{
		parent::__construct($array);
	}
	
	public function add($elementKey, $elementValue = null)
	{
		return parent::add($elementKey);
	}

	public function peek()
	{
		return parent::size() != 0
			? $this[0]
			: null;
	}

	public function pop()
	{
		return $this->peek()
			? !parent::remove($peek = $this->peek())
				?: $peek
			: null;
	}

	public function pos($element)
	{
		return parent::contains($element) 
			? @array_search($element, @array_values($this->toArray()), true) + 1
			: false;
	}

	public function push($element)
	{
		return $this->add($element);
	}
}