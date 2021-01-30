<?php


class ArrayIntersect extends ArrayIterator
{
    public function __construct(array $array = array(), $flags = 0)
    {
        parent::__construct(array_values($array), $flags);
        $this->unset_string();
    }

    private function unset_string()
    {
        //Занимает больше памяти
//        foreach ($this as $key => $value)
//        {
//            if (!is_numeric($value))
//            {
//                unset($this[$key]);
//            }
//        }
        while($this->valid())
        {
            if (!is_numeric($this->current()))
            {
                $this->offsetUnset($this->key());
            }
            $this->next();
        }
    }

    private static function intersect(ArrayIntersect  &$array1, ArrayIntersect &$array2) : ArrayIntersect
    {
        $array = new ArrayIntersect();
        foreach ($array1 as $value1)
        {
            foreach ($array2 as $value2)
            {
                if ($value1 == $value2)
                {
                    $array->append((int)$value1);
                }
            }
        }

        return $array;
    }

    public static function array_intersect_int(ArrayIntersect &$array1, ArrayIntersect &$array2) : ArrayIntersect
    {
        if (count($array1) > count($array2))
        {
            return ArrayIntersect::intersect($array1, $array2);
        }
        return ArrayIntersect::intersect($array2, $array1);
    }

}



echo round(memory_get_usage() / 1024, 2)  . "кб\n";