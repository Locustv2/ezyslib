<?php

abstract class HTMLGlobalAttributes
{
	protected $accessKey = null;
	protected $htmlclass = null;
	protected $hidden = false;
	protected $id = null;
	protected $style = null;
	protected $title = null;

	public function accessKey($key = null)
	{
		if(!is_null($key) and ($key !="") and is_string($key)) 
		{
			$this->accessKey = $key[0];
		}
		else
		{
			return $this->accessKey;
		}
		return $this;
	}

	public function htmlclass($class = null)
	{
		if(!is_null($class))
		{
			!is_null($this->htmlclass) ?: $this->htmlclass = new Set();
			$this->htmlclass->addEach(explode(" ", $class));
		}
		else
		{
			return $this->htmlclass;
		}
		return $this;
	}

	public function hidden($hidden = null)
	{
		if(!is_null($hidden))
		{
			$this->hidden = $hidden;
		}
		else
		{
			return $this->hidden;
		}
		return $this;
	}

	public function id($id = null)
	{
		if(!is_null($id))
		{
			$this->id = str_replace(' ','',$id);
		}
		else
		{
			return $this->id;
		}
		return $this;
	}

	public function style(array $styles = null)
	{
		if(!is_null($styles))
		{
			!is_null($this->style) ?: $this->style = new Map();
			$this->style->addEach($styles);
		}
		else
		{
			return $this->style;
		}
		return $this;
	}

	public function title($title = null)
	{
		if(!is_null($title))
		{
			$this->title = $title;
		}
		else
		{
			return $this->title;
		}
		return $this;
	}

}