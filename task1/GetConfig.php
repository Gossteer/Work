<?php

class GetConfig
{
    use Singleton;
    private $config = array();

    private function __construct()
    {
        $this->config = json_decode( file_get_contents('config.json'), true);
    }

    public function getConfigAttributes(string $section) : array
    {
        return $this->config[$section];
    }
}