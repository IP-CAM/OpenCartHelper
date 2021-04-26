# Opencarthelper
Copy to the root of the site then log in /Catalog/Model/checkout/Order.php 
and add to the end of the 
`confirm function ($ Order_id, $ Order_status_id, $ comment = '', $ notify = false)`
The following rows
---
$ Order = $ This-> GetOrder ($ Order_ID);
$ this-> model_roistat_order-> SendToroistat ($ Order, $ Order_ID);
-
Then go to the function
/catalog/Model/ROistat/Order.php.

Insert a constant.
-
const api_key = '';
-

With 40 lines, specify your custom fields, ready, you are great.

-----

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
