@extends('admin.layouts.app')

@section('uncommonExCss')
    <link rel="stylesheet" type="text/css" href="{{asset('bower/pikaday/pikaday.css')}}">
@endsection

@section('uncommonInCss')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('commons/content_header.Add Code Allotment')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="addCodeAllotmentForm" action="{{route('code-allotment.store')}}" method="post" class="">
                        <div class="card-body">
                            {{ csrf_field() }}
                            @php
                                $old_data=Session::get('_old_input');
                            @endphp
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">কোড</label>
                                    <select class="form-control select2" name="code_id" id="code_id" style="width:100%;">
                                        @foreach($codes as $opt)
                                            <option value="{{$opt->id}}" @if($old_data!=null && $old_data['code_id'] == $opt->id) selected @endif>{{$opt->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label"> অর্থের পরিমাণ <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="অর্থের পরিমাণ লিখুন" value="@if($old_data!=null){{$old_data['amount']}}@else{{1}}@endif">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">বরাদ্দের তারিখ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="transaction_date" name="transaction_date" readonly="readonly" value="@if($old_data!=null) {{$old_data['transaction_date'] ?? ''}} @else {{date('Y-m-d')}} @endif">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('transaction_date')">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">বরাদ্দের স্মারক</label>
                                    <input type="text" name="allotment_memo" id="allotment_memo" class="form-control" placeholder="বরাদ্দের স্মারক লিখুন"  value="@if($old_data!=null){{$old_data['allotment_memo']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">বরাদ্দের স্মারকের তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="allotment_memo_date" name="allotment_memo_date" readonly="readonly" placeholder="বরাদ্দের স্মারকের তারিখ লিখুন"  value="@if($old_data!=null){{$old_data['allotment_memo_date']}}@endif">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('allotment_memo_date')">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label"> বর্ণনা</label>
                                    <textarea name="description" id="description" class="form-control">@if($old_data!=null) {{$old_data['description']}} @endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="submitButton" value="submitForm" style="margin-left: 10px;" class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Submit')</button>
                                    <button type="submit" name="submitButton" value="fastSubmitForm" class="btn btn-sm btn-success float-right">@lang('commons/buttons.Fast Submit')</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('addCodeAllotmentForm','কোডের বরাদ্দ যুক্ত করণ ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- .content -->
@endsection

@section('uncommonExJs')
    <script src="{{asset('bower/pikaday/pikaday.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endsection

@section('uncommonInJs')
    <script>
        $(function (){
            init_datepicker('transaction_date');
            init_datepicker('allotment_memo_date');
            $("#addCodeAllotmentForm").validate({
                rules: {
                    amount: {
                        required:true,
                        min:1,
                    },
                    transaction_date:{
                        required:true,
                    },
                },
                messages: {
                    amount: {
                        required:"বরাদ্দ অর্থের পরিমান ইনপুট দিন।",
                        min:"বরাদ্দ অর্থের পরিমান 1 বা এর বেশি হতে হবে।"
                    },
                    transaction_date: {
                        required:"বরাদ্দের তারিখ ইনপুট দিন।"
                    }
                },
                errorPlacement: function ( error, element ) {
                    if(element.parent().hasClass('input-group')){
                        error.insertAfter( element.parent() );
                    }
                    else if(element.hasClass('select2'))
                    {
                        let sibling=element.siblings('span');
                        error.insertAfter( sibling );
                    }
                    else{
                        error.insertAfter( element );
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    </script>
@endsection
