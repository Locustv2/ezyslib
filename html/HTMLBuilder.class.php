<?php

class HTMLBuilder
{
	public static function parse(HTMLElement $element)
	{		
		$html = new DOMDocument();
		/*
		$elem = $html->createElement($element::TAG, is_string($element->innerHTML()) ? $element->innerHTML() : null);

		$element->accessKey and $elem->setAttribute('accesskey', $element->accessKey);

		(count($element->htmlclass) > 0) and $elem->setAttribute('class', HTMLBuilder::parseClass($element->htmlclass));

		$element->hidden and $elem->setAttribute('hidden', $element->hidden);

		$element->id and $elem->setAttribute('id', $element->id);

		(count($element->style) > 0) and $elem->setAttribute('style', HTMLBuilder::parseStyle($element->style));

		$element->title and $elem->setAttribute('title', $element->title);

		$html->appendChild($elem);
*/
		$test = HTMLBuilder::createElement($html, $element);

		if($element->innerHTML !== null and $element->innerHTML instanceof HTMLElement)
		{
			$nested = HTMLBuilder::createElement($html, $element->innerHTML);
			$test->appendChild($nested);
		}
		$html->appendChild($test);

		return $html->saveHTML();
	}


	private static function createElement(DOMDocument &$dom, HTMLElement $element)
	{
		$elem = $dom->createElement($element::TAG, is_string($element->innerHTML()) ? $element->innerHTML() : null);

		$element->accessKey and $elem->setAttribute('accesskey', $element->accessKey);

		(count($element->htmlclass) > 0) and $elem->setAttribute('class', HTMLBuilder::parseClass($element->htmlclass));

		$element->hidden and $elem->setAttribute('hidden', $element->hidden);

		$element->id and $elem->setAttribute('id', $element->id);

		(count($element->style) > 0) and $elem->setAttribute('style', HTMLBuilder::parseStyle($element->style));

		$element->title and $elem->setAttribute('title', $element->title);

		return $elem;
	}

	private static function parseClass(Set $class)
	{
		return implode(" ", $class->toArray());
	}

	private static function parseStyle(Map $style)
	{
		$html = '';
		foreach ($style as $key => $value)
		{
			$html .= "$key: $value; ";
		}
		return $html;
	}
}

?>