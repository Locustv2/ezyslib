<?php

$seq1 = new ArrayList(array(4,1,4,2,3));
$seq2 = new ArrayList(array(5,1,4,2,-1,6));

//echo "$seq1 <br/> $seq2";


foreach ($seq1 as $key => $value)
{
	echo "$key => $value </br>";
}


$map = new Map();

$map->put("a", 1);
$map->put("b", 2);
$map->put("c", 3);
$map->put("d", 4);
$map->put("e", 5);



?>