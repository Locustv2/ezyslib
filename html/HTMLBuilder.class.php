<?php

class HTMLBuilder
{
	public static function getElementHTML(HTMLElement $element)
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

	private function getNestedElemStack(DOMDocument $doc, HTMLElement $element)
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

	private function parseHTMLElement(DOMDocument $doc, HTMLElement $element)
	{
		$node = $doc->createElement($element::TAG, is_string($element->innerHTML()) ? $element->innerHTML() : null);

		$node->setAttribute('style', self::parseStyle($element->style));

		$element->accessKey and $node->setAttribute('accesskey', $element->accessKey);

		(count($element->htmlclass) > 0) and $node->setAttribute('class', self::parseClass($element->htmlclass));

		$element->hidden and $node->setAttribute('hidden', $element->hidden);

		$element->id and $node->setAttribute('id', $element->id);

		$element->addAttr and self::parseAdditionalAttributes($node, $element->addAttr);

		(count($element->style) > 0) and $node->setAttribute('style', self::parseStyle($element->style));

		$element->title and $node->setAttribute('title', $element->title);

		return $node;
	}

	private function parseClass(Set $class)
	{
		return implode(" ", $class->toArray());
	}

	private function parseStyle(Map $styles)
	{
		$html = '';
		foreach ($styles as $key => $value)
		{
			$html .= "$key: $value; ";
		}
		return $html;
	}

	private function parseAdditionalAttributes(DOMElement &$element, Map $attributes)
	{
		foreach ($attributes as $key => $value)
		{
			$element->setAttribute($key, $value);
		}
	}
}

?>