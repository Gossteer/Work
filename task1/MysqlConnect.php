<?php

trait MysqlConnect
{
    use Singleton;

    public function queryMysqlConnect(string $query)
    {
        return parent::query($query);
    }

    public function __destruct()
    {
        if ($this->close()) {
            echo "Подключение было закрыто.";
        } else {
            echo "Не удалось закрыть подключение.";
        }
    }

    protected function __construct() {
        $config = GetConfig::getInstance()->__get(__CLASS__);
        extract($config);
        parent::__construct($host, $username, $passwd, $dbname ?? null, $port ?? null, $socket ?? null);
//        $this->queryMysqlConnect(
//            "CREATE TABLE Invoice (
//                number INT PRIMARY KEY,
//                status VARCHAR(30) NOT NULL,
//                date DATE NOT NULL,
//                discount FLOAT NOT NULL
//                )"
//        );
//        $this->queryMysqlConnect(
//            "CREATE TABLE InvoiceComposition (
//                id INT AUTO_INCREMENT PRIMARY KEY,
//                sum FLOAT NOT NULL,
//                count FLOAT NOT NULL,
//                name VARCHAR(50) NOT NULL,
//                invoice_id INT,
//                FOREIGN KEY (invoice_id)  REFERENCES Invoice (number) ON DELETE CASCADE
//                )"
//        );
    }
}