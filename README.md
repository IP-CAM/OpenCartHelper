# OpenCartHelper
Скопировать в корень сайта затем зайти /catalog/model/checkout/order.php и добавить в конец функции `confirm($order_id, $order_status_id, $comment = '', $notify = false)`
следующие строки
```
            $order =$this->getOrder($order_id);
            $this->model_roistat_order->sendToRoistat($order, $order_id);
```
Затем перейти в функцию 
/catalog/model/roistat/order.php

вставить константу.
```
 const  API_KEY = '';
```

с 40 строчки указать свои кастомные поля, готово, вы великолепны.