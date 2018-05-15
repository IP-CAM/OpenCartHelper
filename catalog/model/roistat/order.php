<?php

class ModelRoistatOrder extends Model
{
    const  API_KEY = '';
    
    
    public function sendToRoistat($order_data, $order_id)
    {
//need to debug
     //  mail('youremail@mail.ru','ORDER ARRAY',print_r($order_data,1));
        $name = $order_data['firstname'] . ' '.$order_data['lastname'];
        $email = $order_data['email'];
        $phone = $order_data['telephone'];
        $product_string = '';
        $this->load->model('account/order');
        $products = $this->model_account_order->getOrderProducts($order_id);
        foreach ($products as $array){
            $product_string .= <<<EOF
        Название продукта: {$array['name']} в колличестве {$array['quantity']} на сумму {$array['total']}
EOF;
        }
        $comment = $order_data['comment'];
        $end_price = $order_data['total'];
        $site_name = $order_data['store_name'];
        $payment_method = $order_data['payment_method'];
        $adress = $order_data['shipping_address_1'].' '.$order_data['shipping_address_2'];
        $roistat_v = isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : '';
        $roistat_m = isset($_COOKIE['roistat_marker']) ? $_COOKIE['roistat_marker'] : '';
      $roistatData = array(
          'roistat' => $roistat_v,
          'key'     => ModelRoistatOrder::API_KEY, // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
          'title'   => 'Заказ №'.$order_id, // Название сделки
          'comment' => $comment, // Комментарий к сделке
          'name'    => $name, // Имя клиента
          'email'   => $email, // Email клиента
          'phone'   => $phone, // Номер телефона клиента
          'is_need_check_order_in_processing' => '1', // Включение проверки заявок на дубли
          'is_need_check_order_in_processing_append' => '1', // Если создана дублирующая заявка, в нее будет добавлен комментарий об этом
          'fields'  => array(
              'marker' => $roistat_m,
              'form_name' => 'Корзина',
              'site_name'=>$site_name,
              'total_price' => $end_price,
              'string_product' => $product_string,
              'payment_method' =>  $payment_method,
              'adress' =>$adress
          ),
      );
//need to debug
//            mail('youremail@mail.ru','ORDER ARRAY',print_r($roistatData,1));
    
        $contents=$this->SendCUrl($roistatData);
        
    }
    
    private function SendCUrl($roistatData){
        $url = "https://cloud.roistat.com/api/proxy/1.0/leads/add?". http_build_query($roistatData, '','&');
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
    }
    
}