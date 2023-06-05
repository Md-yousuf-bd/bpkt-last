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
                        <h5 class="card-title">@lang('commons/content_header.Edit Settings')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="editSettingsForm" action="{{route('settings.update')}}" method="post" class="" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">সফটওয়্যার মোড</label>
                                    <select class="form-control select2" id="software_mode" name="software_mode">
                                        <option value="development" @if($setting->software_mode=='development') selected @endif >নির্মাণাধীন</option>
                                        <option value="live" @if($setting->software_mode=='live') selected @endif >চলমান</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">প্রেরক টাইটেল</label>
                                    <input type="text" name="from_mail_title" id="from_mail_title" class="form-control" value="{{$setting->from_mail_title ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label"> বরাদ্দ চিঠির মেইল সাবজেক্ট</label>
                                    <input type="text" name="allotment_letter_mail_subject" id="allotment_letter_mail_subject" class="form-control" value="{{$setting->allotment_letter_mail_subject ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label" style="width:100%;"> বরাদ্দ চিঠির মেইল ফরম্যাট <small class="text-danger float-right"><strong>* [[unit_name]], [[course_name]], [[fiscal_year]], [[code]], [[memo]], [[memo_date]], [[amount]] ট্যাগ গুলো সঠিক স্থানে ব্যবহার করুন।</strong></small></label>
                                    <textarea name="allotment_letter_mail_format" id="allotment_letter_mail_format" class="form-control">{{$setting->allotment_letter_mail_format ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label"> সমর্পণ চিঠির মেইল সাবজেক্ট</label>
                                    <input type="text" name="surrender_letter_mail_subject" id="surrender_letter_mail_subject" class="form-control" value="{{$setting->surrender_letter_mail_subject ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label" style="width:100%;"> সমর্পণ চিঠির মেইল ফরম্যাট <small class="text-danger float-right"><strong>* [[fiscal_year]], [[code]], [[memo]], [[memo_date]], [[amount]] ট্যাগ গুলো সঠিক স্থানে ব্যবহার করুন।</strong></small></label>
                                    <textarea name="surrender_letter_mail_format" id="surrender_letter_mail_format" class="form-control">{{$setting->surrender_letter_mail_format ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label">প্রতি এসএমএস এ খরচ</label>
                                    <input type="number" name="per_sms_cost" id="per_sms_cost" class="form-control" value="{{$setting->per_sms_cost ?? ''}}">
                                </div>
                                <div class="form-group col-md-9 col-sm-12">
                                    <label class="form-control-label"> এসএমএস কোম্পানির নাম</label>
                                    <input type="text" name="sms_company" id="sms_company" class="form-control" value="{{$setting->sms_company ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="form-control-label">এসএমএস সেন্ডার আইডি</label>
                                    <input type="text" name="sms_sender_id" id="sms_sender_id" class="form-control" value="{{$setting->sms_sender_id ?? ''}}">
                                </div>
                                <div class="form-group col-md-9 col-sm-12">
                                    <label class="form-control-label"> এসএমএস এপিআই</label>
                                    <input type="text" name="sms_api" id="sms_api" class="form-control" value="{{$setting->sms_api ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label" style="width:100%;"> বরাদ্দ চিঠির এসএমএস ফরম্যাট <small class="text-danger float-right"><strong>* [[unit_name]], [[course_name]], [[fiscal_year]], [[code]], [[memo]], [[memo_date]], [[amount]] ট্যাগ গুলো সঠিক স্থানে ব্যবহার করুন।</strong></small></label>
                                    <textarea name="allotment_letter_sms_format" id="allotment_letter_sms_format" class="form-control">{{$setting->allotment_letter_sms_format ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label" style="width:100%;"> সমর্পণ চিঠির এসএমএস ফরম্যাট <small class="text-danger float-right"><strong>*  [[fiscal_year]], [[code]], [[memo]], [[memo_date]], [[amount]] ট্যাগ গুলো সঠিক স্থানে ব্যবহার করুন।</strong></small></label>
                                    <textarea name="surrender_letter_sms_format" id="surrender_letter_sms_format" class="form-control">{{$setting->surrender_letter_sms_format ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="submitButton" value="submitForm" style="margin-left: 10px;" class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Update')</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('editSettingsForm','সেটিংস পরিবর্তন ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
    <script src="{{asset('bower/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('uncommonInJs')
    <script>
        $(function (){
            $("#editSettingsForm").validate({
                rules: {
                    from_mail_title:{
                        required:true,
                    },
                    allotment_letter_mail_subject:{
                        required:true,
                    },
                    allotment_letter_mail_format:{
                        required:true,
                    },
                    surrender_letter_mail_subject:{
                        required:true,
                    },
                    surrender_letter_mail_format:{
                        required:true,
                    },
                    per_sms_cost:{
                        required:true,
                    },
                    sms_company:{
                        required:true,
                    },
                    sms_sender_id:{
                        required:true,
                    },
                    sms_api:{
                        required:true,
                    },
                    allotment_letter_sms_format:{
                        required:true,
                    },
                    surrender_letter_sms_format:{
                        required:true,
                    },
                },
                messages: {
                    from_mail_title:{
                        required:'প্রেরক টাইটেল ইনপুট দিন।',
                    },
                    allotment_letter_mail_subject:{
                        required:'বরাদ্দ চিঠির মেইল সাবজেক্ট ইনপুট দিন।',
                    },
                    allotment_letter_mail_format:{
                        required:'বরাদ্দ চিঠির মেইল ফরম্যাট ইনপুট দিন।',
                    },
                    surrender_letter_mail_subject:{
                        required:'সমর্পণ চিঠির মেইল সাবজেক্ট ইনপুট দিন।',
                    },
                    surrender_letter_mail_format:{
                        required:'সমর্পণ চিঠির মেইল ফরম্যাট ইনপুট দিন।',
                    },
                    per_sms_cost:{
                        required:'প্রতি এসএমএস এর খরচ ইনপুট দিন।'
                    },
                    sms_company:{
                        required:'এসএমএস কোম্পানির নাম ইনপুট দিন।',
                    },
                    sms_sender_id:{
                        required:'এসএমএস সেন্ডার আইডি ইনপুট দিন।',
                    },
                    sms_api:{
                        required:'এসএমএস এপিআই ইনপুট দিন।',
                    },
                    allotment_letter_sms_format:{
                        required:'বরাদ্দ চিঠির এসএমএস ফরম্যাট ইনপুট দিন।',
                    },
                    surrender_letter_sms_format:{
                        required:'সমর্পণ চিঠির এসএমএস ফরম্যাট ইনপুট দিন।',
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
            CKEDITOR.replace('allotment_letter_mail_format' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:130,
                line_height:0.3
            });

            CKEDITOR.replace('surrender_letter_mail_format' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:130,
                line_height:0.3
            });
        });
    </script>
@endsection
