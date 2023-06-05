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
                            $created_at= otherHelper::en2bn(otherHelper::change_date_format($unit->created_at,true,'d/M/Y H:i:s')) ?? '';
                            $updated_at=otherHelper::en2bn(otherHelper::change_date_format($unit->updated_at,true,'d/M/Y H:i:s')) ?? '';
                            $updated_by=User::find($unit->updated_by);
                            $created_by=User::find($unit->created_by);
                        @endphp
                        <div class="pc-view" id="print_view">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="3" style="text-align:left; vertical-align: center;">
                                            <h6><b>ইউনিটের বিস্তারিত তথ্য</b></h6>
                                        </td>
                                        <td style="text-align: right;">
                                            <small>তৈরি হয়েছেঃ {{$created_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন হয়েছেঃ  {{$updated_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন করেছেনঃ  {{$updated_by->name}}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>নাম (ইংরেজিতে)</th>
                                        <td>{{$unit->name ?? ''}}</td>
                                        <th>নাম (বাংলায়)</th>
                                        <td>{{$unit->name_bangla ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>উর্ধ্বস্থ রেঞ্জ/মেট্রো</th>
                                        <td>{{$unit->parent_unit->name ?? ''}}</td>
                                        <th>প্রাতিষ্ঠানিক কোড</th>
                                        <td>{{$unit->institution_code ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>অফিস আইডি</th>
                                        <td>{{$unit->office_id ?? ''}}</td>
                                        <th>ডিডিও আইডি</th>
                                        <td>{{$unit->ddo_id ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>ইউনিট প্রধান</th>
                                        <td class="text-justify">
                                            <span>নামঃ {{$unit->unit_head_letter_name ?? ''}}</span><br>
                                            <span>ইমেইলঃ  {{$unit->unit_head_email ?? ''}}</span><br>
                                            <span>মোবাইল নম্বরঃ  {{$unit->unit_head_mobile ?? ''}}</span>
                                        </td>
                                        <th>দৃঃ আঃ এর জন্য অফিসার</th>
                                        <td class="text-justify">
                                                <span>নামঃ {{$unit->for_attention_letter_name ?? ''}}</span><br>
                                                <span>ইমেইলঃ  {{$unit->for_attention_letter_name ?? ''}}</span><br>
                                                <span>মোবাইল নম্বরঃ  {{$unit->for_attention_letter_name ?? ''}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>বর্ণনা</th>
                                        <td colspan="3" class="text-justify">{{$unit->description ?? ''}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mb-view">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="2" style="text-align:center;">
                                            <h6><b>ইউনিটের বিস্তারিত তথ্য</b></h6>
                                        </td>
                                        <td colspan="2" style="text-align: center;">
                                            <small>তৈরি হয়েছেঃ {{$created_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন হয়েছেঃ  {{$updated_at}}</small><br>
                                            <small>সর্বশেষ পরিবর্তন করেছেনঃ  {{$updated_by->name}}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>নাম (ইংরেজিতে)</th>
                                        <td>{{$unit->name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>নাম (বাংলায়)</th>
                                        <td>{{$unit->name_bangla ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>উর্ধ্বস্থ রেঞ্জ/মেট্রো</th>
                                        <td>{{$unit->parent_unit->name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>প্রাতিষ্ঠানিক কোড</th>
                                        <td>{{$unit->institution_code ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>অফিস আইডি</th>
                                        <td>{{$unit->office_id ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>ডিডিও আইডি</th>
                                        <td>{{$unit->ddo_id ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" >ইউনিট প্রধান</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"  class="text-justify">
                                            <span>নামঃ {{$unit->unit_head_letter_name ?? ''}}</span><br>
                                            <span>ইমেইলঃ  {{$unit->unit_head_email ?? ''}}</span><br>
                                            <span>মোবাইল নম্বরঃ  {{$unit->unit_head_mobile ?? ''}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">দৃঃ আঃ এর জন্য অফিসার</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-justify">
                                            <span>নামঃ {{$unit->for_attention_letter_name ?? ''}}</span><br>
                                            <span>ইমেইলঃ  {{$unit->for_attention_letter_name ?? ''}}</span><br>
                                            <span>মোবাইল নম্বরঃ  {{$unit->for_attention_letter_name ?? ''}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">বর্ণনা</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-justify">{{$unit->description ?? ''}}</td>
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
