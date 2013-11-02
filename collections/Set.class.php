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
		return $this->contains($elementKey)
			? false
			: parent::add($elementKey);
	}
}