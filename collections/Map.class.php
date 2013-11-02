<?php

require_once('CollectionArray.class.php');

class Map extends CollectionArray
{
	public function __construct($elements = null)
	{
		parent::__construct($elements, true);
	}

	public function add($elementKey, $elementValue = null)
	{
		return (isset($elementKey) and isset($elementValue))
			?  parent::add($elementKey, $elementValue)
			: false;
	}

	public function containsKey($key)
	{
		return parent::containsIndex($key);
	}

	public function containsValue($value)
	{
		return parent::contains($value);
	}

	public function get($key)
	{
		return parent::get($key);
	}

	public function remove($key)
	{
		return parent::removeIndex($key);
	}


	public function __tostring()
    {
        $string = @get_class($this) . "[" . $this->size() . "] { ";
        foreach ($this->toArray() as $elementKey => $elementValue)
        {
        	$index = @array_search($elementKey, @array_keys($this->toArray()));
            $string .= "$elementKey => $elementValue";
            if($index < $this->size()-1)
                $string .= ', ';
        }
        $string .= " }";
        return $string;
    }
    
}