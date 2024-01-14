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


    @push('js')

    <script>
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
                , pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br />' +
                    'Area (square km): <b>{point.y}</b><br />' +
                    'Population density (people per square km): <b>{point.z}</b><br />'
            }
            , series: [{
                minPointSize: 10
                , innerSize: '20%'
                , zMin: 0
                , name: 'countries'
                , borderRadius: 5
                , data: [{
                    name: 'Spain'
                    , y: 505992
                    , z: 92
                }, {
                    name: 'France'
                    , y: 551695
                    , z: 119
                }, {
                    name: 'Poland'
                    , y: 312679
                    , z: 121
                }, {
                    name: 'Czech Republic'
                    , y: 78865
                    , z: 136
                }, {
                    name: 'Italy'
                    , y: 301336
                    , z: 200
                }, {
                    name: 'Switzerland'
                    , y: 41284
                    , z: 213
                }, {
                    name: 'Germany'
                    , y: 357114
                    , z: 235
                }]
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
