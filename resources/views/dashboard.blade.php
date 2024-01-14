<x-app-layout>
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
    </x-slot>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="hero bg-primary text-white">
                        <div class="hero-inner">
                            <h2>Welcome, {{auth()->user()->name}}!</h2>
                            <p class="lead">You almost arrived, complete the information about your account to complete registration.</p>
                            <div class="mt-4">
                                <a href="/user/profile" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Setup Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Voter</h4>
                    </div>
                    <div class="card-body">
                        {{$data['voter']}} Voters
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Voting</h4>
                    </div>
                    <div class="card-body">
                        {{$data['voting']}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Batch</h4>
                    </div>
                    <div class="card-body">
                        {{$data['batch']}} Batches
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Paslon</h4>
                    </div>
                    <div class="card-body">
                        {{$data['candidate']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistics</h4>
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            Variable radius pie charts can be used to visualize a
                            second dimension in a pie chart. In this chart, the more
                            densely populated countries are drawn further out, while the
                            slice width is determined by the size of the country.
                        </p>
                    </figure>
                    <div class="statistic-details mt-sm-4">
                        @foreach ($resultVoting as $item)
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> {{$item->vote_percentage}}%</span>
                            <div class="detail-value">{{$item->total_votes}}</div>
                            <div class="detail-name">{{$item->candidate_name}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Activities</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        @foreach ($activityRecent as $item)
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right text-primary">{{$item->voted_at}}</div>
                                <div class="media-title">{{$item->user->name}}</div>
                                <span class="text-small text-muted">{{$item->user->name}} Baru saja melakukan pemilihan</span>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="d-inline">Batches</h4>
            <div class="card-header-action">
            </div>
        </div>
        <div class="card-body">
            @foreach ($batchData as $item)
            <ul class="list-unstyled list-unstyled-border mb-5">
                <li class="media">
                    <div class="media-body">
                        @if($item->status == 'Active')
                        <div class="badge badge-pill badge-success mb-1 float-right">{{$item->status}}</div>
                        @elseif($item->status == 'inActive')
                        <div class="badge badge-pill badge-warning mb-1 float-right">{{$item->status}}</div>
                        @else
                        @endif
                        <h6 class="media-title"><a href="#">{{$item->name}}</a></h6>
                        <div class="text-small text-muted">Total Voter<div class="bullet"></div> <span class="text-primary">{{$item->voter}} Voters</span></div>
                        <div class="text-small text-muted">Total Voting<div class="bullet"></div> <span class="text-primary">{{$item->voting}} Voting</span></div>
                    </div>
                </li>
            </ul>
            @endforeach
        </div>
    </div>

    @push('js')

    <script>
        var chartData = @json($chartData)

        // Inisialisasi grafik Highcharts
        Highcharts.chart('container', {
            chart: {
                type: 'variablepie'
            }
            , title: {
                text: 'Countries compared by population density and total area, 2022.'
                , align: 'left'
            }
            , tooltip: {
                headerFormat: ''
                , pointFormatter: function() {
                    return '<span style="color:' + this.color + '">\u25CF</span> <b>' + this.name + '</b><br>' +
                        'Total Votes: <b>' + this.y + '</b><br>' +
                        'Vote Percentage: <b>' + this.z + '%</b><br>';
                }
            }
            , series: [{
                minPointSize: 10
                , innerSize: '20%'
                , zMin: 0
                , name: 'countries'
                , borderRadius: 5
                , data: chartData
                , colors: [
                    '#4caefe'
                    , '#3dc3e8'
                    , '#2dd9db'
                    , '#1feeaf'
                    , '#0ff3a0'
                    , '#00e887'
                    , '#23e274'
                ]
            }]
        });

    </script>

    @endpush
</x-app-layout>
