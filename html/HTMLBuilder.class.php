<?php

class HTMLBuilder
{

	public static function beta(HTMLElement $element)
	{
		$html = new DOMDocument();

		$node = $html->createElement($element::TAG, is_string($element->innerTEXT()) ? $element->innerTEXT() : null);
		$node->setAttribute('style', self::parseStyle($element->style));
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

	public static function getElementHTML(HTMLElement $element)
	{
		$html = new DOMDocument();
		$a = $html->appendChild(self::parseHTMLElement($html, $element));

		foreach ($element->innerHTML as $elem) 
		{
			$elemStack = self::getNestedElemStack($a, $element);

			$elem = $elemStack->pop();
			
			while(true)
			{
				if($elemStack->isEmpty())
					break;
				$elem2 = $elemStack->pop();
				$elem2->appendChild($elem);
				$elem = $elem2;
			}
		}
		$a->appendChild($elem);

		return $html->saveHTML();
	}

	public static function getElementHTMLx(HTMLElement $element)
	{		
		$html = new DOMDocument();
		$elemStack = self::getNestedElemStack($html, $element);

		$elem = $elemStack->pop();
		
		while(true)
		{
			if($elemStack->isEmpty())
				break;
			$elem2 = $elemStack->pop();
			$elem2->appendChild($elem);
			$elem = $elem2;
		}

		$html->appendChild($elem);

		return $html->saveHTML();
	}

	public function getNestedElemStack($doc, HTMLElement $element)
	{
		$stack = new Stack();

		$stack->add(self::parseHTMLElement($doc,$element));

		while(true)
		{
			if($element->innerHTML!== null and $element->innerHTML instanceof HTMLElement)
			{
				$element = $element->innerHTML;
				$stack->add(self::parseHTMLElement($doc, $element));
			}
			else
				break;
		}
		return $stack;
	}

	public function parseHTMLElement($doc, HTMLElement $element)
	{
		$node = $doc->createElement($element::TAG, is_string($element->innerTEXT()) ? $element->innerTEXT() : null);

		$element->accessKey and $node->setAttribute('accesskey', $element->accessKey);

		(count($element->htmlclass) > 0) and $node->setAttribute('class', self::parseClass($element->htmlclass));

		$element->hidden and $node->setAttribute('hidden', $element->hidden);

		$element->id and $node->setAttribute('id', $element->id);

		$element->addAttr and self::parseAdditionalAttributes($node, $element->addAttr);

		(count($element->style) > 0) and $node->setAttribute('style', self::parseStyle($element->style));

		$element->title and $node->setAttribute('title', $element->title);

		return $node;
	}

	public function parseClass(Set $class)
	{
		return implode(" ", $class->toArray());
	}

	public function parseStyle(Map $styles)
	{
		$html = '';
		foreach ($styles as $key => $value)
		{
			$html .= "$key: $value; ";
		}
		return $html;
	}

	public function parseAdditionalAttributes(DOMElement &$element, Map $attributes)
	{
		foreach ($attributes as $key => $value)
		{
			$element->setAttribute($key, $value);
		}
	}
}
?>