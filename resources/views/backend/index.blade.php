@extends('layouts.app_backend')
@section('content')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; z-index: 9999; right: 15px; top: 60px; left: 67%;">
            <strong>Thất bại!</strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Thành viên
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countUser }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sản phẩm
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countProduct }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countTransaction }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Bài viết
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countArticle }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
        </div>
        <div class="col-sm-6">
            <div id="container2"></div>
        </div>
    </div>
    <br>
    <div class="row">
        <div  class="col-xl-6">
            <h2>Danh sách đơn hàng mới</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên KH</th>
                    <th>SĐT</th>
                    <th>Tổng</th>
                    <th>Ghi chú</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $item)    
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->t_name }}</td>
                        <td>{{ $item->t_phone }}</td>
                        <td><span class="text-danger">{{ number_format($item->t_total_money, 0, ',', '.') }} đ</span></td>
                        <td>{{ $item->t_note }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-xl-6">
            <h2>Thành viên mới đăng ký</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên KH</th>
                    <th>Email</th>
                    <th>SĐT</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)    
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div  class="col-sm-6">
            <h2>Danh sách đánh giá mới</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên KH</th>
                    <th>Sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Đánh giá</th>
                </tr>
                </thead>
                <tbody>
                @foreach($votes as $item)    
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td style="width: 230px;">{{ $item->product->pro_name }}</td>
                        <td>{{ $item->v_content }}</td>
                        <td>{{ $item->v_number }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>

        let data = "{{ $dataMoney }}";

        dataChart = JSON.parse(data.replace(/&quot;/g,'"'));

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'BIỂU ĐỒ DOANH THU'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Mức độ'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f} VNĐ'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} VNĐ</b><br/>'
            },

            series: [
                {
                    name: "DOANH THU",
                    colorByPoint: true,
                    data: dataChart
                }
            ]
        });
    </script>
@stop

@section('script')
    <script>
        let data2 = "{{ $dataTransaction }}";

        dataChartTransaction = JSON.parse(data2.replace(/&quot;/g,'"'));
        
        Highcharts.chart('container2', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'THỐNG KÊ TRẠNG THÁI ĐƠN HÀNG'
            },

            accessibility: {
                announceNewData: {
                    enabled: true
                },
                point: {
                    valueSuffix: '%'
                }
            },

            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:.0f} đơn'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
            },

            series: [
                {
                    name: "TRẠNG THÁI ĐƠN HÀNG",
                    colorByPoint: true,
                    data: dataChartTransaction
                    
                }
            ],
        });
    </script>
@stop

