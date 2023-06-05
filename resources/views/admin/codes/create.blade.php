@extends('admin.layouts.app')

@section('uncommonExCss')
@endsection

@section('uncommonInCss')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('commons/content_header.Add Code')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="addCodeForm" action="{{route('code.store')}}" method="post" class="">
                        <div class="card-body">
                            {{ csrf_field() }}
                            @php
                                $old_data=Session::get('_old_input');
                            @endphp
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> কোড <span class="text-danger">*</span></label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="কোড লিখুন">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">কোডের নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="code_name" id="code_name" class="form-control" placeholder="কোডের নাম লিখুন" value="">
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
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('addCodeForm','কোড যুক্ত করণ ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endsection

@section('uncommonInJs')
    <script>
        $(function (){
            $("#addCodeForm").validate({
                rules: {
                    code: {
                        required:true,
                        remote: {
                            url: "{{ route('check_unique_post') }}",
                            type: "post",
                            data: {
                                _token: csrfToken,
                                table: "codes",
                                column: "code",
                                value: function () {
                                    return $("#code").val();
                                },
                                except_column: null,
                                except_value: null,
                                return_json: true,
                            }
                        }
                    },
                    code_name: {
                        required:true,
                    }
                },
                messages: {
                    code: {
                        required:"কোড ইনপুট দিন।",
                        remote:"কোড আগে ব্যবহার হয়েছে"
                    },
                    code_name: {
                        required:"কোডের নাম ইনপুট দিন।"
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
