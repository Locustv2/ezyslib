<?php

require_once('CollectionArray.class.php');

class Map extends CollectionArray
{
	public function __construct($array = null)
	{
		parent::__construct($array);
	}

	public function add($elementKey, $elementValue = null)
	{
		return self::put($elementKey, $elementValue);
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

	public function put($key, $value)
	{
		return parent::add($key, $value);
	}

	public function putAll(Collection $collection)
	{
		return parent::addAll($collection);
	}

	public function remove($key)
	{
		return parent::removeIndex($key);
	}


	public function __tostring()
    {
        $string = @get_class($this) . "[" . self::size() . "] { ";
        foreach ($this->elements as $elementKey => $elementValue)
        {
        	$index = @array_search($elementKey, @array_keys($this->elements));
            $string .= "$elementKey => $elementValue";
            if($index < self::size()-1)
                $string .= ', ';
        }
        $string .= " }";
        return $string;
    }

    public function key()
    {
        //var_dump(__METHOD__);
        return @array_search(self::current(), $this->elements);
    }
}
?>