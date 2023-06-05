@extends('admin.layouts.app')

@section('uncommonInCss')
    <style>
        .highcharts-title{
            font-size:16px !important;
        }
        td{
            padding-top: 3px;
            padding-bottom: 3px;
        }
        .small-box{
            min-height: 142px;
        }
        .box-shadow{
            box-shadow: 0 0 15px rgba(0,0,0,.1), 0 20px 30px rgba(0,0,0,.2);
        }
        table a{
            cursor: pointer;
            color: black !important;
        }
        table a:focus,  table a:hover,  table a:active{
            text-decoration: none;
        }
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 100%;
            margin: 1em auto;
            background-color: white;
            padding: 10px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .highcharts-credits{
         display: none !important;
        }

    </style>
@endsection
@section('uncommonExCss')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endsection


@section('content')
        <div class="container-fluid">
            @if(auth()->user()->can('read-dashboard'))
                <form id="show_transactions" method="post" action="{{route('show-transaction-list')}}" style="display:none" target="_blank">
                    @csrf
                    <input type="hidden" id="code_id_selected" name="code_id_filter">
                    <input type="hidden" id="fiscal_year_selected" name="fiscal_year_filter">
                    <input type="hidden" id="type_selected" name="type_filter">
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive box-shadow" id="table_all_codes_total" style="padding: 5px;">
                            <div class="report-content">
                                <table class="table table-striped table-hover table-bordered"  id="all_codes_total" style="width: 100%; background-color: white;">
                                    <thead>
                                    <tr>
                                        <td class="text-center" colspan="7" style="font-size:17px;">
                                            <button class="btn btn-default btn-sm no-print float-left" type="button" onclick="printDiv('table_all_codes_total')"><span class="fa fa-print"></span> প্রিন্ট</button>
                                            <span class="fiscal-year">
                                        <select class="" id="fiscal_year_filter">
                                            {!!  \App\Http\PigeonHelpers\otherHelper::get_fiscal_year_options(array(\App\Http\PigeonHelpers\otherHelper::get_fiscal_year_by_date(date('Y-m-d'))),2019)!!}
                                        </select>
                                    </span> &nbsp;
                                            অর্থবছরে সকল কোডে মোট লেনদেনের হিসাব <small class="float-right">(টাকার অংক শত টাকায়)</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  style="font-size:15px;" class="">কোড</td>
                                        <td  style="font-size:15px;" class="text-right">কোডে প্রাপ্ত বরাদ্দ</td>
                                        <td  style="font-size:15px;" class="text-right">ইউনিটে দেওয়া বরাদ্দ</td>
                                        <td  style="font-size:15px;" class="text-right">ইউনিটে দেওয়া বরাদ্দ (%)</td>
                                        <td  style="font-size:15px;" class="text-right">ইউনিট থেকে প্রাপ্ত সমর্পণ</td>
                                        <td  style="font-size:15px;" class="text-right">কোড থেকে সমর্পণ</td>
                                        <td  style="font-size:15px;" class="text-right">ব্যালেন্স</td>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <td  style="font-size:15px;" class="text-right">মোট=</td>
                                        <td  style="font-size:15px;" class="text-right" id="grand_total_code_allotment"></td>
                                        <td  style="font-size:15px;" class="text-right" id="grand_total_unit_allotment"></td>
                                        <td  style="font-size:15px;" class="text-right" id="grand_total_unit_allotment_percent"></td>
                                        <td  style="font-size:15px;" class="text-right" id="grand_total_unit_surrender"></td>
                                        <td  style="font-size:15px;" class="text-right" id="grand_total_code_surrender"></td>
                                        <td  style="font-size:15px;" class="text-right" id="grand_total_balance"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <figure class="highcharts-figure box-shadow" style="padding: 5px;">
                            <div id="balance_pie_chart"></div>
                            <p class="highcharts-description">
                            </p>
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <figure class="highcharts-figure box-shadow" style="padding: 5px;">
                            <div id="unit_allotment_3d_donut_chart"></div>
                            <p class="highcharts-description">
                            </p>
                        </figure>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <figure class="highcharts-figure box-shadow" style="padding: 5px;">
                            <div id="unit_allotment_bar_chart"></div>
                            <p class="highcharts-description">
                            </p>
                            <button id="plain" class="btn btn-default btn-sm">Plain</button>
                            <button id="inverted" class="btn btn-default btn-sm">Inverted</button>
                            <button id="polar" class="btn btn-default btn-sm">Polar</button>
                        </figure>
                    </div>
                </div>
            @endif
        </div><!--/. container-fluid -->
