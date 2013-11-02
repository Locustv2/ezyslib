<?php

require_once('CollectionArray.class.php');

class ArrayList extends CollectionArray
{
	public function __construct($array = null)
	{
		parent::__construct($array);
	}

	public function add($elementKey, $elementValue = null)
	{
		return parent::add($elementKey);
	}

	public function get($index)
	{
		return parent::get($index);
	}

	public function indexOf($element)
	{
		return parent::indexOf($element);
	}

	public function lastIndexOf($element)
	{
		return parent::contains($element) 
			? @array_search($element, @array_reverse($this->toArray(), true), true)
			: false;
	}

	public function set($index, $element)
	{
		return parent::set($index, $element);
	}
}