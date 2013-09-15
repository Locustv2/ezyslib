<?php

abstract class HTMLElement
{
	private $accessKey;
	private $htmlclass;
	private $hidden;
	private $id;
	private $style;
	private $title;
	private $addAttr;
	private $innerHTML;
	private $innerTEXT;

	private function __construct()
	{
		$this->accessKey = null;
		$this->htmlclass = new Set();
		$this->hidden = false;
		$this->id = null;
		$this->style = new Map();
		$this->title = null;
		$this->addAttr = new Map();
		$this->innerHTML = new ArrayList();
		$this->innerTEXT = null;
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
			$this->id = str_replace(' ','',$id);
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

	public function addAttr(array $attr = null)
	{
		if(isset($attr))
			$this->addAttr->addEach($attr);
		else
			return $this->style;
		return $this;
	}

	public function innerHTML($html = null)
	{
		if(isset($html))
			if(is_array($html))
				$this->innerHTML->addEach($html);
			else
				$this->innerHTML->add($html);
		else
			return $this->innerHTML;
		return $this;
	}

	public function innerTEXT($text = null)
	{
		if(isset($text))
			$this->innerTEXT = $text;
		else
			return $this->innerTEXT;
		return $this;
	}

	public function toNode($html)
	{
		$node = $html->createElement($this::TAG, is_string($this->innerTEXT()) ? $this->innerTEXT() : null);
		$this->accessKey and $node->setAttribute('accesskey', $this->accessKey);
		(count($this->htmlclass) > 0) and $node->setAttribute('class', HTMLBuilder::parseClass($this->htmlclass));
		$this->hidden and $node->setAttribute('hidden', $this->hidden);
		$this->id and $node->setAttribute('id', $this->id);
		$this->addAttr and HTMLBuilder::parseAdditionalAttributes($node, $this->addAttr);
		(count($this->style) > 0) and $node->setAttribute('style', HTMLBuilder::parseStyle($this->style));
		$this->title and $node->setAttribute('title', $this->title);

		foreach ($this->innerHTML as $innerElem)
		{
			$node->appendChild($innerElem->toNode($html));
		}

		$html->appendChild($node);
		return $node;
	}

	public function toString()
	{
		return HTMLBuilder::beta($this);
	}

	public function __tostring()
	{
		return HTMLBuilder::beta($this);
	}

}

?>