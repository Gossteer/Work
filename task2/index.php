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

function array_Intersect_int_vector(array $array1, array $array2) : array
{
    $set = new \Ds\Vector([5,'lol' => 1, 2 => "lol", "3", 1]);

    return $set->merge(['lol' => 1, 2 => "lol", "3", 2, 5])->filter(function($value) use($set){
        return is_int($value) and $set->contains($value);
    })->toArray();
}

//var_dump(array_intersect([3, 2, 5], [2, 1,4, 5])); Классический метод

var_dump(array_intersect_int([3, "size" => "XL", 2, "color" => "8", 5], [2, 1, "size" => "8", 4, "color" => "gold", 5])); //Скрипт (Затрачивает больше времени, но потребляет меньше памяти)?

$lol = [null];
$lol1 = ['lol'];

if ($lol === []) echo count($lol) . 'lol' . "\n";
if ($lol1) echo 'lol1' . "\n";
//var_dump(array_Intersect_int_vector([3, "size" => "XL", 2, "color" => "8", 5], [2, 1, "size" => "8", 4, "color" => "gold", 5])); //Скрипт (Затрачивает меньше времени, но потребляет больше памяти)?

//Ня
//$array1 = new ArrayIntersect([3, "size" => "XL", 2, "color" => "8", 5]);
//$array2 = new ArrayIntersect([2, 1, "size" => "8", 4, "color" => "gold", 5]);
//
//var_dump(ArrayIntersect::array_intersect_int($array1 ,$array2));
$endTime = new DateTime('now');

echo $startTime->diff($endTime)->format('%S секунд, %s  микросекунд') . "кб\n";

echo memory_get_usage() / 1024  . "кб\n";
