<?php

return [
    /*
    | Número de WhatsApp del negocio en formato internacional, solo dígitos.
    | Ejemplo Colombia: 57 + número. -> 573001234567
    | Se puede sobrescribir con la variable de entorno CARRITO_WHATSAPP.
    */
    'whatsapp' => env('CARRITO_WHATSAPP', '573026400248'),
];
