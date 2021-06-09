<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">   
        
        <!-- Styles -->
        <style>
            body {
                font-family: DejaVu Sans;
                background-color: gray;
            }

            .padding {
                padding: 2rem !important
            }

            .card {
                margin-bottom: 30px;
                border: none;
                -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
            }

            .card-header {
                background-color: #fff;
                border-bottom: 1px solid #e6e6f2
            }

            h3 {
                font-size: 20px
            }

            h5 {
                font-size: 15px;
                line-height: 26px;
                color: #3d405c;
                margin: 0px 0px 15px 0px;
                font-family: 'Circular Std Medium'
            }

            .text-dark {
                color: #3d405c !important
            }
        </style>
    </head>
    <body>
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
            <div class="card">
                <div class="card-header p-4">
                    <a class="pt-2 d-inline-block" target="_blank" href="{{ route('get.home') }}" data-abc="true">Công ty TNHH Thiết bị Kỹ thuật Tin học Trường Chinh</a>
                    <div class="float-right">
                        <h3 class="mb-0">Đơn hàng #{{ $transaction->id }}</h3>
                        {{ $transaction->created_at }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">Gửi từ:</h5>
                            <h3 class="text-dark mb-1">Trường Chinh Computer</h3>
                            <div>Địa chỉ: 78 Quốc lộ 3, thôn Phù Mã, X. Phù Linh, H. Sóc Sơn, TP. Hà Nội</div>
                            <div>Email: truong2ck50@gmail.com</div>
                            <div>Điện thoại: 0971459902</div>
                        </div>
                        <div class="col-sm-6 ">
                            <h5 class="mb-3">Đến:</h5>
                            <h3 class="text-dark mb-1">{{$transaction->t_name}}</h3>
                            <div>Địa chỉ: {{ $transaction->t_address }}</div>
                            <div>Email: {{ $transaction->t_email }}</div>
                            <div>Điện thoại: {{ $transaction->t_phone }}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Khuyến mãi</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $item)    
                                <tr>
                                    <td style="width: 300px">{{ $item->product->pro_name ?? '' }}</td>
                                    <td>
                                        <a href="">
                                            <img src="{{ pare_url_file($item->product->pro_avatar) ?? '' }}" class="img-thumbnail" style="width: 60px; height: 60px;" alt="">
                                        </a>
                                    </td>
                                    <td><span class="text-danger">{{ number_format($item->od_price, 0, ',', '.') }} đ</span></td>
                                    <td>{{ $item->od_sale }}%</td>
                                    <td>{{ $item->od_qty }}</td>
                                    <td>
                                        @if($item->od_sale)
                                            <span class="text-danger">
                                                {{ number_format($item->od_price * (100 - $item->od_sale) * $item->od_qty / 100, 0, ',', '.') }} đ
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                {{ number_format($item->od_price * $item->od_qty, 0, ',', '.') }} đ
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Thành tiền</strong>
                                        </td>
                                        <td class="right">{{ number_format($transaction->t_total_money, 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">VAT (10%)</strong>
                                        </td>
                                        <td class="right">{{ number_format($transaction->t_total_money * (0.1), 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Phí vận chuyển</strong>
                                        </td>
                                        <td class="right">30.000 đ</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Tổng</strong> </td>
                                        <td class="right">
                                            <strong class="text-dark">{{ number_format($transaction->t_total_money * 1.1 + 30000, 0, ',', '.') }} đ</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p class="mb-0">Số 78, đường Quốc lộ 3, thôn Phù Mã, Xã Phù Linh, Huyện Sóc Sơn, TP. Hà Nội</p>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
        <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    </body>
</html>