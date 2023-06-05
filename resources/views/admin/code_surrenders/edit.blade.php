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
                        <h5 class="card-title">@lang('commons/content_header.Edit Code Surrender')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="editCodeSurrenderForm" action="{{route('code-surrender.update',[$code_surrender->id])}}" method="post" class="">
                        <div class="card-body">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label" style="width:100%;">কোড <small class="float-right text-info text-bold">অননুমোদিত ব্যালেন্সঃ <span id="show_code_unapproved_balance"></span></small></label>
                                    <select class="form-control select2" name="code_id" id="code_id" style="width:100%;">
                                        @foreach($codes as $opt)
                                            <option value="{{$opt->id}}" @if($code_surrender->code_id == $opt->id) selected @endif>{{$opt->code ?? ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="input_code_unapproved_balance" value="0">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">সমর্পনের অর্থের পরিমাণ <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="অর্থের পরিমাণ লিখুন" @if($code_surrender->status==1) readonly="readonly" @endif value="{{$code_surrender->amount ?? 0}}">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">সমর্পনের তারিখ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="transaction_date" name="transaction_date" readonly="readonly" value="{{$code_surrender->transaction_date ?? ''}}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('transaction_date')">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-6 col-sm-12">--}}
{{--                                    <label class="form-control-label"> স্মারক</label>--}}
{{--                                    <input type="text" name="memo" id="memo" class="form-control" @if($code_surrender->status==0) placeholder="সমর্পন অনুমোদনের পর স্মারক লিখতে হবে" disabled @else placeholder="সমর্পন পত্রের স্মারক লিখুন" @endif  value="{{$code_surrender->memo ?? ''}}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6 col-sm-12">--}}
{{--                                    <label class="form-control-label">স্মারকের তারিখ</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" class="form-control" id="memo_date" name="memo_date"  @if($code_surrender->status==0)  disabled="disabled" placeholder="সমর্পন অনুমোদনের পর স্মারকের তারিখ লিখতে হবে" @else readonly="readonly" placeholder="সমর্পন পত্রের স্মারকের তারিখ ইনপুট দিন" @endif  value="{{$code_surrender->memo_date ?? ''}}">--}}
{{--                                        <div class="input-group-append">--}}
{{--                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('memo_date')" @if($code_surrender->status==0) disabled @endif >Clear</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label"> বর্ণনা</label>
                                    <textarea name="description" id="description" class="form-control">{{$code_surrender->description ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="submitButton" value="submitForm" style="margin-left: 10px;" class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Update')</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('editCodeSurrenderForm','কোডে সমর্পন যুক্ত করণ ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
{{--            @if($code_surrender->status==1)--}}
{{--            init_datepicker('memo_date');--}}
{{--            @endif--}}
            init_datepicker('transaction_date');
            $("#editCodeSurrenderForm").validate({
                rules: {
                    amount: {
                        required:true,
                        min:1,
                        @if($code_surrender->status!=1)
                        max: function (){
                            let input_code_unapproved_balance =$('#input_code_unapproved_balance').val();
                            return parseFloat(input_code_unapproved_balance);
                        }
                        @endif
                    },
                    transaction_date:{
                        required:true,
                    },
                },
                messages: {
                    amount: {
                        required:"সমর্পন অর্থের পরিমান ইনপুট দিন।",
                        min:"সমর্পন অর্থের পরিমান 1 বা এর বেশি হতে হবে।",
                        @if($code_surrender->status!=1)
                        max:"সমর্পন অর্থের পরিমান অনুনোমোদিত কোড ব্যালেন্স এর কম অথবা সমান হতে হবে।"
                        @endif

                    },
                    transaction_date: {
                        required:"সমর্পনের তারিখ ইনপুট দিন।"
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

        function set_code_unapproved_balance(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let route = '{{route('code.get_unapproved_balance')}}';
            $.ajax({
                url: route,
                data: {
                    code_id: $('#code_id').val(),
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        $('#show_code_unapproved_balance').html(taka_format(response.unapproved_balance)+' টাকা');
                        $('#input_code_unapproved_balance').val(response.unapproved_balance);
                    }
                }
            });
        }
        $(window).on('load',function(){
            set_code_unapproved_balance();
        });

        $('#code_id').on('change',function (){
            set_code_unapproved_balance();
        });
    </script>
@endsection
