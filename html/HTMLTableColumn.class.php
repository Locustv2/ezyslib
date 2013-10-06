<?php

class HTMLTableColumn extends HTMLElement
{
	const TAG = "col";

	public static function element()
	{
		return parent::init();
	}

	public function width($width = '100%')
	{
		self::addAttr(array(
			'width' => $width
		));
		return $this;
	}

}

?>