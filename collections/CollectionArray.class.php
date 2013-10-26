<?php

require_once('Collection.interface.php');

abstract class CollectionArray extends ArrayObject implements Collection
{
	private $isIndexed = false;

	public function __construct($elements = null, $isIndexed = false)
	{
		$this->isIndexed = $isIndexed;
		if(isset($elements) && is_array($elements))
		{
			$this->addEach($elements);
		}
		else if($elements instanceof Collection)
		{
			$this->addAll($elements);
		}
	}

	public function add($elementKey, $elementValue = null)
	{
		return isset($elementKey)
			? isset($elementValue)
				? $this[$elementKey] = $elementValue and true
				: $this[] = $elementKey and true
			: false;
	}

	public function addAll(Collection $collection)
	{
		return $this->addEach($collection->toArray());
	}

	public function addEach(array $array)
	{
		$changed = false;
		foreach ($array as $key => $element)
		{
			$changed = ($this->isIndexed)
				? static::add($key, $element)
				: static::add($element);
		}
		return $changed;
	}

	public function clear()
	{
		foreach ($this->toArray() as $key => $element)
		{
			unset($this[$key]);
		}
	}

	public function contains($element)
	{
		return @in_array(serialize($element), $this->toSerializedArray(), true)
			? true 
			: false;
	}

	public function containsAll(Collection $collection)
	{
		foreach ($collection->toArray() as $element)
		{
			if(!$this->contains($element))
				return false;
		}
		return true;
	}

	protected function containsIndex($index)
	{
		return @array_key_exists($index, $this->toArray())
			? true
			: false;
	}

	public function equals(Collection $collection)
	{
		$object = get_class($this);
		return $collection instanceof $object
			? $this->containsAll($collection) and $collection->containsAll($this)
			: false;
	}

	protected function get($index)
	{
		return isset($this[$index])
			? $this[$index]
			: null;
	}

	protected function indexOf($element)
	{
		return $this->contains($element) 
			? @array_search($element, $this->toArray(), true)
			: false;
	}

	public function isEmpty()
	{
		return $this->size()===0
			? true
			: false;
	}

	public function remove($element)
	{
		$index = $this->indexOf($element);
		return isset($index)
			? $this->removeIndex($index)
			: false;
	}

	public function removeAll(Collection  $collection)
	{
		$changed = false;
		foreach ($collection->toArray() as $element)
		{
			if($this->remove($element))
				$changed = true;
		}
		return $changed;
	}

	public function removeEach(array $array)
	{
		$changed = false;
		foreach ($array as $element)
		{
			if($this->remove($element))
				$changed = true;
		}
		return $changed;
	}

	protected function removeIndex($index)
	{
		if($this->containsIndex($index))
        {
        	$arr = $this->toArray();
        	unset($arr[$index]);
        	$arr = array_merge($arr);
        	$this->exchangeArray($arr);
        	return true;
        }
        return false;
	}

	public function retainAll(Collection $collection)
	{
		$changed = false;
		foreach ($this->toArray() as $element)
		{
			if(!$collection->contains($element))
			{
				$this->remove($element);
				$changed = true;
			}
		}
		return $changed;
	}

	protected function set($index, $element)
	{
		$value = $this->get($index);
		return ($this[$index] = $element)
			? isset($value)
				? $value
				: null
			: false;
	}

	public function size()
	{
		return count($this);
	}

	public function toArray()
	{
		return $this->getArrayCopy();
	}

	protected function toSerializedArray()
	{
		$array = array();

		foreach ($this->getArrayCopy() as $value)
		{
			$array[] = serialize($value);
		}

		return $array;
	}

	public function __tostring()
	{
		$string = @get_class($this) . "[" . $this->size() . "] { ";
		$string .= implode(', ', $this->toArray());
		$string .= " }";
		return $string;
	}

}

?>