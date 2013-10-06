<?php

class HTMLTableColumnGroup extends HTMLElement
{
	const TAG = "colgroup";

	public static function element()
	{
		return parent::init();
	}

	public function addColumn($width)
	{
		$column = HTMLTableColumn::element()->width($width);
		self::innerHTML($column);
		return $this;
	}

}

?>