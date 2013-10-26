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
		$this->innerHTML($item);
		return $this;
	}

	public function addDataSet(array $dataset)
	{
		foreach ($dataset as $item)
		{
			$this->addItem($item);
		}
		return $this;
	}

	public function type($type)
	{
		$this->addAttr(array(
			'type' => $type
		));
		return $this;
	}
	
}

?>