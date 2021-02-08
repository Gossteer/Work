<?php

interface iConnectSet
{
    public function insert(string $query, array $attributes) : bool;
}