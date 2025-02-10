{{-- 10123914 - DIMAS NURFAUZI --}}

@extends('adminlte::page')

@section('title', 'Organisasi')

@section('content_header')
    <h1>Struktur Organisasi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div id="orgchart"></div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            packages: ["orgchart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            fetch('/api/organization') // Laravel API endpoint
                .then(response => response.json())
                .then(data => {
                    let chartData = new google.visualization.DataTable();
                    chartData.addColumn('string', 'Name');
                    chartData.addColumn('string', 'Manager');

                    function processEmployee(employee, manager = null) {
                        chartData.addRow([{
                            v: employee.id.toString(),
                            f: `${employee.first_name} ${employee.last_name}<br><strong>${employee.position}</strong>`
                        }, manager]);
                        if (employee.subordinates.length > 0) {
                            employee.subordinates.forEach(sub => processEmployee(sub, employee.id.toString()));
                        }
                    }

                    data.forEach(employee => processEmployee(employee));

                    let chart = new google.visualization.OrgChart(document.getElementById('orgchart'));

                    chart.draw(chartData, {
                        allowHtml: true
                    });
                })
                .catch(error => console.error('Error loading data:', error));
        }
    </script>
@stop
