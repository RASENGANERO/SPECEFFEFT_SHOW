<?

header('Content-type: application/json');
require('Order.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['name'];
    $phone = $_POST['phone'];
    $order = new Order($username,$phone);
    $result = $order->sendEmail();
    if($result['status'] === true) {
        $order->clearCart();
        echo json_encode(array('result' => 'Заказ создан !'));
    }
    else{
        echo json_encode(array('result' => $result['message']));
    }
}

?>