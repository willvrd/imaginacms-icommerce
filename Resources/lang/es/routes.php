<?php

return [
  
  'store' => [
    'index' => [
      'index' => 'tienda',
      'category' => 'tienda/c/{categorySlug}',
      'manufacturer' => 'tienda/m/{manufacturerSlug}',
      'categoryManufacturer' => 'tienda/c/{categorySlug}/m/{manufacturerSlug}',
      'wishlist' => 'tienda/lista-de-deseos',
    ],
    
    'show' => [
      'product' => 'tienda/p/{productSlug}',
    ],
    
    'manufacturer' => [
      'index' => 'tienda/marcas',
      'show' => 'tienda/marcas/{manufacturerSlug}',
    ],
    
    'checkout' => 'tienda/checkout',
    'order' => [
      'index' => 'ordenes',
      'show' => 'ordenes/{orderId}'
    ]
  ],
];