@extends('admin.layouts.app')

@section('uncommonExCss')

@endsection

@section('uncommonInCss')
    <style>
        th,td{
            font-size: 12px;
            padding-top:.5rem !important;
            padding-bottom:.5rem !important;
        }
        @media only screen and (max-width: 700px){
            .mb-view{
                display:block;
            }
            .pc-view{
                display:none;
            }
        }

        @media only screen and (min-width: 701px){
            .mb-view{
                display:none;
            }
            .pc-view{
                display:block;
            }
        }

        body {
            scroll-behavior: smooth;
        }

        section{
            padding-top: 55px;
        }
        th{
            text-align: right !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">

                        </h5>
                        <div class="card-tools">
                            <button class="btn btn-default btn-sm" type="button" onclick="printDiv('print_view')"><span class="fa fa-print"></span> Print</button>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Http\PigeonHelpers\otherHelper;
                            use App\User;
                            $created_at= otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->created_at,true,'d/M/Y H:i:s')) ?? '';
                            $updated_at=otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->updated_at,true,'d/M/Y H:i:s')) ?? '';
                            $approved_at=(isset($unit_allotment->approved_at) || $unit_allotment->approved_at='')?otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->approved_at, true, 'd-M-Y H:i')):'';
                            $transaction_date= otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->transaction_date,true,'d/M/Y')) ?? '';
                            $memo_date= otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->memo_date,true,'d/M/Y')) ?? '';
                            $demand_memo_date= otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->demand_memo_date,true,'d/M/Y')) ?? '';
                            $amount=otherHelper::en2bn(otherHelper::taka_format($unit_allotment->amount));
                            $demand_amount=otherHelper::en2bn(otherHelper::taka_format($unit_allotment->demand_amount));
                            $fiscal_year=otherHelper::en2bn($unit_allotment->fiscal_year);
                            $updated_by=User::find($unit_allotment->updated_by);
                            $approved_by=(isset($unit_allotment->approved_by) && $unit_allotment->approved_by>0)?User::find($unit_allotment->approved_by):'';
                            $updated_by=User::find($unit_allotment->updated_by);
                        @endphp
                        <div class="pc-view" id="print_view">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="3" style="text-align:left; vertical-align: center;">
                                            <h6><b>ইউনিটে বরাদ্দের বিস্তারিত তথ্য</b></h6>
                                        </td>
                                        <td style="text-align: right;">
                                            <small>অর্থবছরঃ {{$fiscal_year}}</small><br>
                                            <small>তৈরি হয়েছেঃ {{$created_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন হয়েছেঃ  {{$updated_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন করেছেনঃ  {{$updated_by->name}}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>কোড</th>
                                        <td>{{$unit_allotment->code->code ?? ''}}</td>
                                        <th>ইউনিট</th>
                                        <td>{{$unit_allotment->unit->name_bangla ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>বরাদ্দের অর্থের পরিমান</th>
                                        <td>{{$amount}}</td>
                                        <th>বরাদ্দ খাত</th>
                                        <td>{{$unit_allotment->allocation_sector ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>অনুমোদন করেছেন</th>
                                        <td>{{(isset($unit_allotment->approved_by))?$approved_by->name:''}}</td>
                                        <th>অনুমোদনের তারিখ</th>
                                        <td>{{$approved_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>স্মারক</th>
                                        <td>{{$unit_allotment->memo ?? ''}}</td>
                                        <th>স্মারকের তারিখ</th>
                                        <td>{{$memo_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>চাহিদার স্মারক</th>
                                        <td>{{$unit_allotment->demand_memo ?? ''}}</td>
                                        <th>চাহিদার স্মারকের তারিখ</th>
                                        <td>{{$demand_memo_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>চাহিদার অর্থের পরিমান</th>
                                        <td>{{$demand_amount}}</td>
                                        <th>বর্ণনা</th>
                                        <td class="text-justify">{{$unit_allotment->description ?? ''}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mb-view">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="2" style="text-align:center; vertical-align: center;">
                                            <h6><b>ইউনিটে বরাদ্দের বিস্তারিত তথ্য</b></h6>
                                        </td>
                                        <td colspan="2" style="text-align: center;">
                                            <small>অর্থবছরঃ {{$fiscal_year}}</small><br>
                                            <small>তৈরি হয়েছেঃ {{$created_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন হয়েছেঃ  {{$updated_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন করেছেনঃ  {{$updated_by->name}}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>কোড</th>
                                        <td>{{$unit_allotment->code->code ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>ইউনিট</th>
                                        <td>{{$unit_allotment->unit->name_bangla ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>বরাদ্দের অর্থের পরিমান</th>
                                        <td>{{$amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>বরাদ্দ খাত</th>
                                        <td>{{$unit_allotment->allocation_sector ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>অনুমোদন করেছেন</th>
                                        <td>{{(isset($unit_allotment->approved_by))?$approved_by->name:''}}</td>
                                    </tr>
                                    <tr>
                                        <th>অনুমোদনের তারিখ</th>
                                        <td>{{$approved_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>স্মারক</th>
                                        <td>{{$unit_allotment->memo ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>স্মারকের তারিখ</th>
                                        <td>{{$memo_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>চাহিদার স্মারক</th>
                                        <td>{{$unit_allotment->demand_memo ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>চাহিদার স্মারকের তারিখ</th>
                                        <td>{{$demand_memo_date}}</td>
                                    </tr>
                                    <tr>
                                        <th>চাহিদার অর্থের পরিমান</th>
                                        <td>{{$demand_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">বর্ণনা</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-justify">{{$unit_allotment->description ?? ''}}</td>
                                    </tr>
                                </table>
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

@endsection

@section('uncommonInJs')
    <script>

    </script>
@endsection
