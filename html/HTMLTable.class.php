<?php



class HTMLTable extends HTMLElement
{
	const TAG = "table";

	public static function element()
	{
		return parent::init();
	}

	

}

/*
class HTMLTable
{
	private $element;

	private $columns, $headers, $dataset;

	private $html;

	public function __construct($element=array())
	{
		$this->element = $element;
		$this->columns = explode(" " ,$element["columns"]);
		$this->headers = $element["headers"];
		$this->dataset = $element["dataset"];
		self::tableBuilder();
	}

	private function tableBuilder()
	{
		// Creating the  element in div
		$table = "<table id='{$this->element["id"]}' name='{$this->element["name"]}' class='{$this->element["class"]}' 
			width='{$this->element["width"]}' border='{self::getAttrVal({$this->element["border"]})}' >";
		
		// Adding the columns to the table
		$table .= self::generateColumns($this->columns);

		// Adding table header
		$table .= self::generateHeaders($this->headers);
		
		// Adding table rows
		$table .= self::generateRows($this->dataset);

		$table .= "</table>";
		$this->html = $table;
		echo "$this->html";
	}

	private function generateColumns($columns)
	{
		$columnsHTML = "<colgroup>";
		foreach ($columns as $width) 
		{
			$columnsHTML .= "<col class='' width='{$width}' />";
		}
		$columnsHTML .= "</colgroup>";
		return $columnsHTML;
	}

	private function generateHeaders($headers)
	{
		$headerHTML = "<tr>";
		foreach ($headers as $value) 
		{
			$headerHTML .= "<th class=''>{$value}</th>";
		}
		$headerHTML .= "</tr>";
		return $headerHTML;
	}

	private function generateRows($dataset)
	{
		$rowsHTML = '';
		foreach ($dataset as $row)
		{
			$rowsHTML .= "<tr class=''>";
			foreach ($row as $value) 
			{
				$rowsHTML .= "<td class=''>{$value}</td>";
			}
			$rowsHTML .= "</tr>";
		}
		return $rowsHTML;
	}



	private function getAttrVal($var)
	{
		return (isset($var))
			? $var
			: '';
	}


	public function display()
	{
		echo "$this->html";
	}

}*/

?>