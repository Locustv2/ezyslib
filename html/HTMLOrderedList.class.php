<?php

class HTMLOrderedList extends HTMLElement
{
	const TAG = "ol";

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

	public function reversed($reversed = false)
	{
		if($reversed)
		{
			$this->addAttr(array(
				'reversed' => $reversed
			));
		}
		return $this;
	}
	
}