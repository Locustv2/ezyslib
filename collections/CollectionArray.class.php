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
			self::addEach($elements);
		}
		else if($elements instanceof Collection)
		{
			self::addAll($elements);
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
		return self::addEach($collection->toArray());
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
		foreach (self::toArray() as $key => $element)
		{
			unset($this[$key]);
		}
	}

	public function contains($element)
	{
		return @in_array($element, self::toArray(), true)
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
		return @array_key_exists($index, self::toArray())
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
		return isset($this[$index])
			? $this[$index]
			: null;
	}

	protected function indexOf($element)
	{
		return self::contains($element) 
			? @array_search($element, self::toArray(), true)
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
        	$arr = self::toArray();
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
		foreach (self::toArray() as $element)
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
		return self::getArrayCopy();
	}

	public function __tostring()
	{
		$string = @get_class($this) . "[" . self::size() . "] { ";
		$string .= implode(', ', self::toArray());
		$string .= " }";
		return $string;
	}

}

?>