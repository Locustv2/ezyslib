<?php

require_once('CollectionArray.class.php');

class Set extends CollectionArray
{
	public function __construct($array = null)
	{
		parent::__construct($array);
	}

	public function add($elementKey, $elementValue = null)
	{
		return @in_array($elementKey, $this->elements, true)
			? false
			: parent::add($elementKey);
	}
}
?>