<?php

interface iConnectGet
{
    public function fetchAll (string $query, array $attributes) : array;
}
