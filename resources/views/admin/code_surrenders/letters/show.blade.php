@extends('admin.layouts.app')

@section('uncommonExCss')

@endsection

@section('uncommonInCss')
    <style>
        .surrender-table table tr th,.surrender-table table tr td{
            padding: 6px 4px;
        }
        /*th,td{*/
        /*    font-size: 12px;*/
        /*    padding-top:.5rem !important;*/
        /*    padding-bottom:.5rem !important;*/
        /*}*/
        /*@media only screen and (max-width: 700px){*/
        /*    .mb-view{*/
        /*        display:block;*/
        /*    }*/
        /*    .pc-view{*/
        /*        display:none;*/
        /*    }*/
        /*}*/

        /*@media only screen and (min-width: 701px){*/
        /*    .mb-view{*/
        /*        display:none;*/
        /*    }*/
        /*    .pc-view{*/
        /*        display:block;*/
        /*    }*/
        /*}*/

        /*body {*/
        /*    scroll-behavior: smooth;*/
        /*}*/

        /*section{*/
        /*    padding-top: 55px;*/
        /*}*/
        /*th{*/
        /*    text-align: right !important;*/
        /*}*/
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mx-auto" style="min-width: 700px;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">

                        </h5>
                        <div class="card-tools">
                            @if(auth()->user()->can('read-sms') && $surrender_letter->sub_header_memo_second_part !='' && $surrender_letter->sub_header_memo_date!='')
                                <button class="btn btn-default btn-sm" type="button" onclick="sentSMS()"><i class="fa fa-comment"></i> এসএমএস পাঠান
                                    <div id="sms-button-loader" class="spinner-grow spinner-grow-sm text-dark" role="status" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            @endif
                            @if(auth()->user()->can('read-mail') && $surrender_letter->sub_header_memo_second_part !='' && $surrender_letter->sub_header_memo_date!='')
                                <button class="btn btn-default btn-sm" type="button" onclick="sentMail()"><span class="fa fa-envelope"></span> মেইল পাঠান
                                    <div id="mail-button-loader" class="spinner-grow spinner-grow-sm text-dark" role="status" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            @endif
{{--                            <input type="checkbox" id="lowerToggle" data-on="নিচের অংশ ছাড়া দেখুন" data-off="নিচের অংশ সহ দেখুন" data-height="30"  data-width="150"  checked data-toggle="toggle" data-onstyle="default" data-offstyle="default" data-size="sm">--}}
                            @if(auth()->user()->can('print-signed-surrender-letter'))<input type="checkbox" id="signToggle" data-on="স্বাক্ষর সহ দেখুন" data-off="সাক্ষর ছাড়া দেখুন" data-height="30"  data-width="120"  checked data-toggle="toggle" data-onstyle="default" data-offstyle="default" data-size="sm">@endif
                            <button class="btn btn-default btn-sm" type="button" onclick="printDiv('print_view')"><span class="fa fa-print"></span> প্রিন্ট</button>
                            <a class="btn btn-default btn-sm" href="{{route('code-surrender-letter.edit',[$surrender_letter->id])}}" ><span class="fa fa-edit"></span> এডিট</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Http\PigeonHelpers\otherHelper;
                            use App\User;
                            $image_folder='storage/images/master_surrender_letters/';

                        @endphp
                        <div id="print_view">
                            <style>
                                .surrender-table table tr th,.surrender-table table tr td{
                                    padding: 6px 4px;
                                }
                                .surrender-table table tr th{
                                    text-align: center;
                                }
                                table { page-break-inside:auto }
                                tr    { page-break-inside:avoid; page-break-after:auto }
                                /*thead { display:table-header-group }*/
                                /*tfoot { display:table-footer-group }*/
                                .full-letter{
                                    line-height: 25px;
                                }
                                @media print {
                                    th,td{
                                        font-size: 18px !important;
                                    }
                                }

                                @media print
                                {
                                    table { page-break-after:auto }
                                    tr    { page-break-inside:avoid; page-break-after:auto }
                                    /*td    { page-break-inside:avoid; page-break-after:auto }*/
                                    /*thead { display:table-header-group }*/
                                    /*tfoot { display:table-footer-group }*/
                                }
                            </style>
                            <div class="full-letter">
                                <div class="table-responsive" style="overflow: auto; font-size: 18px !important;  ">
                                    <table style="width:100%;">
                                        <tr>
                                            <td style="width:25%;" class="text-left">
                                                @if(isset($surrender_letter->header_left_logo) && $surrender_letter->header_left_logo!='')
                                                    <img src="{{asset($image_folder.$surrender_letter->header_left_logo)}}" style="height: 70px; width:auto;">
                                                @endif
                                            </td>
                                            <td style="width:50%;" class="text-center">{!! $surrender_letter->header_middle_heading ?? '' !!}</td>
                                            <td style="width:25%;" class="text-right">@if(isset($surrender_letter->header_right_logo) && $surrender_letter->header_right_logo!='')<img src="{{asset($image_folder.$surrender_letter->header_right_logo)}}" style="height: 70px; width:auto;">@endif</td>
                                        </tr>
                                    </table><br>
                                    <table style="width:100%;">
                                        <tr>
                                            <td style="width:75%;" class="text-left ">স্মারক নং-{{ $surrender_letter->sub_header_memo_first_part.$surrender_letter->sub_header_memo_second_part }}</td>
                                            <td style="width:25%;" class="text-right">
                                                <table style="width:100%;">
                                                    <tr>
                                                        <td style="">তারিখঃ&nbsp;</td>
                                                        <td style="text-align: center;">
                                                            @if(isset($surrender_letter->sub_header_memo_date) && $surrender_letter->sub_header_memo_date!='')
                                                            {{\App\Http\PigeonHelpers\otherHelper::get_bangla_date_str($surrender_letter->sub_header_memo_date). ' বঙ্গাব্দ'}}
                                                            <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0; border-bottom: 1px solid black;">
                                                            {{\App\Http\PigeonHelpers\otherHelper::en2bn(\App\Http\PigeonHelpers\otherHelper::change_date_format($surrender_letter->sub_header_memo_date,false,"d M Y")). ' খ্রিঃ'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table><br>
                                    @if(isset($surrender_letter->subject) && $surrender_letter->subject!='')
                                    <table style="width:100%;">
                                        <tr>
                                            <td style="width:100%;">
                                                    {!! $surrender_letter->subject !!}
                                            </td>
                                        </tr>
                                    </table>
                                    @endif
                                    @if(isset($surrender_letter->reference) && $surrender_letter->reference!='')
                                    <table style="width:100%;">
                                        <tr>
                                            <td style="width:100%;">
                                                    {!! $surrender_letter->reference !!}

                                            </td>
                                        </tr>
                                    </table>
                                    @endif
                                    @if(isset($surrender_letter->description) && $surrender_letter->description!='')
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:100%;">
                                                    {!! $surrender_letter->description !!}

                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if(isset($surrender_letter->surrender_table) && $surrender_letter->surrender_table!='')
                                        <div class="surrender-table" style="width:100%;">
                                            {!! $surrender_letter->surrender_table !!}
                                        </div>
                                    @endif
                                    @if(isset($surrender_letter->instructions) && $surrender_letter->instructions!='')
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:100%;">
                                                    {!! $surrender_letter->instructions !!}

                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if(isset($surrender_letter->signature_info) && $surrender_letter->signature_info!='')
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:60%;"></td>
                                                <td style="width:40%;" class="text-center">
                                                    @if(auth()->user()->can('print-signed-surrender-letter'))
                                                    <div class="signed" style="display:none;">
                                                        <small>ডিজিটাল সাক্ষরিত চিঠি</small>
                                                        <br>
                                                        @if(isset($surrender_letter->signature_image)
                                                            && $surrender_letter->signature_image!=''
                                                            && isset($surrender_letter->signature_date)
                                                            && $surrender_letter->signature_date!=''
                                                            && $surrender_letter->is_signed==1
                                                            )
                                                            <img src="{{asset($image_folder.$surrender_letter->signature_image)}}" style="height: 30px; width:auto;"><br>
                                                            <span style="margin-left:60px; margin-top:-10px; margin-bottom: 15px;">{{\App\Http\PigeonHelpers\otherHelper::en2bn(\App\Http\PigeonHelpers\otherHelper::change_date_format($surrender_letter->signature_date,false,"d/m/Y"))}}</span>
                                                        @else
                                                            <br>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="unsigned">
                                                        <br><br>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:60%; vertical-align: top;">{!! $surrender_letter->signature_info_left !!}</td>
                                                <td style="width:40%;">
                                                    {!! $surrender_letter->signature_info !!}
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if(isset($surrender_letter->letter_to) && $surrender_letter->letter_to!='')
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:100%;">
                                                    {!! $surrender_letter->letter_to !!}

                                                </td>
                                            </tr>
                                        </table>
                                    @endif
{{--                                    <div class="lower-part">--}}
{{--                                        <table style="width:100%;">--}}
{{--                                            <tr>--}}
{{--                                                <td style="width:75%;" class="text-left ">স্মারক নং-{{ $surrender_letter->sub_header_memo_first_part_2.$surrender_letter->sub_header_memo_second_part_2 }}</td>--}}
{{--                                                <td style="width:25%;" class="text-right">--}}
{{--                                                    <table style="width:100%;">--}}
{{--                                                        <tr>--}}
{{--                                                            <td style="">তারিখঃ&nbsp;</td>--}}
{{--                                                            <td style="text-align: center;">--}}
{{--                                                                @if(isset($surrender_letter->sub_header_memo_date_2) && $surrender_letter->sub_header_memo_date_2!='')--}}
{{--                                                                    {{\App\Http\PigeonHelpers\otherHelper::get_bangla_date_str($surrender_letter->sub_header_memo_date_2). ' বঙ্গাব্দ'}}--}}
{{--                                                                    <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0; border-bottom: 1px solid black;">--}}
{{--                                                                    {{\App\Http\PigeonHelpers\otherHelper::en2bn(\App\Http\PigeonHelpers\otherHelper::change_date_format($surrender_letter->sub_header_memo_date_2,false,"d M Y")). ' খ্রিঃ'}}--}}
{{--                                                                @endif--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        </table><br>--}}
{{--                                        @if(isset($surrender_letter->letter_acknowledgement) && $surrender_letter->letter_acknowledgement!='')--}}
{{--                                            <table style="width:100%;">--}}
{{--                                                <tr>--}}
{{--                                                    <td style="width:100%;">--}}
{{--                                                        {!! $surrender_letter->letter_acknowledgement !!}--}}

{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            </table>--}}
{{--                                        @endif--}}
{{--                                        @if(isset($surrender_letter->signature_info_2) && $surrender_letter->signature_info_2!='')--}}
{{--                                            <table style="width:100%;">--}}
{{--                                                <tr>--}}
{{--                                                    <td style="width:60%;"></td>--}}
{{--                                                    <td style="width:40%;" class="text-center">--}}
{{--                                                        @if(auth()->user()->can('print-signed-surrender-letter'))--}}
{{--                                                        <div class="signed" style="display:none;">--}}
{{--                                                            <small>ডিজিটাল সাক্ষরিত চিঠি</small>--}}
{{--                                                            <br>--}}
{{--                                                            @if(isset($surrender_letter->signature_image_2)--}}
{{--                                                                && $surrender_letter->signature_image_2!=''--}}
{{--                                                                && isset($surrender_letter->signature_date_2)--}}
{{--                                                                && $surrender_letter->signature_date_2!=''--}}
{{--                                                                && $surrender_letter->is_signed_2==1--}}
{{--                                                                )--}}
{{--                                                                <img src="{{asset($image_folder.$surrender_letter->signature_image_2)}}" style="height: 30px; width:auto;"><br>--}}
{{--                                                                <span style="margin-left:60px; margin-top:-10px; margin-bottom: 15px;">{{\App\Http\PigeonHelpers\otherHelper::en2bn(\App\Http\PigeonHelpers\otherHelper::change_date_format($surrender_letter->signature_date_2,false,"d/m/Y"))}}</span>--}}
{{--                                                            @else--}}
{{--                                                                <br>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                        @endif--}}
{{--                                                        <div class="unsigned">--}}
{{--                                                            <br><br>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td style="width:60%;"></td>--}}
{{--                                                    <td style="width:40%;">--}}
{{--                                                        {!! $surrender_letter->signature_info_2 !!}--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            </table>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .content -->
{{--    @if(auth()->user()->can('read-mail') && $surrender_letter->sub_header_memo_second_part !='' && $surrender_letter->sub_header_memo_date!='')--}}
{{--        <div id="mail_info" style="display:none;">--}}
{{--            @foreach($surrender_letter->letter_surrender_transactions as $letter_surrender_transaction)--}}
{{--                @if($letter_surrender_transaction->mail_info('Unit Head')!='')--}}
{{--                    <span>{{$letter_surrender_transaction->mail_info('Unit Head')}}</span>--}}
{{--                @endif--}}
{{--                @if($letter_surrender_transaction->mail_info('For Attention')!='')--}}
{{--                    <span>{{$letter_surrender_transaction->mail_info('For Attention')}}</span>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        @endif--}}
{{--        @if(auth()->user()->can('read-sms') && $surrender_letter->sub_header_memo_second_part !='' && $surrender_letter->sub_header_memo_date!='')--}}
{{--        <div id="sms_info" style="display:none;">--}}
{{--            @foreach($surrender_letter->letter_surrender_transactions as $letter_surrender_transaction)--}}
{{--                @if($letter_surrender_transaction->sms_info('Unit Head')!='')--}}
{{--                    <span>{{$letter_surrender_transaction->sms_info('Unit Head')}}</span>--}}
{{--                @endif--}}
{{--                @if($letter_surrender_transaction->sms_info('For Attention')!='')--}}
{{--                    <span>{{$letter_surrender_transaction->sms_info('For Attention')}}</span>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    @endif--}}

@endsection

@section('uncommonExJs')

@endsection

@section('uncommonInJs')
    <script>
        @if(auth()->user()->can('print-signed-surrender-letter'))
            $('#signToggle').on('change',function(){
               if($('#signToggle')[0].checked===false){
                   $('.unsigned').css('display','none');
                   $('.signed').css('display','block');
               }
               else{
                   $('.signed').css('display','none');
                   $('.unsigned').css('display','block');
               }
            });
        @endif

        @if(auth()->user()->can('read-mail') && $surrender_letter->sub_header_memo_second_part !='' && $surrender_letter->sub_header_memo_date!='')
            // var mail_infos;
            // var mail_in_process;
            // var mail_success;
            // var mail_fail;
            function sentMail(){
                @if($surrender_letter->mail_count()>0)
                    if(confirm('পূর্বে এই চিঠির জন্য মেইল পাঠানো হয়েছে। আপনি কি পুনরায় মেইল পাঠাতে চান?')){
                @endif
                $('#mail-button-loader').css('display','inherit');
                // mail_infos=$('#mail_info').children('span');
                // mail_in_process=[];
                // mail_success=[];
                // mail_fail=[];
                // mail_in_process.push(mail_infos[i]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                let route = '{{route('code-surrender-letter.surrender_letter_sent_mail')}}';
                $.ajax({
                    url: route,
                    data: {
                        letter_id:{{$surrender_letter->id}},
                        // mail_info: mail_infos[i].innerText,
                        _token: csrfToken
                    },
                    type: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        if (response) {
                            // mail_in_process=[];

                            // if(i<(mail_infos.length-1)) {
                            //     sentUnitMail(mail_infos, i + 1);
                            // }
                            // else{
                            $('#mail-button-loader').css('display','none');
                            if(response===1) {
                                alertify.notify('মেইল সফলভাবে পাঠানো হয়েছে।.', 'success', 5, function(){  });
                            }
                            else{
                                alertify.notify('মেইল পাঠানো সম্ভব হয়নি।', 'error', 5, function () {});
                            }

                            // }
                        }
                    }
                });
                @if($surrender_letter->mail_count()>0)
                }
                @endif
            }
            {{--function sentMail(mail_infos,i){--}}
            {{--    mail_in_process.push(mail_infos[i]);--}}
            {{--    var csrfToken = $('meta[name="csrf-token"]').attr('content');--}}
            {{--    let route = '{{route('code-surrender-letter.surrender_letter_sent_mail')}}';--}}
            {{--    $.ajax({--}}
            {{--        url: route,--}}
            {{--        data: {--}}
            {{--            letter_id:{{$surrender_letter->id}},--}}
            {{--            mail_info: mail_infos[i].innerText,--}}
            {{--            _token: csrfToken--}}
            {{--        },--}}
            {{--        type: 'POST',--}}
            {{--        headers: {--}}
            {{--            'Accept': 'application/json',--}}
            {{--        },--}}
            {{--        dataType: 'JSON',--}}
            {{--        success: function (response) {--}}
            {{--            if (response) {--}}
            {{--                mail_in_process=[];--}}
            {{--                if(response===1) {--}}
            {{--                    mail_success.push(mail_infos[i]);--}}
            {{--                }--}}
            {{--                else{--}}
            {{--                    mail_fail.push(mail_infos[i]);--}}
            {{--                }--}}
            {{--                // if(i<(mail_infos.length-1)) {--}}
            {{--                //     sentUnitMail(mail_infos, i + 1);--}}
            {{--                // }--}}
            {{--                // else{--}}
            {{--                    $('#mail-button-loader').css('display','none');--}}
            {{--                    alert_mail_status();--}}
            {{--                // }--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--}--}}
            // function alert_mail_status(){
            //     if(mail_success.length>0){
            //         alertify.notify('মেইল সফলভাবে পাঠানো হয়েছে।.', 'success', 5, function(){  });
            //     }
            //     if(mail_fail.length>0) {
            //         alertify.notify('মেইল পাঠানো সম্ভব হয়নি।', 'error', 5, function () {});
            //     }
            // }
        @endif

        @if(auth()->user()->can('read-sms') && $surrender_letter->sub_header_memo_second_part !='' && $surrender_letter->sub_header_memo_date!='')
            // var sms_infos;
            // var sms_success;
            // var sms_fail;
            // var sms_length;
            function sentSMS(){
                @if($surrender_letter->sms_count()>0)
                if(confirm('পূর্বে এই চিঠির জন্য এসএমএস পাঠানো হয়েছে। আপনি কি পুনরায় এসএমএস পাঠাতে চান?')){
                    @endif
                $('#sms-button-loader').css('display','inherit');
                // sms_infos=$('#sms_info').children('span');
                // sms_length=sms_infos.length;
                // sms_success=[];
                // sms_fail=[];
                // if(sms_infos.length>0) {
                //     for(let i=0;i<sms_infos.length;i++){
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        let route = '{{route('code-surrender-letter.surrender_letter_sent_sms')}}';
                        $.ajax({
                            url: route,
                            data: {
                                letter_id:{{$surrender_letter->id}},
                                // sms_info: sms_infos[i].innerText,
                                _token: csrfToken
                            },
                            type: 'POST',
                            headers: {
                                'Accept': 'application/json',
                            },
                            dataType: 'JSON',
                            success: function (response) {
                                if (response) {
                                     if(response==='success') {
                                         alertify.notify('এসএমএস সফলভাবে পাঠানো হয়েছে।.', 'success', 5, function(){  });
                                     }
                                     else{
                                         alertify.notify('এসএমএস পাঠানো সম্ভব হয়নি।', 'error', 5, function () {});
                                     }
                                    // sms_length=sms_length-1;
                                    // if(sms_length===0) {
                                        $('#sms-button-loader').css('display','none');
                                        // alert_sms_status();
                                    // }
                                }
                            }
                        });
                    // }
                // }
                @if($surrender_letter->sms_count()>0)
                }
                @endif
            }
            // function alert_sms_status(){
            //     if(sms_success.length>0){
            //         alertify.notify(bn_Numbers(sms_success.length.toString())+' টি এসএমএস সফলভাবে পাঠানো হয়েছে।.', 'success', 5, function(){  });
            //     }
            //     if(sms_fail.length>0) {
            //         alertify.notify(bn_Numbers(sms_fail.length.toString())+' টি এসএমএস পাঠানো সম্ভব হয়নি।', 'error', 5, function () {});
            //     }
            // }
        @endif

            $('#lowerToggle').on('change',function(){
                if($('#lowerToggle')[0].checked===false){
                    $('.lower-part').css('display','none');
                }
                else{
                    $('.lower-part').css('display','block');
                }
            });
    </script>
@endsection