@endsection

@section('uncommonExJs')

@endsection

@section('uncommonInJs')
    <script>
        (function() {
            "use strict";
        })(jQuery);

        $(window).on('load',function (){
            // get_totals();
            get_all_code_totals();
            balance_pie_chart();
            unit_allotment_3d_donut_chart();
            unit_allotment_bar_chart();
        });

        Highcharts.setOptions({
            colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            })
        });

        $('#fiscal_year_filter').on('change',function (){
            get_all_code_totals();
        });

        function show_transactions(code,type){
            $('#fiscal_year_selected').val($('#fiscal_year_filter').val());
            $('#code_id_selected').val(code);
            $('#type_selected').val(type);
            $('#show_transactions').submit();
        }

        function get_all_code_totals(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let route = '{{route('get-all-code-total-amounts')}}';
            $.ajax({
                url: route,
                data: {
                    fiscal_year_filter: $('#fiscal_year_filter').val(),
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        let tbodyHtm='';
                        let grand_total_code_allotment=0;
                        let grand_total_unit_allotment=0;
                        let grand_total_unit_surrender=0;
                        let grand_total_code_surrender=0;
                        let grand_total_balance=0;
                        for (let i=0; i<response.length; i++){
                            tbodyHtm+='<tr>';
                            tbodyHtm+='<td>'+response[i].code+'</td>';
                            grand_total_code_allotment+=response[i].code_allotment_amount;
                            tbodyHtm+='<td class="text-right"><a onclick="show_transactions('+response[i].code_id+',\'code_allotment\')">'+bn_Numbers(taka_format(response[i].code_allotment_amount))+'/-</a></td>';
                            grand_total_unit_allotment+=response[i].unit_allotment_amount;
                            tbodyHtm+='<td class="text-right"><a onclick="show_transactions('+response[i].code_id+',\'unit_allotment\')">'+bn_Numbers(taka_format(response[i].unit_allotment_amount))+'/-</a></td>';
                            let percent=(parseFloat(response[i].code_allotment_amount)>0)?((parseFloat(response[i].unit_allotment_amount)*100)/parseFloat(response[i].code_allotment_amount)):0;
                            tbodyHtm+='<td class="text-right"><a onclick="show_transactions('+response[i].code_id+',\'unit_allotment\')">'+bn_Numbers(percent.toFixed(2))+'%</a></td>';
                            grand_total_unit_surrender+=response[i].unit_surrender_amount;
                            tbodyHtm+='<td class="text-right"><a onclick="show_transactions('+response[i].code_id+',\'unit_surrender\')">'+bn_Numbers(taka_format(response[i].unit_surrender_amount))+'/-</a></td>';
                            grand_total_code_surrender+=response[i].code_surrender_amount;
                            tbodyHtm+='<td class="text-right"><a onclick="show_transactions('+response[i].code_id+',\'code_surrender\')">'+bn_Numbers(taka_format(response[i].code_surrender_amount))+'/-</a></td>';
                            grand_total_balance+=response[i].total_balance;
                            tbodyHtm+='<td class="text-right">'+bn_Numbers(taka_format(response[i].total_balance))+'/-</td>';
                            tbodyHtm+='</tr>';
                        }
                        $('#all_codes_total tbody').html(tbodyHtm);
                        $('#grand_total_code_allotment').html('<a onclick="show_transactions(\'all\',\'code_allotment\')">'+bn_Numbers(taka_format(grand_total_code_allotment))+'/-</a>');
                        $('#grand_total_unit_allotment').html('<a onclick="show_transactions(\'all\',\'unit_allotment\')">'+bn_Numbers(taka_format(grand_total_unit_allotment))+'/-</a>');
                        let percent=(parseFloat(grand_total_code_allotment)>0)?((parseFloat(grand_total_unit_allotment)*100)/parseFloat(grand_total_code_allotment)):0;
                        $('#grand_total_unit_allotment_percent').html('<a onclick="show_transactions(\'all\',\'unit_allotment\')">'+bn_Numbers(percent.toFixed(2))+'%</a>');
                        $('#grand_total_unit_surrender').html('<a onclick="show_transactions(\'all\',\'unit_surrender\')">'+bn_Numbers(taka_format(grand_total_unit_surrender))+'/-</a>');
                        $('#grand_total_code_surrender').html('<a onclick="show_transactions(\'all\',\'code_surrender\')">'+bn_Numbers(taka_format(grand_total_code_surrender))+'/-</a>');
                        $('#grand_total_balance').html(bn_Numbers(taka_format(grand_total_balance))+'/-');
                    }
                }
            });
        }

        function balance_pie_chart(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let route = '{{route('get-chart')}}';
            $.ajax({
                url: route,
                data: {
                    chartType: 'balance_pie_chart',
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        // Build the chart
                        Highcharts.chart('balance_pie_chart', {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: response.text
                            },
                            tooltip: {
                                pointFormat: '{series.name}:{point.x}</b>'
                            },
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>',
                                        connectorColor: 'silver'
                                    }
                                }
                            },
                            series: [{
                                name: 'মোট',
                                data: [
                                    { name: response.actual_balance_text, y: response.actual_balance_percent , x: response.actual_balance_tk},
                                    { name: response.actual_unit_allotment_text, y: response.actual_unit_allotment_percent, x:response.actual_unit_allotment_tk }
                                ]
                            }]
                        });
                    }
                }
            });
        }
        function unit_allotment_3d_donut_chart(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let route = '{{route('get-chart')}}';
            $.ajax({
                url: route,
                data: {
                    chartType: 'unit_allotment_3d_donut_chart',
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        // Build the chart
                        Highcharts.chart('unit_allotment_3d_donut_chart', {
                            chart: {
                                type: 'pie',
                                options3d: {
                                    enabled: true,
                                    alpha: 45
                                }
                            },
                            title: {
                                text: response.text
                            },
                            tooltip: {
                                pointFormat: '{series.name}:{point.x}</b>'
                            },
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            plotOptions: {
                                pie: {
                                    innerSize: 100,
                                    depth: 45,
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>',
                                        connectorColor: 'silver'
                                    }
                                }
                            },
                            series: [{
                                name: 'মোট',
                                data: [
                                    { name: response.actual_unit_allotment_text, y: response.actual_unit_allotment_percent, x:response.actual_unit_allotment_tk },
                                    { name: response.unit_surrender_text, y: response.unit_surrender_percent , x: response.unit_surrender_tk}
                                ]
                            }]
                        });
                    }
                }
            });
        }
        function unit_allotment_bar_chart(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let route = '{{route('get-chart')}}';
            $.ajax({
                url: route,
                data: {
                    chartType: 'unit_allotment_bar_chart',
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        // Build the chart
                        const chart = Highcharts.chart('unit_allotment_bar_chart', {
                            title: {
                                text: response.text
                            },
                            subtitle: {
                                text: 'Plain'
                            },
                            xAxis: {
                                categories: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                            },
                            series: [{
                                type: 'column',
                                colorByPoint: true,
                                data: response.unit_allotment_amount,
                                showInLegend: true
                            }]
                        });
                    }
                }
            });
            document.getElementById('plain').addEventListener('click', () => {
                chart.update({
                    chart: {
                        inverted: false,
                        polar: false
                    },
                    subtitle: {
                        text: 'Plain'
                    }
                });
            });

            document.getElementById('inverted').addEventListener('click', () => {
                chart.update({
                    chart: {
                        inverted: true,
                        polar: false
                    },
                    subtitle: {
                        text: 'Inverted'
                    }
                });
            });

            document.getElementById('polar').addEventListener('click', () => {
                chart.update({
                    chart: {
                        inverted: false,
                        polar: true
                    },
                    subtitle: {
                        text: 'Polar'
                    }
                });
            });
        }
    </script>
@endsection
