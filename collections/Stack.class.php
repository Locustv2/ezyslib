<?php

require_once('CollectionArray.class.php');

class Stack extends CollectionArray
{
	public function add($elementKey, $elementValue = null)
	{
		return self::push($elementKey);
	}

	public function peek()
	{
		return parent::size() != 0
			? $this->elements[parent::size()-1]
			: null;
	}

	public function pop()
	{
		return self::peek()
			? !parent::remove($peek = self::peek())
				?: $peek
			: null;
	}

	public function pos($element)
	{
		return parent::contains($element) 
			? @array_search($element, @array_reverse($this->elements, false), true) + 1
			: false;
	}

	public function push($element)
	{
		return parent::add($element);
	}
}

?>