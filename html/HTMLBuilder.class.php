<?php

class HTMLBuilder
{

	public static function buildHTML(HTMLElement $element)
	{
		$html = new DOMDocument();

		$node = $html->createElement($element::TAG, is_string($element->innerTEXT()) ? $element->innerTEXT() : null);
		$element->accessKey and $node->setAttribute('accesskey', $element->accessKey);
		(count($element->htmlclass) > 0) and $node->setAttribute('class', self::parseClass($element->htmlclass));
		$element->hidden and $node->setAttribute('hidden', $element->hidden);
		$element->id and $node->setAttribute('id', $element->id);
		$element->addAttr and self::parseAdditionalAttributes($node, $element->addAttr);
		(count($element->style) > 0) and $node->setAttribute('style', self::parseStyle($element->style));
		$element->title and $node->setAttribute('title', $element->title);

		foreach ($element->innerHTML as $innerElem)
		{
			$node->appendChild($innerElem->toNode($html));
		}

		$html->appendChild($node);
		return $html->saveHTML();
	}

	public static function parseClass(Set $class)
	{
		return implode(" ", $class->toArray());
	}

	public static function parseStyle(Map $styles)
	{
		$html = '';
		foreach ($styles as $key => $value)
		{
			$html .= "$key: $value; ";
		}
		return $html;
	}

	public static function parseAdditionalAttributes(DOMElement &$element, Map $attributes)
	{
		foreach ($attributes as $key => $value)
		{
			$element->setAttribute($key, $value);
		}
	}
}
?>