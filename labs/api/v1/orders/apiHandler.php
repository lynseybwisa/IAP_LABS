<?php
 include_once "../../../labs/DBConnector.php";
class ApiHandler
{
    private $meal_name;
    private $meal_units;
    private $unit_price;
    private $status;
    private $user_api_key;

    public function setMealName($meal_name)
    {
        $this->meal_name = $meal_name;
    }

    public function getMealName()
    {
        return $this->meal_name;
    }

    public function setMealUnits($meal_units)
    {
        $this->meal_units = $meal_units;
    }

    public function getMealUnits()
    {
        return $this->meal_units;
    }

    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;
    }

    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setUserApiKey($key)
    {
        $this->user_api_key = explode(" ",$key)[1];
    }

    public function getUserApiKey()
    {
        return $this->user_api_key;
    }

    public function createOrder()
    {
        $db = new DBConnector();
        $res = $db->conn->query("INSERT INTO orders(order_name, units, unit_price, order_status) ".
        "VALUES ('$this->meal_name',$this->meal_units,$this->unit_price,'$this->status')");
        if ($res === FALSE) {
            die("Error: " . $db->conn->error);
        }
        return $res;
    }

    public function checkOrderStatus($order_id)
    {
        $db = new DBConnector();
        $res = $db->conn->query("SELECT order_status FROM orders WHERE order_id = $order_id");
        if ($res === FALSE) {
            die("Error: " . $db->conn->error);
        }
        return $res;
    }

    public function fetchAllOrders()
    {
        
    }

    public function checkApiKey()
    {
        $api_key = $this->getUserApiKey();
        $db = new DBConnector();
        $conn = $db->conn;
        $res = $conn->query("SELECT * FROM api_keys WHERE api_key = '$api_key'");
        if ($res===FALSE) {
            return false;
        } else {
            return $res->num_rows == 1;
        }
    }

    public function checkContentType()
    {
        
    }
}

?>