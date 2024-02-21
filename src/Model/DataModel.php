<?php

namespace Mdvor\TestOneNofw\Model;

use Mdvor\TestOneNofw\Config\CalcNumbbers;

class DataModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DBInteractor();
    }

    function getZones()
    {
        $this->db->connect();
        $zones = $this->db->makeSelect("select code, shipping from zones order by code;");
        $this->db->disconnect();

        return $zones;
    }

    function uploadCsv()
    {
        $arr = $this->csvToArray($_FILES["csv"]["tmp_name"]);
        $this->db->connect();
        foreach ($arr as $row) {
            $this->saveZoneToDB($row);
        }
        $this->db->disconnect();
    }

    function calcShipping($code, $amount, $long = false, $errors = [])
    {
        $zone = substr($code, 0, 2);
        $this->db->connect();
        $escapedZone = $this->db->escape($zone);
        $res = $this->db->makeSelect("select shipping from zones where code = '" . $escapedZone . "';");
        $shipping = $res[0]['shipping'] ?? 0;
        if ($long) {
            $shipping += CalcNumbbers::ADDITIONAL_SHIPPING;
        }
        if ($amount > CalcNumbbers::DISCOUNT_ORDER_AMOUNT) {
            $shipping *= (1 - CalcNumbbers::DISCOUNT/100);
        }
        $this->db->disconnect();

        return $shipping;
    }

    function saveOrder($postcode, $amount, $long, $shipping)
    {
        $this->db->connect();

        $escPostcode = $this->db->escape($postcode);
        $escAmount = $this->db->escape($amount);
        $escLong = $this->db->escape($long);

        $this->db->runSQL("insert into user_order(post_code, long_product, amount, shipping_amount)
            values('" . $escPostcode ."', " . $escLong . ", ". $escAmount .", ". $shipping .")");

        $this->db->disconnect();
    }

    private function csvToArray($filePath)
    {
        $csvFile = fopen($filePath, 'r');
        $data = [];
        while (($row = fgetcsv($csvFile)) !== false) {
            $data[] = $row;
        }
        fclose($csvFile);

        return $data;
    }

    private function saveZoneToDB($row)
    {
        $zoneCode = $this->db->escape($row[0]);
        $shipping = $this->db->escape($row[1]);
        $this->db->runSQL("insert into zones(code, shipping) values('".$zoneCode."', ".$shipping.")
        on duplicate key update shipping = ".$shipping.";");
    }
}