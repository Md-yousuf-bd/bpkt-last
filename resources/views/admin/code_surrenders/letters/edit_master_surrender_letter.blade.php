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
                        <h5 class="card-title">@lang('commons/content_header.Edit Master Surrender Letter')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="editMasterSurrenderLetterForm" action="{{route('master-surrender-letter.update')}}" method="post" class="" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">হেডিং</label>
                                    <textarea name="header_middle_heading" id="header_middle_heading" style="width: 100%;">{{$master_surrender_letter->header_middle_heading ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row" style="text-align: center !important;">
                                <div class="form-group col-md-6 col-sm-12" style="min-height: 200px;float: left;">
                                    <label class="form-control-label">বাম হেডিং লোগো</label><br>
                                    <label class="form-control-label up-image">
                                        <div class="container">
                                            @php $header_left_logo='images/defaults/default.jpg'; @endphp
                                            @if(isset($master_surrender_letter->header_left_logo)&&$master_surrender_letter->header_left_logo!='')
                                                @php $header_left_logo= 'storage/images/master_surrender_letters/'.$master_surrender_letter->header_left_logo; @endphp
                                            @endif
                                            <img src="{{asset($header_left_logo)}}" class="image rounded" id="header_left_logo_image"  style="width: auto; height: 120px;">
                                            <input type="file" name="header_left_logo" id="header_left_logo" accept="image/png, image/jpg, image/jpeg" style="display:none;">
                                            <div class="middle">
                                                <div class="text"> ছবি পরিবর্তন করতে ক্লিক করুন</div>
                                            </div>
                                        </div>
                                    </label><br>
                                    <div style="width: 100%; text-align: center;">
                                        <input type="hidden" id="header_left_logo_delete" name="header_left_logo_delete" disabled>
                                        @if(isset($master_surrender_letter->header_left_logo)&&$master_surrender_letter->header_left_logo!='')
                                            <button type="button" class="btn btn-sm btn-danger" id="header_left_logo_delete_btn" onclick="clearImg('header_left_logo_delete_btn','header_left_logo_delete','header_left_logo','header_left_logo_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" id="header_left_logo_delete_btn" style="display:none;" onclick="clearImg('header_left_logo_delete_btn','header_left_logo_delete','header_left_logo','header_left_logo_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="min-height: 200px;float: right;">
                                    <label class="form-control-label">ডান হেডিং লোগো</label><br>
                                    <label class="form-control-label up-image">
                                        <div class="container">
                                            @php $header_right_logo='images/defaults/default.jpg'; @endphp
                                            @if(isset($master_surrender_letter->header_right_logo)&&$master_surrender_letter->header_right_logo!='')
                                                @php $header_right_logo= 'storage/images/master_surrender_letters/'.$master_surrender_letter->header_right_logo; @endphp
                                            @endif
                                            <img src="{{asset($header_right_logo)}}" class="image rounded" id="header_right_logo_image"  style="width: auto; height: 120px;">
                                            <input type="file" name="header_right_logo" id="header_right_logo" accept="image/png, image/jpg, image/jpeg" style="display:none;">
                                            <div class="middle">
                                                <div class="text"> ছবি পরিবর্তন করতে ক্লিক করুন</div>
                                            </div>
                                        </div>
                                    </label><br>
                                    <div style="width: 100%; text-align: center;">
                                        <input type="hidden" id="header_right_logo_delete" name="header_right_logo_delete" disabled>
                                        @if(isset($master_surrender_letter->header_right_logo)&&$master_surrender_letter->header_right_logo!='')
                                            <button type="button" class="btn btn-sm btn-danger" id="header_right_logo_delete_btn" onclick="clearImg('header_right_logo_delete_btn','header_right_logo_delete','header_right_logo','header_right_logo_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" id="header_right_logo_delete_btn" style="display:none;" onclick="clearImg('header_right_logo_delete_btn','header_right_logo_delete','header_right_logo','header_right_logo_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">নথি নং</label>
                                    <input type="text" class="form-control" name="sub_header_memo_first_part" id="sub_header_memo_first_part" value="{{$master_surrender_letter->sub_header_memo_first_part ?? ''}}">
                                </div>
{{--                                <div class="form-group col-md-6 col-sm-12">--}}
{{--                                    <label class="form-control-label">নথি নং (চিঠির নিচের অংশ)</label>--}}
{{--                                    <input type="text" class="form-control" name="sub_header_memo_first_part_2" id="sub_header_memo_first_part_2" value="{{$master_surrender_letter->sub_header_memo_first_part_2 ?? ''}}">--}}
{{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">বিষয়</label>
                                    <textarea name="subject" id="subject" style="width: 100%;">{{$master_surrender_letter->subject ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">সূত্র</label>
                                    <textarea name="reference" id="reference" style="width: 100%;">{{$master_surrender_letter->reference ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">বর্ণনা</label>
                                    <textarea name="description" id="description" style="width: 100%;">{{$master_surrender_letter->description ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">নির্দেশনা</label>
                                    <textarea name="instructions" id="instructions" style="width: 100%;">{{$master_surrender_letter->instructions ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row" style="text-align: center !important;">
                                <div class="form-group col-md-12 col-sm-12" style="min-height: 200px;float: left;">
                                    <label class="form-control-label">সাক্ষরের ছবি</label><br>
                                    <label class="form-control-label up-image">
                                        <div class="container">
                                            @php $signature_image='images/defaults/default.jpg'; @endphp
                                            @if(isset($master_surrender_letter->signature_image)&&$master_surrender_letter->signature_image!='')
                                                @php $signature_image= 'storage/images/master_surrender_letters/'.$master_surrender_letter->signature_image; @endphp
                                            @endif
                                            <img src="{{asset($signature_image)}}" class="image rounded" id="signature_image_image"  style="width: auto; height: 120px;">
                                            <input type="file" name="signature_image" id="signature_image" accept="image/png, image/jpg, image/jpeg" style="display:none;">
                                            <div class="middle">
                                                <div class="text"> ছবি পরিবর্তন করতে ক্লিক করুন</div>
                                            </div>
                                        </div>
                                    </label><br>
                                    <div style="width: 100%; text-align: center;">
                                        <input type="hidden" id="signature_image_delete" name="signature_image_delete" disabled>
                                        @if(isset($master_surrender_letter->signature_image)&&$master_surrender_letter->signature_image!='')
                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_delete_btn" onclick="clearImg('signature_image_delete_btn','signature_image_delete','signature_image','signature_image_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_delete_btn" style="display:none;" onclick="clearImg('signature_image_delete_btn','signature_image_delete','signature_image','signature_image_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="form-group col-md-6 col-sm-12" style="min-height: 200px;float: right;">--}}
{{--                                    <label class="form-control-label">সাক্ষরের ছবি (নিচের জন্য)</label><br>--}}
{{--                                    <label class="form-control-label up-image">--}}
{{--                                        <div class="container">--}}
{{--                                            @php $signature_image_2='images/defaults/default.jpg'; @endphp--}}
{{--                                            @if(isset($master_surrender_letter->signature_image_2)&&$master_surrender_letter->signature_image_2!='')--}}
{{--                                                @php $signature_image_2= 'storage/images/master_surrender_letters/'.$master_surrender_letter->signature_image_2; @endphp--}}
{{--                                            @endif--}}
{{--                                            <img src="{{asset($signature_image_2)}}" class="image rounded" id="signature_image_2_image"  style="width: auto; height: 120px;">--}}
{{--                                            <input type="file" name="signature_image_2" id="signature_image_2" accept="image/png, image/jpg, image/jpeg" style="display:none;">--}}
{{--                                            <div class="middle">--}}
{{--                                                <div class="text"> ছবি পরিবর্তন করতে ক্লিক করুন</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </label><br>--}}
{{--                                    <div style="width: 100%; text-align: center;">--}}
{{--                                        <input type="hidden" id="signature_image_2_delete" name="signature_image_2_delete" disabled>--}}
{{--                                        @if(isset($master_surrender_letter->signature_image_2)&&$master_surrender_letter->signature_image_2!='')--}}
{{--                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_2_delete_btn" onclick="clearImg('signature_image_2_delete_btn','signature_image_2_delete','signature_image_2','signature_image_2_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>--}}
{{--                                        @else--}}
{{--                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_2_delete_btn" style="display:none;" onclick="clearImg('signature_image_2_delete_btn','signature_image_2_delete','signature_image_2','signature_image_2_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">স্বাক্ষর বিবরণি</label>
                                    <textarea name="signature_info" id="signature_info" style="width: 100%;">{{$master_surrender_letter->signature_info ?? ''}}</textarea>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-12 col-sm-12">--}}
{{--                                    <label class="form-control-label">স্বাক্ষর বিবরণি (নিচের অংশ)</label>--}}
{{--                                    <textarea name="signature_info_2" id="signature_info_2" style="width: 100%;">{{$master_surrender_letter->signature_info_2 ?? ''}}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">প্রাপক</label>
                                    <textarea name="letter_to" id="letter_to" style="width: 100%;">{{$master_surrender_letter->letter_to ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">প্রাপক ইউনিট প্রধানের ইমেইল</label>
                                    <input type="text" name="letter_to_email" id="letter_to_email" class="form-control" value="{{$master_surrender_letter->letter_to_email ?? ''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">প্রাপক ইউনিট প্রধানের মোবাইল নং</label>
                                    <input type="text" name="letter_to_phone" id="letter_to_phone" class="form-control" value="{{$master_surrender_letter->letter_to_phone ?? ''}}">
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-12 col-sm-12">--}}
{{--                                    <label class="form-control-label">জ্ঞাতার্থে</label>--}}
{{--                                    <textarea name="letter_acknowledgement" id="letter_acknowledgement" style="width: 100%;">{{$master_surrender_letter->letter_acknowledgement ?? ''}}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="submitButton" value="submitForm" style="margin-left: 10px;" class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Update')</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('editMasterSurrenderLetterForm','কোডে সমর্পণের চিঠি পরিবর্তন ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
    <script src="{{asset('bower/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endsection

@section('uncommonInJs')
    <script>
        $(function (){
            $("#header_left_logo").change(function() {
                readURL(this,'header_left_logo_image');
                $('#header_left_logo_delete_btn').css('display','initial');
                let header_left_logo_delete_obj=$('#header_left_logo_delete');
                header_left_logo_delete_obj.attr('disabled','disabled');
                header_left_logo_delete_obj.val('');
            });
            $("#header_right_logo").change(function() {
                readURL(this,'header_right_logo_image');
                $('#header_right_logo_delete_btn').css('display','initial');
                let header_right_logo_delete_obj=$('#header_right_logo_delete');
                header_right_logo_delete_obj.attr('disabled','disabled');
                header_right_logo_delete_obj.val('');
            });
            $("#signature_image").change(function() {
                readURL(this,'signature_image_image');
                $('#signature_image_delete_btn').css('display','initial');
                let signature_image_delete_obj=$('#signature_image_delete');
                signature_image_delete_obj.attr('disabled','disabled');
                signature_image_delete_obj.val('');
            });
            $("#signature_image_2").change(function() {
                readURL(this,'signature_image_2_image');
                $('#signature_image_2_delete_btn').css('display','initial');
                let signature_image_2_delete_obj=$('#signature_image_2_delete');
                signature_image_2_delete_obj.attr('disabled','disabled');
                signature_image_2_delete_obj.val('');
            });
            CKEDITOR.replace('header_middle_heading' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:130,
                line_height:0.3
            });
            CKEDITOR.replace('subject' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:80,
                line_height:0.3
            });
            CKEDITOR.replace('reference' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:80,
                line_height:0.3
            });
            CKEDITOR.replace('description' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:100,
                line_height:0.3
            });
            CKEDITOR.replace('instructions' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:100,
                line_height:0.3
            });
            CKEDITOR.replace('signature_info' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:150,
                line_height:0.3
            });
            CKEDITOR.replace('signature_info_2' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:150,
                line_height:0.3
            });
            CKEDITOR.replace('letter_to' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:150,
                line_height:0.3
            });
            // CKEDITOR.replace('letter_acknowledgement' , {
            //     toolbarCanCollapse: true,
            //     toolbarStartupExpanded: false,
            //     enterMode: CKEDITOR.ENTER_BR,
            //     shiftEnterMode: CKEDITOR.ENTER_P,
            //     extraPlugins: 'divarea,tableresize',
            //     height:150,
            //     line_height:0.3
            // });
        });

        $(window).on('load',function(){
        });
    </script>
@endsection
