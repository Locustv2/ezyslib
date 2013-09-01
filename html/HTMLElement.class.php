<?php

abstract class HTMLElement
{
	private $accessKey;
	private $htmlclass;
	private $hidden;
	private $id;
	private $style;
	private $title;
	private $innerHTML;

	private function __construct()
	{
		$this->accessKey = null;
		$this->htmlclass = new Set();
		$this->hidden = false;
		$this->id = null;
		$this->style = new Map();
		$this->title = null;
		$this->innerHTML = null;
	}

	public static function init()
	{
		return new static;
	}

	public function __get($attr)
	{
		return $this->$attr;
	}

	public function accessKey($key = null)
	{
		if(isset($key) and ($key !="") and is_string($key)) 
			$this->accessKey = $key[0];
		else
			return $this->accessKey;
		return $this;
	}

	public function htmlclass($class = null)
	{
		if(isset($class))
			$this->htmlclass->addEach(explode(" ", $class));
		else
			return $this->htmlclass;
		return $this;
	}

	public function hidden($hidden = null)
	{
		if(isset($hidden))
			$this->hidden = $hidden;
		else
			return $this->hidden;
		return $this;
	}

	public function id($id = null)
	{
		if(isset($id))
			$this->id = $id;
		else
			return $this->id;
		return $this;
	}

	public function style(array $styles = null)
	{
		if(isset($styles))
			$this->style->addEach($styles);
		else
			return $this->style;
		return $this;
	}

	public function title($title = null)
	{
		if(isset($title))
			$this->title = $title;
		else
			return $this->title;
		return $this;
	}

	public function innerHTML($html = null)
	{
		if(isset($html))
			$this->innerHTML = $html;
		else
			return $this->innerHTML;
		return $this;
	}

	public function __tostring()
	{
		return HTMLBuilder::parse($this);
	}

}

?>