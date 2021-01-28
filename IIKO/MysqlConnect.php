<?php

class MysqlConnect extends mysqli {
    public function __construct(string $host, string $user, string $password = "", string $dbname = "invoice_db", int $port = null) {
        parent::__construct($host, $user, $password, $dbname, $port);
        $this->queryMysqlConnect(
            "CREATE TABLE Invoice (
                number INT PRIMARY KEY,
                status VARCHAR(30) NOT NULL,
                date DATE NOT NULL,
                discount FLOAT NOT NULL
                )"
        );
        $this->queryMysqlConnect(
            "CREATE TABLE InvoiceComposition (
                id INT AUTO_INCREMENT PRIMARY KEY,
                sum FLOAT NOT NULL,
                count FLOAT NOT NULL,
                name VARCHAR(50) NOT NULL,
                invoice_id INT,
                FOREIGN KEY (invoice_id)  REFERENCES Invoice (number) ON DELETE CASCADE
                )"
        );
    }

    public function __destruct()
    {
        if ($this->close()) {
            echo "Подключение было закрыто.";
        } else {
            echo "Не удалось закрыть подключение.";
        }
    }

    public function queryMysqlConnect(string $query)
    {
        return parent::query($query);
    }
}