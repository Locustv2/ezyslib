<?php

require_once('Collection.interface.php');

abstract class CollectionArray implements Collection, Iterator
{
	protected $elements;
	protected $position;

	public function __construct($array = null)
	{
		$this->elements = array();
		$this->position = 0;
		if(isset($array) && is_array($array))
		{
			foreach ($array as $element)
			{
				static::add($element);
			}
		}
		else if($array instanceof Collection)
		{
			static::addAll($array);
		}
	}

	public function add($elementKey, $elementValue = null)
	{
		return isset($elementKey)
			? isset($elementValue)
				? $this->elements[$elementKey] = $elementValue and true
				: $this->elements[] = $elementKey and true
			: false;
	}

	public function addAll(Collection $collection)
	{
		$changed = false;
		foreach ($collection->toArray() as $element)
		{
			if(static::add($element))
				$changed = true;
		}
		return $changed;
	}

	public function addEach(array $array)
	{
		$changed = false;
		foreach ($array as $element)
		{
			if(static::add($element))
				$changed = true;
		}
		return $changed;
	}

	public function clear()
	{
		$this->elements = array();
	}

	public function contains($element)
	{
		return @in_array($element, $this->elements, true)
			? true 
			: false;
	}

	public function containsAll(Collection $collection)
	{
		foreach ($collection->toArray() as $element)
		{
			if(!self::contains($element))
				return false;
		}
		return true;
	}

	protected function containsIndex($index)
	{
		return @array_key_exists($index, $this->elements)
			? true
			: false;
	}

	public function equals(Collection $collection)
	{
		$object = get_class($this);
		return $collection instanceof $object
			? self::containsAll($collection) and $collection->containsAll($this)
			: false;
	}

	protected function get($index)
	{
		return isset($this->elements[$index])
			? $this->elements[$index]
			: null;
	}

	protected function indexOf($element)
	{
		return self::contains($element) 
			? @array_search($element, $this->elements, true)
			: false;
	}

	public function isEmpty()
	{
		return self::size()===0
			? true
			: false;
	}

	public function remove($element)
	{
		$index = self::indexOf($element);
		return isset($index)
			? self::removeIndex($index)
			: false;
	}

	public function removeAll(Collection  $collection)
	{
		$changed = false;
		foreach ($collection->toArray() as $element)
		{
			if(self::remove($element))
				$changed = true;
		}
		return $changed;
	}

	public function removeEach(array $array)
	{
		$changed = false;
		foreach ($array as $element)
		{
			if(self::remove($element))
				$changed = true;
		}
		return $changed;
	}

	protected function removeIndex($index)
	{
		if(self::containsIndex($index))
        {
        	unset($this->elements[$index]);
        	return true;
        }
        return false;
	}

	public function retainAll(Collection $collection)
	{
		$changed = false;
		foreach ($this->elements as $element)
		{
			if(!$collection->contains($element))
			{
				self::remove($element);
				$changed = true;
			}
		}
		return $changed;
	}

	protected function set($index, $element)
	{
		$value = self::get($index);
		return isset($value)
			? !($this->elements[$index] = $element)
				?: $value
			: false;
	}

	public function size()
	{
		return count($this->elements);
	}

	public function toArray()
	{
		return $this->elements;
	}

	public function __tostring()
	{
		$string = @get_class($this) . "[" . self::size() . "] { ";
		$string .= implode(', ', $this->elements);
		$string .= " }";
		return $string;
	}


	// Iterator Methods
	public function rewind()
	{
		//var_dump(__METHOD__);
		$this->position = 0;
	}

	public function current()
	{
		//var_dump(__METHOD__);
		$collection = array_values($this->elements);
		return $collection[$this->position];
	}

	public function key()
	{
		//var_dump(__METHOD__);
		return $this->position;
	}

	public function next()
	{
		//var_dump(__METHOD__);
		++$this->position;
	}

	public function valid()
	{
		//var_dump(__METHOD__);
		$collection = array_values($this->elements);
		return isset($collection[$this->position]);
	}

}

?>