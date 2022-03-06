<?php

return [
    'order' => [
        'fields' => [
            'user_id'        => [
                'type' => 'unsignedBigInteger',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, '\\App\\Models\\User::inRandomOrder()->first() ? \\App\\Models\\User::inRandomOrder()->first()->id : null'],
                'validation' => [
                    'create' => [
                        'integer' => 'true'
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'name'           => [
                'type' => 'string',
                'nullable' => false,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'surname'        => [
                'type' => 'string',
                'nullable' => false,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'email'          => [
                'type' => 'string',
                'nullable' => false,
                'unique' => true,
                'fillable' => true,
                'faker' => [true, 'email()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'email' => 'email:rfc,dns',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                        'email' => 'email:rfc,dns',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'phone'          => [
                'type' => 'string',
                'nullable' => false,
                'unique' => true,
                'fillable' => true,
                'faker' => [true, 'phoneNumber'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'comment'        => [
                'type'       => 'text',
                'nullable'   => true,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [true, 'text'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ],
            'street'         => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'home'           => [
                'type' => 'string',
                'nullable' => false,
                'unique' => true,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'apartment'      => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'entrance'       => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'floor'          => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'office'         => [
                'type' => 'unsignedBigInteger',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, '\\App\\Models\\PickupOffice::inRandomOrder()->first() ? \\App\\Models\\PickupOffice::inRandomOrder()->first()->id : null'],
                'validation' => [
                    'create' => [
                        'integer' => 'true'
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'status'         => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'payment_id'     => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'payment_status' => [
                'type' => 'string',
                'nullable' => true,
                'unique' => false,
                'fillable' => true,
                'faker' => [true, 'name()'],
                'validation' => [
                    'create' => [
                        'string' => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get' => [

                    ],
                ],
            ],
            'sum'            => [
                'type'      =>  'integer',
                'nullable'  =>  false,
                'unique'     => false,
                'fillable'   => true,
                'faker'      => [false, 'integer'],
                'validation' => [
                    'create' => [
                        'string'   => 'true',
                        'required' => 'true',
                    ],
                    'update' => [
                        'string' => 'true',
                    ],
                    'get'    => [

                    ],
                ],
            ]
        ],
        'requests' => [
            'create' => [
                'auth' => true,
            ],
            'update' => [
                'auth' => true,
            ],
            'get' => [
                'auth' => false,
            ],
        ],
        'softDeletes' => true,
        'pageLength' => 16,
    ]
];

