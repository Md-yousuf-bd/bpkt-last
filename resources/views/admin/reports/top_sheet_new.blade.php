@extends('admin.layouts.app')

@section('uncommonExCss')
    <link rel="stylesheet" type="text/css" href="{{asset('bower/pikaday/pikaday.css')}}">
@endsection

@section('uncommonInCss')
    <style>
        .list-a{
            cursor: pointer;
            text-decoration: none;
        }
        @media print{
            .list-a{
                cursor: pointer;
                text-decoration: none;
                color:black !important;
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
                        <h5 class="card-title">@lang('commons/content_header.Top Sheet new')</h5>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-default float-right" onclick="showReportFilter()"><span class="fa fa-filter"></span> ফিল্টার</a>
                            <a class="btn btn-sm btn-default float-right print-btn" style="margin-right: 10px;" onclick="printDiv('report_result')"><span class="fa fa-print"></span> প্রিন্ট</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <div id="report_result"><h5 class="text-center">প্রতিবেদন দেখার জন্য উপরের ফিল্টার বাটনে ক্লিক করে ফিল্টার করুন।</h5></div>
                        </div>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signatureModal">
                            সাক্ষর পরিবর্তন করুন
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="signatureModal">
                            <div class="modal-dialog">
                                <div class="modal-content modal-lg">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">সাক্ষর পরিবর্তন করুন</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <textarea id="signature_info" style="width: 100%;">{!! $signature_info !!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" id="top_sheet_signature_save">Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div


@endsection

@section('uncommonExJs')
    <script src="{{asset('bower/pikaday/pikaday.js')}}"></script>
    <script src="{{asset('bower/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('uncommonInJs')
    <script>
        var csrfToken= $('meta[name="csrf-token"]').attr('content');
        var signature_info='';
        function showReportFilter(){
            $('#filter').modal('show');
        }

        $(function (){
            CKEDITOR.replace('signature_info' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:130,
                line_height:0.3
            });
        })

        $(window).on('load',function(){
            get_set_report();
            save_signature();
            $('#signatureModal').modal('hide');
        });

        $('#top_sheet_signature_save').on('click',function (){
            save_signature();
        });
        function save_signature(){
            signature_info= CKEDITOR.instances.signature_info.getData();
            $('#report_result div')[0].lastChild.innerHTML=signature_info;
            $('#signatureModal').modal('hide');
        }
        function get_set_report(){
            $('#report_result').html('<div style="width:100%; text-align:center;"><h6 style="font-weight: lighter;">লোড হচ্ছে ...</h6></div>');
            let route = '{{route('report.get-top-sheet-neww')}}';
            $.ajax({
                url: route,
                data: {
                    code_id_filter: $('#code_id_filter').val(),
                    unit_id_filter: $('#unit_id_filter').val(),
                    date_from_filter: $('#date_from_filter').val(),
                    date_to_filter: $('#date_to_filter').val(),
                    memo_filter: $('#memo_filter').val(),
                    _token:csrfToken
                },
                type: 'POST',
                headers : {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        let htm='<div class="report-content">';
                        htm+='<h2 style="text-align: center;" >ট্রেনিং-১ শাখা হতে বিভিন্ন ইউনিটে বরাদ্দকৃত অর্থের বিবরণ:</h2><br>';
                        htm+='<table class="table table-bordered" style="width:100%; font-size: 18px;">';
                        htm+='<thead>';
                        htm+='<tr>';
                        htm+='<th rowspan="2" style="text-align: center; vertical-align: middle !important;">';
                        htm+='ক্রমিক নং';
                        htm+='</th>';
                        htm+='<th rowspan="2" style="text-align: center; vertical-align: middle !important;">';
                        htm+='ইউনিটের নাম';
                        htm+='</th>';
                        htm+='<th rowspan="2" style="text-align: center; vertical-align: middle !important;">';
                        htm+='অফিস আইডি';
                        htm+='</th>';
                        htm+='<th rowspan="2" style="text-align: center; vertical-align: middle !important;">';
                        htm+='ডিডিও আইডি';
                        htm+='</th>';
                        for(let i=0; i<response.code_columns.length; i++){
                            htm+='<th colspan="3" style="text-align: center; vertical-align: middle !important;">';
                            htm+=response.code_columns[i].code;
                            htm+='</th>';
                        }
                        htm+='</tr>';
                        htm+='<tr>';
                        for(let i=0; i<response.code_columns.length; i++){
                            htm+='<th style="text-align: center; vertical-align: middle !important;">';
                            htm+='ইস্যু নং';
                            htm+='</th>';
                            htm+='<th style="text-align: center; vertical-align: middle !important;">';
                            htm+='তারিখ';
                            htm+='</th>';
                            htm+='<th style="text-align: center; vertical-align: middle !important;">';
                            htm+='বরাদ্দকৃত অর্থ';
                            htm+='</th>';
                        }
                        htm+='</tr>';
                        htm+='</thead>';
                        htm+='<tbody>';
                        let z=0;
                        for(let m=0; m<response.final_data.length; m++){
                            htm += '<tr>';
                            htm += '<td style="text-align: center; vertical-align: middle !important;">';
                            htm += bn_Numbers((z + 1).toString());
                            htm += '</td>';
                            htm += '<td style=" vertical-align: middle !important;">';
                            htm += response.final_data[m].unit_data[0].unit_name;
                            htm += '</td>';
                            htm += '<td style="text-align: center; vertical-align: middle !important;">';
                            htm += response.final_data[m].unit_data[0].office_id;
                            htm += '</td>';
                            htm += '<td style="text-align: center; vertical-align: middle !important;">';
                            htm += response.final_data[m].unit_data[0].ddo_id;
                            htm += '</td>';
                            for(let i=0; i<response.code_columns.length; i++) {
                                htm += '<td rowspan="' + response.final_data[m].rowspan + '"  style="text-align: center; vertical-align: middle !important;">';
                                htm += response.final_data[m].memo;
                                htm += '</td>';
                                htm += '<td rowspan="' + response.final_data[m].rowspan + '"  style="text-align: center; vertical-align: middle !important;">';
                                htm += response.final_data[m].memo_date;
                                htm += '</td>';
                                htm += '<td  style="text-align: right; vertical-align: middle !important;">';
                                htm += response.final_data[m].unit_data[0]['code'+response.code_columns[i].id];
                                htm += '</td>';
                            }
                            htm += '</tr>';
                            z++;
                            for(let k=1; k<response.final_data[m].unit_data.length;k++) {
                                htm += '<tr>';
                                htm += '<td style="text-align: center; vertical-align: middle !important;">';
                                htm += bn_Numbers((z + 1).toString());
                                htm += '</td>';
                                htm += '<td style=" vertical-align: middle !important;">';
                                htm += response.final_data[m].unit_data[k].unit_name;
                                htm += '</td>';
                                htm += '<td style="text-align: center; vertical-align: middle !important;">';
                                htm += response.final_data[m].unit_data[k].office_id;
                                htm += '</td>';
                                htm += '<td style="text-align: center; vertical-align: middle !important;">';
                                htm += response.final_data[m].unit_data[k].ddo_id;
                                htm += '</td>';
                                for(let i=0; i<response.code_columns.length; i++) {
                                    htm += '<td  style="text-align: right; vertical-align: middle !important;">';
                                    htm += response.final_data[m].unit_data[k]['code'+response.code_columns[i].id];
                                    htm += '</td>';
                                }
                                htm += '</tr>';
                                z++;
                            }
                        }
                        htm+='</tbody>';
                        htm+='</table><br><br><br>';
                        htm+='<div style="width: 50%;"></div><div style="width: 50%; float:right;">'+signature_info+'</div>';
                        htm+='</div>';

                        $('#report_result').html(htm);
                    }
                }
            });
        }



    </script>
    <!-- .content -->
    @include('admin.reports.modals.report_filter')

    <script>
        $('#filter_submit').on('click',function (){
            get_set_report();
        });
    </script>
@endsection
