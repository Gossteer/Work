<?php

class GetConfig
{
    use Singleton;
    private $config = array();

    private function __construct()
    {
        $this->config = parse_ini_file('.ini', true);
//        var_dump($this->config);
    }

    public function __get($namesection)
    {
        return $this->config[$namesection];
    }
}