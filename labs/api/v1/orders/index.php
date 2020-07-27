<?php
    include_once "apiHandler.php";
     include_once "../../../labs/DBConnector.php";
    $api = new ApiHandler();
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        $api_key_correct = false;
        $headers = apache_request_headers();
        $header_api_key = $headers['Authorization'];
        $api->setUserApiKey($header_api_key);
        $api_key_correct = $api->checkApiKey();
        if ($api_key_correct) {
            if(!array_key_exists('check_order',$_POST)){
                $name_of_food = $_POST['name_of_food'];
                $number_of_units = $_POST['number_of_units'];
                $unit_price = $_POST['unit_price'];
                $order_status = $_POST['order_status'];

                $api->setMealName($name_of_food);
                $api->setMealUnits(intval($number_of_units));
                $api->setUnitPrice(floatval($unit_price));
                $api->setStatus($order_status);

                $res = $api->createOrder();

                if ($res) {
                    $response_array = ['success' => 0, 'message' => 'Order has been placed'];
                    echo json_encode($response_array);
                } else {
                    $response_array = ['success' => 1, 'message' => 'Order has NOT been placed'];
                    echo json_encode($response_array);
                }
            } else {
                $order_id = intval($_POST['order_id']);
                $res = $api->checkOrderStatus($order_id);
                if ($res) {
                    $response_array = ['success' => 0, 'message' => $res->fetch_assoc()['order_status']];
                    echo json_encode($response_array);
                } else {
                    $response_array = ['success' => 1, 'message' => "This order does not exist"];
                    echo json_encode($response_array);
                }

            }
        } else {
            $response_array = ['success' => 0, 'message' => 'Wrong API key'];
            header('Content-Type: application/json');
            echo json_encode($response_array);
        }
        
    } else if($_SERVER['REQUEST_METHOD'] === 'GET'){
        # code...
    } else {
        # code...
    }
    
?>