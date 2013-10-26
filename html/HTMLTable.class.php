<?php

class HTMLTable extends HTMLElement
{
	const TAG = "table";
	private $colgroup;

	public static function element()
	{
		return parent::init()->border()->width()->columns();
	}

	public function border($border = 1)
	{
		$this->addAttr(array(
			'border' => $border
		));
		return $this;
	}

	public function width($width = '100%')
	{
		$this->addAttr(array(
			'width' => $width
		));
		return $this;
	}

	public function columns($widths = null)
	{
		$this->innerHTML->remove($this->colgroup);
		$columns = explode(' ', $widths);
		$this->colgroup = HTMLTableColumnGroup::element();
		if(isset($widths))
		{
			$this->width(0);
			foreach ($columns as $width)
			{
				$this->colgroup->addColumn($width);
			}
		}
		$this->innerHTML($this->colgroup);
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
			$this->addRow($row);
		}
		return $this;
	}

	public function rowSpan($row, $col, $span)
	{
		$row++;
		$this->innerHTML[$row]->innerHTML[$col]->addAttr(array('rowspan' => $span));
		return $this;
	}

	public function colSpan($row, $col, $span)
	{
		$row++;
		$this->innerHTML[$row]->innerHTML[$col]->addAttr(array('colspan' => $span));
		return $this;
	}	

}

?>
