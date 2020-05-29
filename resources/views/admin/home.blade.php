@extends ('adminlte::page')
@section('plugins.Chartjs', true)
@section ('title', 'Painel')
@section ('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-md-6">
            <form method="GET">
                <select onChange="this.form.submit()" name="interval" class="float-md-right">
                <option {{ $dateInterval==30?'selected="selected"':'' }}value="30">Last 30 days</option>
                    <option {{ $dateInterval==60?'selected="selected"':'' }} value="60">Last 2 months</option>
                    <option {{ $dateInterval==90?'selected="selected"':'' }} value="90">Last 3 months</option>
                    <option {{ $dateInterval==120?'selected="selected"':'' }} value="120">Last 4 months</option>
                </select>
            </form>
        </div>
    </div>    
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$visitsCount}}</h3>
                    <p>Access</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-eye"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$onlineCount}}</h3>
                    <p>Users Online</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$pageCount}}</h3>
                    <p>Pages</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-sticky-note"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$userCount}}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Highest Buyers</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Best Seller</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagePie"></canvas>
                </div>
            </div>
        </div>
        
    </div>

<script>
    window.onload = function() {
        let ctx = document.getElementById('pagePie').getContext('2d');
        window.pagePie = new Chart(ctx, {
            type:'pie',
            data:{
                datasets:[{
                    data:{{$pageValues}},
                    backgroundColor: '#0000FF'
                }],
                labels: {!!$pageLabels!!} //pegar o valor literal sem dar o escape nas aspas
            },
            options:{
                legend:{
                    display:false
                }
            }

        });
     }
</script>
@endsection