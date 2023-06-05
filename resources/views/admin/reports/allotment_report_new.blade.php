@extends('admin.layouts.app')

@section('uncommonExCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower/pikaday/pikaday.css') }}">
@endsection

@section('uncommonInCss')
    <style>
        .list-a {
            cursor: pointer;
            text-decoration: none;
        }

        @media print {
            .list-a {
                cursor: pointer;
                text-decoration: none;
                color: black !important;
            }
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('commons/content_header.Allotment Report new')</h5>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-default float-right" onclick="showReportFilter()"><span
                                    class="fa fa-filter"></span> ফিল্টার</a>
                            <a class="btn btn-sm btn-default float-right print-btn" style="margin-right: 10px;"
                                onclick="printDiv('report_result')"><span class="fa fa-print"></span> প্রিন্ট</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <div id="report_result">
                                <h5 class="text-center">প্রতিবেদন দেখার জন্য উপরের ফিল্টার বাটনে ক্লিক করে ফিল্টার করুন।
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .content -->
@endsection

@section('uncommonExJs')
    <script src="{{ asset('bower/pikaday/pikaday.js') }}"></script>
@endsection

@section('uncommonInJs')
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        function showReportFilter() {
            $('#filter').modal('show');
        }

        $(window).on('load', function() {
            get_set_report();
        });

        function get_set_report() {
            $('#report_result').html(
                '<div style="width:100%; text-align:center;"><h6 style="font-weight: lighter;">লোড হচ্ছে ...</h6></div>'
            );
            let route = '{{ route('report.get-allotment-report-neww') }}';
            $.ajax({
                url: route,
                data: {
                    code_id_filter: $('#code_id_filter').val(),
                    unit_id_filter: $('#unit_id_filter').val(),
                    fiscal_year_filter: $('#fiscal_year_filter').val(),
                    date_from_filter: $('#date_from_filter').val(),
                    date_to_filter: $('#date_to_filter').val(),
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response) {
                        let htm = '<div class="report-content">';
                        htm +=
                            '<h5 class="text-center" style="font-size:14px; font-weight: bold; line-height: 20px;">' +
                            response.fiscal_year_filter_str + ' অর্থসালে ' + response.date_filter_str + ' ' +
                            response.unit_id_filter_str + ' ইউনিটে ' + response.code_id_filter_str +
                            ' কোডে বরাদ্দ</h5>';
                        htm += '<table class="table table-bordered">';
                        htm += '<thead>';

                        htm +=
                            '<h4 class="text-center border" style="font-size:14px; font-weight: bold; line-height: 20px;">ট্রেনিং-১ শাখা হতে বিভিন্ন ইউনিটে বরাদ্দকৃত অর্থের বিবরনঃ</h4>';

                        // first tr
                        htm += '<tr>';
                        htm +=
                            '<th rowspan="2" class="text-center" style="vertical-align: middle;">ক্রমিক</th>';

                        htm +=
                            '<th rowspan="2" class="text-center" style="vertical-align: middle;">জেলা/ইউনিয়নের নাম</th>';
                        htm +=
                            '<th colspan="3" class="text-center" style="vertical-align: middle;">সদর দপ্তর প্রশিক্ষণ (কোড যুক্ত হবে)</th>';
                        htm +=
                            '<th rowspan="2" class="text-center" style="vertical-align: middle;">সদর ইউনিটের মোট বরাদ্দকৃত অর্থের শতকরা হার</th>';
                        htm +=
                            '<th colspan="3" class="text-center" style="vertical-align: middle;">সদর দপ্তর সম্মানী (কোড যুক্ত হবে)</th>';
                        htm +=
                            '<th rowspan="2" class="text-center" style="vertical-align: middle;">সদর ইউনিটের মোট বরাদ্দকৃত অর্থের শতকরা হার</th>';
                        htm +=
                            '<th colspan="3" class="text-center" style="vertical-align: middle;">ইন্সঃ প্রশিক্ষণ (কোড যুক্ত হবে)</th>';
                        htm +=
                            '<th rowspan="2" class="text-center" style="vertical-align: middle;">সদর ইউনিটের মোট বরাদ্দকৃত অর্থের শতকরা হার</th>';
                        htm +=
                            '<th colspan="3" class="text-center" style="vertical-align: middle;">ইন্সঃ সম্মানী (কোড যুক্ত হবে)</th>';
                        htm +=
                            '<th rowspan="2" class="text-center" style="vertical-align: middle;">সদর ইউনিটের মোট বরাদ্দকৃত অর্থের শতকরা হার</th>';

                        htm += '</tr>';

                        // secound tr
                        htm += '<tr>';




                        htm += '<th class="text-center" style="vertical-align: middle;">বরাদ্দকৃত অর্থ</th>';
                        htm +=
                            '<th class="text-center" style="vertical-align: middle;">বি-বিবরণী অনুযায়ী মোট ব্যয়</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;"> অবশিষ্ট</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;">বরাদ্দকৃত অর্থ</th>';
                        htm +=
                            '<th class="text-center" style="vertical-align: middle;">বি-বিবরণী অনুযায়ী মোট ব্যয়</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;"> অবশিষ্ট</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;">বরাদ্দকৃত অর্থ</th>';
                        htm +=
                            '<th class="text-center" style="vertical-align: middle;">বি-বিবরণী অনুযায়ী মোট ব্যয়</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;"> অবশিষ্ট</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;">বরাদ্দকৃত অর্থ</th>';
                        htm +=
                            '<th class="text-center" style="vertical-align: middle;">বি-বিবরণী অনুযায়ী মোট ব্যয়</th>';
                        htm += '<th class="text-center" style="vertical-align: middle;"> অবশিষ্ট</th>';


                        // htm +=
                        //     '<th class="text-center" style="vertical-align: middle;">কোডভিত্তিক সর্বমোট</th>';
                        // htm += '<th class="text-center" style="vertical-align: middle;">মন্তব্য</th>';
                        htm += '</tr>';
                        htm += '</thead>';
                        htm += '<tbody>';
                        let unit_rows = response.allotments;
                        console.log(unit_rows)
                        for (let i = 0; i < unit_rows.length; i++) {
                            htm += '<tr>';
                            htm += '<td class="text-center">' + bn_Numbers((i + 1).toString()) + '</td>';
                            htm += '<td class="text-center">' + unit_rows[i].fiscal_year + '</td>';
                            htm += '<td class="text-center" style="min-width: 150px;">' + unit_rows[i]
                                .unit_name + '</td>';
                            htm += '<td class="text-center" style="min-width: 200px;">' + unit_rows[i].code +
                                '</td>';
                            htm += '<td class="text-center">' + unit_rows[i].memo + '</td>';
                            htm += '<td class="text-center">' + unit_rows[i].memo_date + '</td>';
                            htm += '<td class="text-right">' + unit_rows[i].demand + '</td>';
                            htm += '<td class="text-right">' + unit_rows[i].allotment + '</td>';
                            htm += '<td class="text-right">' + unit_rows[i].code_total + '</td>';
                            htm += '<td class="text-justify" style="min-width: 200px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '<td class="text-justify" style="min-width: 20px;"></td>';
                            htm += '</tr>';
                        }
                        htm += '</tbody>';
                        htm += '<tfoot>';
                        htm += '<tr>';
                        htm += '<th></th>';
                        htm += '<th></th>';
                        htm += '<th></th>';
                        htm += '<th></th>';
                        htm += '<th></th>';
                        htm += '<th></th>';
                        htm += '<th class="text-right">' + response.total_demand + '</th>';
                        htm += '<th class="text-right">' + response.total_allotment + '</th>';
                        htm += '<th></th>';
                        htm += '<th></th>';
                        htm += '</tr>';
                        htm += '</tfoot>';
                        htm += '</table>';
                        htm += '</div>';
                        $('#report_result').html(htm);
                    }
                }
            });
        }
    </script>

    @include('admin.reports.modals.report_filter_new')

    <script>
        $('#filter_submit').on('click', function() {
            get_set_report();
        });
    </script>
@endsection
