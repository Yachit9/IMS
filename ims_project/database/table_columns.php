<?php

$table_columns_mapping=[
    'users'=>[
        'firstname','lastname','email','password','created_at','updated_at'
    ],
    'products'=>[
        'product_name','description','created_by','created_at','updated_at'
    ],
    'suppliers'=>[
        'supplier_name','supplier_location','email','created_by','created_at','updated_at'
    ],
    'order_product'=>[
        'supplier','product','quantity_ordered','quantity_recieved','created_by','created_at','updated_at'
    ]
    ];