<?php

abstract class HTMLElement extends HTMLGlobalAttributes
{
	private $addAttr;
	private $innerHTML;
	private $innerTEXT;

	private function __construct()
	{
		$this->addAttr = new Map();
		$this->innerHTML = new ArrayList();
		$this->innerTEXT = null;
	}

	protected static function init()
	{
		return new static;
	}

	public function __get($attr)
	{
		return $this->$attr;
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
			{
				if($html instanceof HTMLElement)
					$this->innerHTML->addEach($html);
				else
					self::innerTEXT($html);
			}
			else
			{
				if($html instanceof HTMLElement)
					$this->innerHTML->add($html);
				else
					self::innerTEXT($html);
			}
		else
			return $this->innerHTML;
		return $this;
	}

	public function innerTEXT($text = null)
	{
		if(isset($text))
			$this->innerTEXT = "$text";
		else
			return $this->innerTEXT;
		return $this;
	}

	public function toNode(DOMDocument &$dom)
	{
		$node = $dom->createElement($this::TAG, is_string($this->innerTEXT()) ? $this->innerTEXT() : null);
		$this->accessKey and $node->setAttribute('accesskey', $this->accessKey);
		(count($this->htmlclass) > 0) and $node->setAttribute('class', HTMLBuilder::parseClass($this->htmlclass));
		$this->hidden and $node->setAttribute('hidden', $this->hidden);
		$this->id and $node->setAttribute('id', $this->id);
		$this->addAttr and HTMLBuilder::parseAdditionalAttributes($node, $this->addAttr);
		(count($this->style) > 0) and $node->setAttribute('style', HTMLBuilder::parseStyle($this->style));
		$this->title and $node->setAttribute('title', $this->title);

		foreach ($this->innerHTML as $innerElem)
		{
			$node->appendChild($innerElem->toNode($dom));
		}

		$dom->appendChild($node);
		return $node;
	}

	// For testing purposes (to be removed)
	public function toString()
	{
		return HTMLBuilder::buildHTML($this);
	}

	public function __tostring()
	{
		return HTMLBuilder::buildHTML($this);
	}

}