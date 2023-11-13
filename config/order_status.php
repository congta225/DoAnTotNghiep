<?php

return [

    'order_status_admin' => [
        'pending' => [
            'status' => 'Chờ xử lý',
            'details' => 'Đơn đặt hàng của bạn hiện đang chờ xử lý'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Đã xử lý và sẵn sàng giao hàng',
            'details' => 'Đơn hàng của bạn đã được xử lý và sẽ sớm được giao cho bộ phận giao hàng của chúng tôi'
        ],
        'dropped_off' => [
            'status' => 'Đã giao tới shipper',
            'details' => 'Đơn hàng của bạn đã được giao cho bộ phận giao hàng của chúng tôi'
        ],
        'shipped' => [
            'status' => 'Chờ vận chuyển',
            'details' => 'Đơn hàng của bạn đã đến bên cơ sở vận chuyển của chúng tôi'
        ],
        'out_for_delivery' => [
            'status' => 'Đang giao hàng',
            'details' => 'Phụ tá đang giao đơn hàng tới bạn'
        ],
        'delivered' => [
            'status' => 'Đã giao hàng xong',
            'details' => 'Đơn hàng của bạn đã được giao'
        ],
        'canceled' => [
            'status' => 'Hủy đơn',
            'details' => 'Đơn hàng đã bị hủy'
        ]

    ],


    'order_status_vendor' => [
        'pending' => [
            'status' => 'Chờ xử lý',
            'details' => 'Đơn hàng đang chờ xác nhận'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Đã xử lý và sẵn sàng giao hàng',
            'details' => 'Đơn hàng của bạn đã được xử lý và sẽ sớm được giao cho bộ phận giao hàng của chúng tôi'
        ]
    ]
];
