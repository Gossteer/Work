<?php

trait Connect
{
    private $connect;
    private $db;

    public function host_info() : string
    {
        return $this->connect->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }

    private function prepare(string $query, array $attributes) : PDOStatement
    {
        $prepare = $this->connect->prepare($query);
        if (!$prepare->execute($attributes)){
            throw new Exception('Запрос не выполнен');
        }

        return $prepare;
    }

    public function insert(string $query, array $attributes) : bool
    {
        $this->prepare($query,$attributes);

        return true;
    }

    public function fetchAll(string $query, array $attributes) : array
    {
        return $this->prepare($query,$attributes)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function close() : void
    {
        $this->connect = null;
    }

    private function __destruct()
    {
        $this->close();
    }

    protected function __construct() {
        foreach (GetConfig::getInstance()->getConfigAttributes("Connect") as $keydb => $valuedb)
        {
            if (array_key_exists(__CLASS__, $valuedb))
            {
                $this->db = mb_strtolower($keydb);
                extract($valuedb[__CLASS__]);
                break;
            }
        }
        try {
            $this->connect = new PDO($this->db.":host=$host;port=". ($port ?? '3306') .";dbname=".($dbname ?? null), $username, $passwd);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }

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