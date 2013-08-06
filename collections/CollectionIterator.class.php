<?php

class CollectionIterator
{
	private $elements;
	private $position;

	public function __construct($array)
	{
		$this->elements = $array;
		$this->position = 0;
	}

	public function hasNext()
	{
		return ($this->position < count($this->elements))
			? true
			: false;
	}

	public function next()
	{
		$this->position++;
		return $this->elements[$this->position-1];
	}

	public function remove()
	{
		unset($this->elements[$this->position]);
        $this->elements = array_merge($this->elements);
	}
}

?>