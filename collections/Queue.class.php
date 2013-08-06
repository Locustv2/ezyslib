<?php

require_once('CollectionArray.class.php');

class Queue extends CollectionArray
{
	public function add($elementKey, $elementValue = null)
	{
		return self::push($elementKey);
	}

	public function peek()
	{
		return parent::size() != 0
			? $this->elements[0]
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
			? @array_search($element, @array_values($this->elements), true) + 1
			: false;
	}

	public function push($element)
	{
		return parent::add($element);
	}
}

?>