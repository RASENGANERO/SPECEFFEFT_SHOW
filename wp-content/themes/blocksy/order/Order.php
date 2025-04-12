<?

require_once( '../../../../wp-load.php' );

require('../../../../wp-includes/PHPMailer/Exception.php');
require('../../../../wp-includes/PHPMailer/PHPMailer.php');
require('../../../../wp-includes/PHPMailer/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;

class Order{
    public string $username;
    public string $phone;
    public static string $mailLogin = 'order@speceffektshow.ru';
    public static string $mailPassword = 'IvGBDw%ADJh9';
    
    public function __construct($username, $phone) {
        $this->username = $username;
        $this->phone = $phone;
    }
    public function getItemsCartPrice(){
        return strval(WC()->cart->get_cart_contents_total());
    }
    public function getItemsCartCount(){
        return strval(WC()->cart->get_cart_contents_count());
    }
    
    public function getItemsCart(){
        $items =   WC()->cart->get_cart();
        $cartLists = [];
        foreach ($items as $cartItem) {
            $cartLists[] = [
                'NAME_ITEM' => $cartItem['data']->get_name(),
                'PRICE_ITEM' => $cartItem['data']->get_price().' ₽',
                'PRICE_ITEM_ALL' => $cartItem['line_total'].' ₽',
                'CART_ITEM_COUNT' => $cartItem['quantity']
            ];
        }
        return $cartLists;
    }
    public function getItemsCartOrder(){
        $items =   WC()->cart->get_cart();
        $orderItems = [];
        foreach ($items as $cartItem) {
            $orderItems[] = [
                'ORDER_ITEM_ID' => intval($cartItem['product_id']),
                'ORDER_ITEM_COUNT' => intval($cartItem['quantity']),
            ];
        }
        return $orderItems;
    }
    
    public function generateMail($items) {
        $html = '<table style="width: 100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr style="background-color: #f2f2f2;">';
        $html .= '<th style="border: 1px solid #dddddd; padding: 8px;">Название товара</th>';
        $html .= '<th style="border: 1px solid #dddddd; padding: 8px;">Цена за единицу</th>';
        $html .= '<th style="border: 1px solid #dddddd; padding: 8px;">Общая цена товара</th>';
        $html .= '<th style="border: 1px solid #dddddd; padding: 8px;">Количество товара</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($items as $item) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #dddddd; padding: 8px;">' . htmlspecialchars($item['NAME_ITEM']) . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; padding: 8px;">' . htmlspecialchars($item['PRICE_ITEM']) . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; padding: 8px;">' . htmlspecialchars($item['PRICE_ITEM_ALL']) . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; padding: 8px;">' . htmlspecialchars($item['CART_ITEM_COUNT']) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    }
    public function sendEmail(){

        $orderID = $this->createOrder();
        $itemsCarts = $this->getItemsCart();
        $body = $this->generateMail($itemsCarts);
        
        $body.= '<p><b>Общая стоимость: '.$this->getItemsCartPrice().' ₽'.'</b></p>';
        $body.= '<p><b>Общее количество товаров: '.$this->getItemsCartCount().'</b></p>';
        $body.= '<p><b>Имя клиента: '.$this->username.'</b></p>';
        $body.= '<p><b>Номер телефона клиента: '.$this->phone.'</b></p>';

        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;
        
        $mail->Host = 'ssl://smtp.beget.com';
        $mail->Port = 465;
        $mail->Username = Order::$mailLogin;
        $mail->Password = Order::$mailPassword;

        $mail->setFrom('order@speceffektshow.ru', 'speceffektshow.ru');
        $mail->addAddress('sveta_prozhoga@mail.ru');
        $mail->addAddress('speceffekt@yandex.ru');
        $mail->Subject = 'Новый заказ : '.$orderID;
        
        $mail->msgHTML($body);

        if(!$mail->send()) 
        {
            return [
                'status' => false,
                'message'=> "Mailer Error: " . $mail->ErrorInfo
            ];
        } 
        else 
        {
            return [
                'status' => true,
            ];
        }
    }
    public function createOrder(){
        $order = wc_create_order();
    
        $address = array(
            'first_name' => 'speceffectshow.ru',
            'last_name'  => 'Администратор',
            'company'    => 'SPECEFFECT SHOW',
            'email'      => 'speceffekt@yandex.ru',
            'phone'      => '8-928-375-13-93',
            'address_1'  => 'г. Москва Малая Филевская улица д. 5',
            'address_2'  => '100',
            'city'       => 'г. Москва',
            'state'      => 'Россия',
            'country'    => 'RU'
        );
    
        // Теперь можем задать этот адрес как платёжный
        $order->set_address( $address, 'billing' );

        $itemsOrder = $this->getItemsCartOrder();
        foreach ($itemsOrder as $orderItem) {
            $order->add_product( wc_get_product( $orderItem['ORDER_ITEM_ID']), $orderItem['ORDER_ITEM_COUNT']);
        }

        // Установим платёжный метод, например пусть это будет оплата наличными при получении
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        if( ! empty( $payment_gateways[ 'cod' ] ) ) {
            $order->set_payment_method( $payment_gateways[ 'cod' ] );
        }
    
        $order->calculate_totals();

        $order->update_status( 'completed' );
        $order->save();

        $orderID = $order->get_order_number();
        return $orderID;
        
    }
    public function clearCart(){
        WC()->cart->empty_cart();
    }
}

?>