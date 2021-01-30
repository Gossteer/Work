<?php
define('STATUS', [0 => 'Не оплачен', 1 => 'Оплачен']);

class Invoice  implements IteratorAggregate
{
    /**
     * @var int $number
     */
    private int $number;
    //private const STATUS = [0 => 'Не оплачен', 1 => 'Оплачен'];
    /**
     * @var string $status
     */
    private string $status;
    /**
     * @var string $date
     */
    private string $date;
    /**
     * @var float $discount (0-1)
     */
    public float $discount;
    private $invoiceComposition = array();

    public function __construct(int $number, int $status = 0, string $date = null, float $discount = 0)
    {
        $this->setNumber($number);
        $this->setStatus($status);
        $this->setDate($date ?? date("d.m.Y"));
        $this->discount = $discount;
    }

    /**
     * @return int $this->number
     */
    public function getNumber() :int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
    }

    /**
     * @return string $this->status
     */
    public function getStatus() :string
    {
        return $this->status;
    }

    /**
     * @param int $status in [0 => 'Не оплачен', 1 => 'Оплачен']
     */
    public function setStatus(int $status)
    {
        if (!in_array(STATUS[$status], STATUS))
        {
            throw new Exception('Данного статуса не существует');
        }
        $this->status = STATUS[$status];
    }

    /**
     * @return int $this->date
     */
    public function getDate() :string
    {
        return $this->date;
    }

    /**
     * @param int $date (dd.mm.yyyy)
     */
    public function setDate(string $date)
    {
        $date = date('d.m.Y', strtotime($date));
        if (!preg_match('/^(\d{1,2})\.(\d{1,2})(?:\.(\d{4}))?$/',$date))
        {
            throw new Exception('Формат даты указан неверно. Пример: 21.01.2020');
        }
        $this->date = $date;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->invoiceComposition);
    }
 
    public function addInvoiceComposition(int $id, string $name, float $sum = 0, float $count = 0)
    {
        $this->invoiceComposition[$id] = new InvoiceComposition($id, $name, $sum, $count);
    }

    public function deleteInvoiceComposition(int $id)
    {
        unset($this->invoiceComposition[$id]);
    }

//    public function __set($name, $value)
//    {
//        $this->$name = $value;
//    }
//
//    public function __get($name)
//    {
//        return $this->$name;
//    }

    /**
     * @return int SummInvoice with discoutn
     */
    public function getSummInvoice() :float
    {
        foreach ($this->invoiceComposition as $invoiceComposition)
        {
            $sum += $invoiceComposition->sum * $invoiceComposition->count;
        }

        $sum = (1 - $this->discount) * $sum;

        return $sum;
    }

    public function save(MysqlConnect $mysqlConnect)
    {
        $date = date('Y-m-d', strtotime($this->date));
        $mysqlConnect->queryMysqlConnect(
            "INSERT INTO Invoice (number, status, date, discount)
                VALUES ($this->number, '$this->status', '$date', $this->discount)"
        );

        foreach ($this->invoiceComposition as $invoiceComposition)
        {
            $mysqlConnect->queryMysqlConnect(
                "INSERT INTO InvoiceComposition (sum, count, name, invoice_id)
                VALUES ($invoiceComposition->sum, '$invoiceComposition->count', '$invoiceComposition->name', '$this->number')"
            );
        }

    }

    public static function getInvoicesDB(MysqlConnect $mysqlConnect, string $select = '*', string $where = null) : array
    {
        $where = $where ? 'WHERE ' . $where : "";
        $result = $mysqlConnect->query(
            "
                SELECT $select FROM Invoice $where
            "
        );
        if ($result->num_rows == 0)
        {
            throw new Exception('Записи не найдены');
        } else
        {
            $result=$result->fetch_all(MYSQLI_ASSOC);
            foreach ($result as $row){
                $invoces[] = new Invoice($row['number'], array_search($row['status'], STATUS), $row['date'], $row['discount']);
                $recultCompositions = $mysqlConnect->query(
                    "
                SELECT * FROM invoicecomposition WHERE invoice_id = $row[number]
            "
                );
                if ($recultCompositions->num_rows == 0)
                {
                    continue;
                }
                $recultCompositions=$recultCompositions->fetch_all(MYSQLI_ASSOC);
                foreach ($recultCompositions as $rowCompositions)
                {
                    $invoces[count($invoces)  - 1]->addInvoiceComposition($rowCompositions['id'], $rowCompositions['name'], $rowCompositions['sum'], $rowCompositions['count']);
                }
            }
            return $invoces;
        }

    }

}


