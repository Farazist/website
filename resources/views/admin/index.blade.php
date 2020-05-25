@extends('template')

@section('title')
مدیریت
@endsection

@section('content')
<div class="row pt-3 mb-4 pb-5">
    <div class="col-md-6 mb-3">
        <div class="card bg-white shadow rounded-lg h-100">
            <div class="card-header bg-success text-white">
                آخرین تیکت ها
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover small mb-0">
                    <thead>
                        <tr>
                            <th scope="col" width="64px"></th>
                            <th scope="col">نام کاربر</th>
                            <th scope="col">موضوع</th>
                            <th scope="col">بخش</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($tickets as $ticket)
                        <tr>
                            <td>
                                <img class="img-fluid rounded-circle" src="{{ URL::asset($ticket->user->image) }}">
                            </td>
                            <th class="align-middle" scope="row">{{$ticket->user->name}}</th>
                            <td class="align-middle">{{$ticket->subject}}</td>
                            <td class="align-middle">{{$ticket->group->title}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card bg-white shadow rounded-lg h-100">
            <div class="card-header bg-success text-white">
                تعداد تراکنش ها در هر ماه میلادی
            </div>
            <div class="card-body">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card bg-white shadow rounded-lg h-100">
            <div class="card-header bg-success text-white">
                تعداد تحویل ها در هر ماه میلادی
            </div>
            <div class="card-body">
                <canvas id="myChart2" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card bg-white shadow rounded-lg h-100">
            <div class="card-header bg-success text-white">
                تعداد کاربران جدید در هر ماه میلادی
            </div>
            <div class="card-body">
                <canvas id="myChart3" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart;
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart2;
    var ctx3 = document.getElementById('myChart3').getContext('2d');
    var myChart3;

    $(document).ready(function () {

        $.ajax({
            url: '{{ url("/admin/get-report-transactions-group-by-month") }}',
            type: 'post',
            data: {'_token':'{{ csrf_token() }}'},
            success: function (result) {
                console.log(result);
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(result).map(key => result[key].y + '/' + result[key].m),
                        datasets: [{
                            label: 'Transactions',
                            data: Object.keys(result).map(key => result[key].c),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        })

        $.ajax({
            url: '{{ url("/admin/get-report-deliveries-group-by-month") }}',
            type: 'post',
            data: {'_token':'{{ csrf_token() }}'},
            success: function (result) {
                console.log(result);
                myChart2 = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: Object.keys(result).map(key => result[key].y + '/' + result[key].m),
                        datasets: [{
                            label: 'Deliveries',
                            data: Object.keys(result).map(key => result[key].c),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        })

        $.ajax({
            url: '{{ url("/admin/get-report-users-group-by-month") }}',
            type: 'post',
            data: {'_token':'{{ csrf_token() }}'},
            success: function (result) {
                console.log(result);
                myChart3 = new Chart(ctx3, {
                    type: 'horizontalBar',
                    data: {
                        labels: Object.keys(result).map(key => result[key].y + '/' + result[key].m),
                        datasets: [{
                            label: 'Users',
                            data: Object.keys(result).map(key => result[key].c),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        })
    })

</script>

@endsection