<?php

class HTMLAnchor extends HTMLElement
{
	const TAG = "a";

	public static function element()
	{
		return parent::init();
	}

	public function url($url)
	{
		$this->addAttr(array('href' => $url));
		return $this;
	}

	public function target($target)
	{
		$this->addAttr(array('target' => $target));
		return $this;
	}
}