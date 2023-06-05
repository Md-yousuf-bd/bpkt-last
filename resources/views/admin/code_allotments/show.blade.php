@extends('admin.layouts.app')

@section('uncommonExCss')
@endsection

@section('uncommonInCss')
    <style>
        th,
        td {
            font-size: 12px;
            padding-top: .5rem !important;
            padding-bottom: .5rem !important;
        }

        @media only screen and (max-width: 700px) {
            .mb-view {
                display: block;
            }

            .pc-view {
                display: none;
            }
        }

        @media only screen and (min-width: 701px) {
            .mb-view {
                display: none;
            }

            .pc-view {
                display: block;
            }
        }

        body {
            scroll-behavior: smooth;
        }

        section {
            padding-top: 55px;
        }

        th {
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
                            <button class="btn btn-default btn-sm" type="button" onclick="printDiv('print_view')"><span
                                    class="fa fa-print"></span> Print</button>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Http\PigeonHelpers\otherHelper;
                            use App\User;
                            $created_at = otherHelper::en2bn(otherHelper::change_date_format($code_allotment->created_at, true, 'd/M/Y H:i:s')) ?? '';
                            $updated_at = otherHelper::en2bn(otherHelper::change_date_format($code_allotment->updated_at, true, 'd/M/Y H:i:s')) ?? '';
                            $approved_at = isset($code_allotment->approved_at) || ($code_allotment->approved_at = '') ? otherHelper::en2bn(otherHelper::change_date_format($code_allotment->approved_at, true, 'd-M-Y H:i')) : '';
                            $transaction_date = otherHelper::en2bn(otherHelper::change_date_format($code_allotment->transaction_date, true, 'd/M/Y')) ?? '';
                            $allotment_memo_date = otherHelper::en2bn(otherHelper::change_date_format($code_allotment->allotment_memo_date, true, 'd/M/Y')) ?? '';
                            $amount = otherHelper::en2bn(otherHelper::taka_format($code_allotment->amount));
                            $fiscal_year = otherHelper::en2bn($code_allotment->fiscal_year);
                            $updated_by = User::find($code_allotment->updated_by);
                            $approved_by = isset($code_allotment->approved_by) && $code_allotment->approved_by > 0 ? User::find($code_allotment->approved_by) : '';
                            $updated_by = User::find($code_allotment->updated_by);
                        @endphp
                        <div class="pc-view" id="print_view">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="3" style="text-align:left; vertical-align: center;">
                                            <h6><b>কোডে বরাদ্দের বিস্তারিত তথ্য</b></h6>
                                        </td>
                                        <td style="text-align: right;">
                                            <small>অর্থবছরঃ {{ $fiscal_year }}</small><br>
                                            <small>তৈরি হয়েছেঃ {{ $created_at }}</small><br>
                                            <small>সর্বশেষ পরিবর্তন হয়েছেঃ {{ $updated_at }}</small><br>
                                            <small>সর্বশেষ পরিবর্তন করেছেনঃ {{ $updated_by->name }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>কোড</th>
                                        <td>{{ $code_allotment->code->code ?? '' }}</td>
                                        <th>অর্থের পরিমান</th>
                                        <td>{{ $amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>অনুমোদন করেছেন</th>
                                        <td>{{ isset($code_allotment->approved_by) ? $approved_by->name : '' }}</td>
                                        <th>অনুমোদনের তারিখ</th>
                                        <td>{{ $approved_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>বরাদ্দ স্মারক</th>
                                        <td>{{ $code_allotment->allotment_memo ?? '' }}</td>
                                        <th>বরাদ্দ স্মারকের তারিখ</th>
                                        <td>{{ $allotment_memo_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>বর্ণনা</th>
                                        <td colspan="3" class="text-justify">{{ $code_allotment->description ?? '' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mb-view">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td colspan="2" style="text-align:center; vertical-align: center;">
                                            <h6><b>কোডে বরাদ্দের বিস্তারিত তথ্য</b></h6>
                                        </td>
                                        <td colspan="2" style="text-align: center;">
                                            <small>অর্থবছরঃ {{ $fiscal_year }}</small><br>
                                            <small>তৈরি হয়েছেঃ {{ $created_at }}</small><br>
                                            <small>সর্বশেষ পরিবর্তন হয়েছেঃ {{ $updated_at }}</small><br>
                                            <small>সর্বশেষ পরিবর্তন করেছেনঃ {{ $updated_by->name }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>কোড</th>
                                        <td>{{ $code_allotment->code->code ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>অর্থের পরিমান</th>
                                        <td>{{ $amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>অনুমোদন করেছেন</th>
                                        <td>{{ isset($code_allotment->approved_by) ? $approved_by->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>অনুমোদনের তারিখ</th>
                                        <td>{{ $approved_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>বরাদ্দ স্মারক</th>
                                        <td>{{ $code_allotment->allotment_memo ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>বরাদ্দ স্মারকের তারিখ</th>
                                        <td>{{ $allotment_memo_date }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">বর্ণনা</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-justify">{{ $code_allotment->description ?? '' }}
                                        </td>
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
    <script></script>
@endsection
