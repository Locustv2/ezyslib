<?php

class HTMLTable extends HTMLElement
{
	const TAG = "table";

	public static function element()
	{
		return parent::init()->border()->width();
	}

	public function border($border = 1)
	{
		self::addAttr(array(
			'border' => $border
		));
		return $this;
	}

	public function width($width = '100%')
	{
		self::addAttr(array(
			'width' => $width
		));
		return $this;
	}

	public function caption($caption, $align = 'bottom')
	{
		$this->innerHTML(HTMLTableCaption::element()->innerHTML("$caption")->addAttr(array('align' => $align)));
		return $this;
	}

	public function addHeader()
	{
		$headers = func_get_args();
		$tr = HTMLTableRow::element();
		foreach ($headers as $header)
		{
			$th = HTMLTableHeader::element()->innerHTML($header);
			$tr->innerHTML($th);
		}
		$this->innerHTML($tr);
		return $this;
	}

	public function addRow()
	{
		$columns = func_get_args();
		$tr = HTMLTableRow::element();
		foreach ($columns as $column)
		{
			if(!is_array($column))
			{
				$td =  HTMLTableDiv::element()->innerHTML($column);
				$tr->innerHTML($td);
			}
			else
			{
				foreach ($column as $value)
				{
					$td = HTMLTableDiv::element()->innerHTML($value);
					$tr->innerHTML($td);
				}
			}
		}
		$this->innerHTML($tr);
		return $this;
	}

	public function addDataSet(array $dataset)
	{
		foreach ($dataset as $row)
		{
			self::addRow($row);
		}
		return $this;
	}

	public function rowSpan($row, $col, $span)
	{
		$this->innerHTML[$row]->innerHTML[$col]->addAttr(array('rowspan' => $span));
		return $this;
	}

	public function colSpan($row, $col, $span)
	{
		$this->innerHTML[$row]->innerHTML[$col]->addAttr(array('colspan' => $span));
		return $this;
	}	

}


class HTMLTableRow extends HTMLElement
{
	const TAG = "tr";

	public static function element()
	{
		return parent::init();
	}

}

class HTMLTableHeader extends HTMLElement
{
	const TAG = "th";

	public static function element()
	{
		return parent::init();
	}

}

class HTMLTableDiv extends HTMLElement
{
	const TAG = "td";

	public static function element()
	{
		return parent::init();
	}

}

class HTMLTableCaption extends HTMLElement
{
	const TAG = "caption";

	public static function element()
	{
		return parent::init();
	}

}

?>