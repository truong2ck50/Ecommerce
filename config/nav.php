<?php

    return [
            'admin' => [
                'top' => 
                    [
                        [ 
                            'name'  => 'Danh mục',
                            'route' => 'get_backend.category.index'
                        ],
                        [ 
                            'name'  => 'QL hãng',
                            'route' => 'get_backend.manufacturer.index'
                        ],
                        [ 
                            'name'  => 'Sản phẩm',
                            'route' => 'get_backend.product.index'
                        ],
                        [ 
                            'name'  => 'Từ khoá',
                            'route' => 'get_backend.keyword.index'
                        ],
                        [ 
                            'name'  => 'Đánh giá',
                            'route' => 'get_backend.vote.index'
                        ],
                        [ 
                            'name'  => 'Đơn hàng',
                            'route' => 'get_backend.transaction.index'
                        ],
                        [ 
                            'name'  => 'Kho hàng',
                            'route' => 'get_backend.warehouse.index'
                        ],
                        [ 
                            'name'  => 'Tag',
                            'route' => 'get_backend.tag.index'
                        ],
                        [ 
                            'name' => 'Menu',
                            'route' => 'get_backend.menu.index'
                        ],
                        [ 
                            'name'  => 'Bài viết',
                            'route' => 'get_backend.article.index'
                        ],        
                        [ 
                            'name'  => 'Thành viên',
                            'route' => 'get_backend.user.index'
                        ],
                        [ 
                            'name'  => 'Banner',
                            'route' => 'get_backend.slide.index'
                        ],
                        [ 
                            'name'  => 'Nhân viên',
                            'route' => 'get_backend.staff.index'
                        ],              
                    ]            
            ],
            'user' => [
                [
                    'name'  => 'Trang chủ',
                    'route' => 'get.home',
                    'icon'  => 'fa-home'
                ],
                [
                    'name'  => 'Tổng quan',
                    'route' => 'get_user.home',
                    'icon'  => 'fa-th-large'
                ],
                [
                    'name'  => 'Cập nhật thông tin',
                    'route' => 'get_user.profile',
                    'icon'  => 'fa-user', 
                    'param' => true
                ],
                [
                    'name'  => 'Cập nhật mật khẩu',
                    'route' => 'get_user.update.password',
                    'icon'  => 'fa-lock'
                ],
                [
                    'name'  => 'Sản phẩm yêu thích',
                    'route' => 'get_user.wishlist',
                    'icon'  => 'far fa-heart mr-1'
                ],
                [
                    'name'  => 'Đơn hàng',
                    'route' => 'get_user.transaction.index',
                    'icon'  => 'fa-cart-plus'
                ],
            ]
        ];