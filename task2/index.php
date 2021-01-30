<?php

$startTime = new DateTime('now');

include_once ('ArrayIntersect.php');

function unset_string(array &$array) : array
{
    foreach ($array as $key => $value)
    {
        if (!is_numeric($value))
        {
            unset($array[$key]);
        }
    }
    return $array;
};

function intersect(array &$array1, array &$array2) : array
{
    $array = array();
    foreach ($array1 as $value1)
    {
        foreach ($array2 as $value2)
        {
            if ($value1 == $value2)
            {
                $array[] = (int)$value1;
            }
        }
    }

    return $array;
};

function array_intersect_int(array $array1, array $array2) : array
{
    unset_string($array1);
    unset_string($array2);
    if (count($array1) > count($array2))
    {
       return intersect($array1, $array2);
    }
    return intersect($array2, $array1);
};

//var_dump(array_intersect([3, 2, 5], [2, 1,4, 5])); Классический метод

var_dump(array_intersect_int([3, "size" => "XL", 2, "color" => "8", 5], [2, 1, "size" => "8", 4, "color" => "gold", 5])); //Скрипт

//Ня
//$array1 = new ArrayIntersect([3, "size" => "XL", 2, "color" => "8", 5]);
//$array2 = new ArrayIntersect([2, 1, "size" => "8", 4, "color" => "gold", 5]);
//
//var_dump(ArrayIntersect::array_intersect_int($array1 ,$array2));
$endTime = new DateTime('now');

echo $startTime->diff($endTime)->format('%S секунд, %f  микросекунд') . "кб\n";

echo round(memory_get_usage() / 1024, 2)  . "кб\n";
