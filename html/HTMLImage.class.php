<?php

class HTMLImage extends HTMLElement
{
	const TAG = "img";

	public static function element()
	{
		return parent::init();
	}

	public function src($src)
	{
		$this->addAttr(array('src' => $src));
		return $this;
	}

	public function alt($alt)
	{
		$this->addAttr(array('alt' => $alt));
		return $this;
	}

	public function width($width)
	{
		self::addAttr(array(
			'width' => $width
		));
		return $this;
	}

	public function height($height)
	{
		self::addAttr(array(
			'height' => $height
		));
		return $this;
	}
}

?>