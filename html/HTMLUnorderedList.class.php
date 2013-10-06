<?php

class HTMLUnorderedList extends HTMLElement
{
	const TAG = "ul";

	public static function element()
	{
		return parent::init();
	}

	public function addItem($item)
	{
		$item = HTMLListItem::element()->innerHTML($item);
		self::innerHTML($item);
		return $this;
	}

	public function addDataSet(array $dataset)
	{
		foreach ($dataset as $item)
		{
			self::addItem($item);
		}
		return $this;
	}

	public function type($type)
	{
		self::addAttr(array(
			'type' => $type
		));
		return $this;
	}
	
}

?>