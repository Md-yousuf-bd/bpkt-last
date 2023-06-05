@extends('reports.app')

@section('content')
      {!! $content !!}
    @if(isset($surrender_letter))
        <div style="margin: 20px 50px; ">
            <button class="btn btn-dark btn-sm" type="button" onclick="printDiv('print_view')"><span class="fa fa-print"></span> প্রিন্ট</button>
            <hr>
            @php
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
                    .full-letter{
                        line-height: 25px;
                    }
                </style>
                <div class="full-letter">
                    <div class="table-responsive" style="overflow: auto;">
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
                                <td style="width:75%;" class="text-left">স্মারক নং-{{ $surrender_letter->sub_header_memo_first_part.$surrender_letter->sub_header_memo_second_part }}</td>
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
                            <table class="surrender-table" style="width:100%;">
                                <tr>
                                    <td style="width:100%;">
                                        {!! $surrender_letter->surrender_table !!}

                                    </td>
                                </tr>
                            </table>
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
                                            <div class="signed">
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
                                                    <br><br><br>
                                                @endif
                                            </div>
                                        <div class="unsigned" style="display:none;">
                                            <br><br><br><br>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:60%;"></td>
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
                        <div class="lower-part">
                            <table style="width:100%;">
                                <tr>
                                    <td style="width:75%;" class="text-left">স্মারক নং-{{ $surrender_letter->sub_header_memo_first_part_2.$surrender_letter->sub_header_memo_second_part_2 }}</td>
                                    <td style="width:25%;" class="text-right">
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="">তারিখঃ&nbsp;</td>
                                                <td style="text-align: center;">
                                                    @if(isset($surrender_letter->sub_header_memo_date_2) && $surrender_letter->sub_header_memo_date_2!='')
                                                        {{\App\Http\PigeonHelpers\otherHelper::get_bangla_date_str($surrender_letter->sub_header_memo_date_2). ' বঙ্গাব্দ'}}
                                                        <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0; border-bottom: 1px solid black;">
                                                        {{\App\Http\PigeonHelpers\otherHelper::en2bn(\App\Http\PigeonHelpers\otherHelper::change_date_format($surrender_letter->sub_header_memo_date_2,false,"d M Y")). ' খ্রিঃ'}}
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table><br>
                            @if(isset($surrender_letter->letter_acknowledgement) && $surrender_letter->letter_acknowledgement!='')
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:100%;">
                                            {!! $surrender_letter->letter_acknowledgement !!}

                                        </td>
                                    </tr>
                                </table>
                            @endif
                            @if(isset($surrender_letter->signature_info_2) && $surrender_letter->signature_info_2!='')
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:60%;"></td>
                                        <td style="width:40%;" class="text-center">
                                                <div class="signed">
                                                    <small>ডিজিটাল সাক্ষরিত চিঠি</small>
                                                    <br>
                                                    @if(isset($surrender_letter->signature_image_2)
                                                        && $surrender_letter->signature_image_2!=''
                                                        && isset($surrender_letter->signature_date_2)
                                                        && $surrender_letter->signature_date_2!=''
                                                        && $surrender_letter->is_signed_2==1
                                                        )
                                                        <img src="{{asset($image_folder.$surrender_letter->signature_image_2)}}" style="height: 30px; width:auto;"><br>
                                                        <span style="margin-left:60px; margin-top:-10px; margin-bottom: 15px;">{{\App\Http\PigeonHelpers\otherHelper::en2bn(\App\Http\PigeonHelpers\otherHelper::change_date_format($surrender_letter->signature_date_2,false,"d/m/Y"))}}</span>
                                                    @else
                                                        <br><br><br>
                                                    @endif
                                                </div>
                                            <div class="unsigned" style="display:none;">
                                                <br><br><br><br>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:60%;"></td>
                                        <td style="width:40%;">
                                            {!! $surrender_letter->signature_info_2 !!}
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

