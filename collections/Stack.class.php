<?php

require_once('CollectionArray.class.php');

class Stack extends CollectionArray
{
	public function __construct($array = null)
	{
		parent::__construct($array);
	}

	public function add($elementKey, $elementValue = null)
	{
		parent::add($elementKey);
	}

	public function peek()
	{
		return parent::size() != 0
			? $this[parent::size()-1]
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
			? @array_search($element, @array_reverse($this->toArray(), false), true) + 1
			: false;
	}

	public function push($element)
	{
		return $this->add($element);
	}
}

?>