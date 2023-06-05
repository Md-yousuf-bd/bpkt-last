@extends('admin.layouts.app')

@section('uncommonExCss')
    <link rel="stylesheet" type="text/css" href="{{asset('bower/pikaday/pikaday.css')}}">
@endsection

@section('uncommonInCss')
    <style>
        th,td{
            padding: 6px 4px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('commons/content_header.Add Allotment Letter')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="addUnitAllotmentLetterForm" action="{{route('unit-allotment-letter.store')}}" method="post" class="" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">হেডিং</label>
                                    <textarea name="header_middle_heading" id="header_middle_heading" style="width: 100%;">{{$master_allotment_letter->header_middle_heading ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row" style="text-align: center !important;">
                                <div class="form-group col-md-6 col-sm-12" style="min-height: 200px;float: left;">
                                    <label class="form-control-label">বাম হেডিং লোগো</label><br>
                                    <label class="form-control-label up-image">
                                        <div class="container">
                                            @php $header_left_logo='images/defaults/default.jpg'; @endphp
                                            @if(isset($master_allotment_letter->header_left_logo)&&$master_allotment_letter->header_left_logo!='')
                                                @php $header_left_logo= 'storage/images/master_allotment_letters/'.$master_allotment_letter->header_left_logo; @endphp
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
                                        @if(isset($master_allotment_letter->header_left_logo)&&$master_allotment_letter->header_left_logo!='')
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
                                            @if(isset($master_allotment_letter->header_right_logo)&&$master_allotment_letter->header_right_logo!='')
                                                @php $header_right_logo= 'storage/images/master_allotment_letters/'.$master_allotment_letter->header_right_logo; @endphp
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
                                        @if(isset($master_allotment_letter->header_right_logo)&&$master_allotment_letter->header_right_logo!='')
                                            <button type="button" class="btn btn-sm btn-danger" id="header_right_logo_delete_btn" onclick="clearImg('header_right_logo_delete_btn','header_right_logo_delete','header_right_logo','header_right_logo_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" id="header_right_logo_delete_btn" style="display:none;" onclick="clearImg('header_right_logo_delete_btn','header_right_logo_delete','header_right_logo','header_right_logo_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">নথি নং (চিঠির উপরের অংশ)</label>
                                    <input type="text" class="form-control" name="sub_header_memo_first_part" id="sub_header_memo_first_part" value="{{$master_allotment_letter->sub_header_memo_first_part ?? ''}}">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">স্মারক নং (চিঠির উপরের অংশ)</label>
                                    <input type="text" class="form-control" name="sub_header_memo_second_part" id="sub_header_memo_second_part" disabled title="চিঠির উপরের অংশ সাক্ষরিত নয়">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">স্মারকের তারিখ (চিঠির উপরের অংশ)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="sub_header_memo_date" name="sub_header_memo_date" readonly="readonly" title="চিঠির উপরের অংশ সাক্ষরিত নয়" placeholder="স্মারকের তারিখ লিখুন">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" title="চিঠির উপরের অংশ সাক্ষরিত নয়" onclick="clearThis('sub_header_memo_date')">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">নথি নং (চিঠির নিচের অংশ)</label>
                                    <input type="text" class="form-control" name="sub_header_memo_first_part_2" id="sub_header_memo_first_part_2" value="{{$master_allotment_letter->sub_header_memo_first_part_2 ?? ''}}">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">স্মারক নং (চিঠির নিচের অংশ)</label>
                                    <input type="text" class="form-control" name="sub_header_memo_second_part_2" id="sub_header_memo_second_part_2" disabled title="চিঠির নিচের অংশ সাক্ষরিত নয়">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">স্মারকের তারিখ (চিঠির নিচের অংশ)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="sub_header_memo_date_2" name="sub_header_memo_date_2" readonly="readonly" title="চিঠির নিচের অংশ সাক্ষরিত নয়" placeholder="স্মারকের তারিখ লিখুন">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('sub_header_memo_date_2')" title="চিঠির নিচের অংশ সাক্ষরিত নয়">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">বিষয়</label>
                                    <textarea name="subject" id="subject" style="width: 100%;">{{$master_allotment_letter->subject ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">সূত্র</label>
                                    <textarea name="reference" id="reference" style="width: 100%;">{{$master_allotment_letter->reference ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">বর্ণনা</label>
                                    <textarea name="description" id="description" style="width: 100%;">{{$master_allotment_letter->description ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label" style="width: 100%;">বরাদ্দ ছক <button type="button" class="btn btn-xs btn-success float-right" style="margin-left: 10px;" id="addAllotmentBtn"><span class="fa fa-plus-square"></span> &nbsp; বরাদ্দ যুক্ত করুন</button><span class=" float-right"><input type="hidden"  id="linked_allotments_count" name="linked_allotments_count" value="0"></span></label>
                                    <div id="linked_allotments" style="display: none;">

                                    </div>
                                    <textarea name="allotment_table" id="allotment_table" style="width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">নির্দেশনা</label>
                                    <textarea name="instructions" id="instructions" style="width: 100%;">{{$master_allotment_letter->instructions ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row" style="text-align: center !important;">
                                <div class="form-group col-md-6 col-sm-12" style="min-height: 200px;float: left;">
                                    <label class="form-control-label">সাক্ষরের ছবি (ঊপরের জন্য)</label><br>
                                    <label class="form-control-label up-image">
                                        <div class="container">
                                            @php $signature_image='images/defaults/default.jpg'; @endphp
                                            @if(isset($master_allotment_letter->signature_image)&&$master_allotment_letter->signature_image!='')
                                                @php $signature_image= 'storage/images/master_allotment_letters/'.$master_allotment_letter->signature_image; @endphp
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
                                        @if(isset($master_allotment_letter->signature_image)&&$master_allotment_letter->signature_image!='')
                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_delete_btn" onclick="clearImg('signature_image_delete_btn','signature_image_delete','signature_image','signature_image_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_delete_btn" style="display:none;" onclick="clearImg('signature_image_delete_btn','signature_image_delete','signature_image','signature_image_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="min-height: 200px;float: right;">
                                    <label class="form-control-label">সাক্ষরের ছবি (নিচের জন্য)</label><br>
                                    <label class="form-control-label up-image">
                                        <div class="container">
                                            @php $signature_image_2='images/defaults/default.jpg'; @endphp
                                            @if(isset($master_allotment_letter->signature_image_2)&&$master_allotment_letter->signature_image_2!='')
                                                @php $signature_image_2= 'storage/images/master_allotment_letters/'.$master_allotment_letter->signature_image_2; @endphp
                                            @endif
                                            <img src="{{asset($signature_image_2)}}" class="image rounded" id="signature_image_2_image"  style="width: auto; height: 120px;">
                                            <input type="file" name="signature_image_2" id="signature_image_2" accept="image/png, image/jpg, image/jpeg" style="display:none;">
                                            <div class="middle">
                                                <div class="text"> ছবি পরিবর্তন করতে ক্লিক করুন</div>
                                            </div>
                                        </div>
                                    </label><br>
                                    <div style="width: 100%; text-align: center;">
                                        <input type="hidden" id="signature_image_2_delete" name="signature_image_2_delete" disabled>
                                        @if(isset($master_allotment_letter->signature_image_2)&&$master_allotment_letter->signature_image_2!='')
                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_2_delete_btn" onclick="clearImg('signature_image_2_delete_btn','signature_image_2_delete','signature_image_2','signature_image_2_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" id="signature_image_2_delete_btn" style="display:none;" onclick="clearImg('signature_image_2_delete_btn','signature_image_2_delete','signature_image_2','signature_image_2_image','{{asset("images/defaults/default.jpg")}}')"> <span class="fa fa-trash-o"></span> Delete</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-6">
                                    <label class="form-control-label">চিঠি স্বাক্ষর (উপরের অংশে)</label>
                                    <select class="form-control select2" name="is_signed" id="is_signed" @if(!auth()->user()->can('sign-allotment-letter')) disabled title="আপনার পত্রটি সাক্ষরের অনুমতি নেই।" @endif>
                                        <option value="0">হয়নি</option>
                                        <option value="1">হয়েছে</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6">
                                    <label class="form-control-label">সাক্ষরের তারিখ (উপরের অংশে)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="signature_date" name="signature_date" readonly="readonly" placeholder="সাক্ষরের তারিখ লিখুন" @if(!auth()->user()->can('sign-allotment-letter')) disabled title="আপনার পত্রটি সাক্ষরের অনুমতি নেই।" @endif>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('signature_date')" @if(!auth()->user()->can('sign-allotment-letter')) disabled title="আপনার পত্রটি সাক্ষরের অনুমতি নেই।" @endif>Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-6">
                                    <label class="form-control-label">চিঠি স্বাক্ষর (নিচের অংশে)</label>
                                    <select class="form-control select2" name="is_signed_2" id="is_signed_2" @if(!auth()->user()->can('sign-allotment-letter')) disabled title="আপনার পত্রটি সাক্ষরের অনুমতি নেই।" @endif>
                                        <option value="0">হয়নি</option>
                                        <option value="1">হয়েছে</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-6">
                                    <label class="form-control-label">সাক্ষরের তারিখ (নিচের অংশে)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="signature_date_2" name="signature_date_2" readonly="readonly" placeholder="সাক্ষরের তারিখ লিখুন" @if(!auth()->user()->can('sign-allotment-letter')) disabled title="আপনার পত্রটি সাক্ষরের অনুমতি নেই।" @endif>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button" onclick="clearThis('signature_date_2')" @if(!auth()->user()->can('sign-allotment-letter')) disabled title="আপনার পত্রটি সাক্ষরের অনুমতি নেই।" @endif>Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">সংযুক্তির তথ্য</label>
                                    <textarea name="signature_info_left" id="signature_info_left" style="width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">স্বাক্ষর বিবরণি (উপরের অংশ)</label>
                                    <textarea name="signature_info" id="signature_info" style="width: 100%;">{{$master_allotment_letter->signature_info ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label">স্বাক্ষর বিবরণি (নিচের অংশ)</label>
                                    <textarea name="signature_info_2" id="signature_info_2" style="width: 100%;">{{$master_allotment_letter->signature_info_2 ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <button type="button" class="form-control-label btn btn-dark btn-sm mb-2 off" id="letter_to_editor_button">বিতরণের তথ্য পরিবর্তন করুন</button>
                                    <div style="display:none;" id="letter_to_hidden_input"></div>
                                    <div class="showing-box" id="letter_to_showing_box"></div>
                                    <div id="letter_to_field" style="display: none;">
                                        <textarea name="letter_to" id="letter_to" style="width: 100%;">
    {{--                                        {{$master_allotment_letter->letter_to ?? ''}}--}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <button type="button" class="form-control-label btn btn-dark btn-sm mb-2" id="letter_acknowledgement_modal_button">অনুলিপির তথ্য পরিবর্তন করুন</button>
                                    <button type="button" style="margin-left: 10px;" class="form-control-label btn btn-dark btn-sm mb-2 off" id="letter_acknowledgement_editor_button">সর্বশেষ পরিবর্তন করুন</button>
                                    <br>
                                    <div style="display:none;" id="letter_acknowledgement_hidden_input"></div>
                                    <div class="showing-box" id="letter_acknowledgement_showing_box"></div>
                                    <div id="letter_acknowledgement_field" style="display: none;">
                                        <textarea name="letter_acknowledgement" id="letter_acknowledgement" style="width: 100%;">
    {{--                                        {{$master_allotment_letter->letter_acknowledgement ?? ''}}--}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" style="margin-left: 10px;" class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Submit')</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('addUnitAllotmentLetterForm','ইউনিটে বরাদ্দ চিঠি যুক্ত করণ ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="allotmentSubFormModal" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterLabel">বরাদ্দ যুক্ত করুন</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card card-body float-right" style="width:90%; overflow-y:auto; max-height: 400px; box-shadow: 0 0 2px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.2) !important;">
                                <div class="row">
                                    <div class="form-group col-md-10 col-sm-8">
                                        <select class="form-control select2" id="unlinked_allotments" style="width:100%;">

                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 col-sm-4 text-right">
                                        <button class="btn btn-success btn-xs" style="float: right !important;" type="button" id="addAllotmentToTableBtn"><span class="fa fa-plus-circle"></span> যুক্ত করুন</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <h5 class="text-center"><u>ছক</u></h5>
                                <table id="modalAllotmentTable" class="table table-bordered table-hover" style="width:100%; max-height: 700px; overflow-y: auto;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ক্রমিক</th>
                                        <th>ইউনিটের নাম</th>
                                        <th>কোর্সের নাম</th>
                                        <th>অফিস আইডি</th>
                                        <th>ডিডিও আইডি</th>
                                        <th>বরাদ্দকৃত অর্থ</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button class="btn btn-warning btn-xs" style="float: right !important;" type="button" id="changeAllotmentTableBtn"><span class="fa fa-thumbs-up"></span> বরাদ্দ ছক পরিবর্তন করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acknowledgementFormModal" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterLabel">অনুলিপির জন্য প্রাপক যুক্ত করুন</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card card-body float-right" style="width:90%; overflow-y:auto; max-height: 400px; box-shadow: 0 0 2px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.2) !important;">
                                <div class="row">
                                    <div class="form-group col-md-10 col-sm-8">
                                        <select class="form-control select2" id="select_letter_acknowledgement_recipient" multiple style="width:100%;">

                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 col-sm-4 text-right">
                                        <button class="btn btn-success btn-xs" style="float: right !important;" type="button" id="addLetterAcknowledgementRecipientBtn"><span class="fa fa-plus-circle"></span> যুক্ত করুন</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <h5 class="text-center"><u>ছক</u></h5>
                                <table id="modalLetterAcknowledgementRecipientTable" class="table table-bordered table-hover" style="width:100%; max-height: 700px; overflow-y: auto;">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ক্রমিক</th>
                                        <th>ইউনিটের নাম</th>
                                        <th>পত্রের জন্য নাম</th>
                                        <th>অফিসার গ্রুপ নং</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button class="btn btn-warning btn-xs" style="float: right !important;" type="button" id="changeLetterAcknowledgementRecipientTableBtn"><span class="fa fa-thumbs-up"></span> অনুলিপির ছক পরিবর্তন করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- .content -->
@endsection

@section('uncommonExJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{asset('bower/pikaday/pikaday.js')}}"></script>
    <script src="{{asset('bower/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('uncommonInJs')
    <script>
        $(function (){
            $("#addUnitAllotmentLetterForm").validate({
                ignore: ":hidden:not(#linked_allotments_count)",
                rules: {
                    linked_allotments_count:{
                        min:1,
                    }
                },
                messages: {
                    linked_allotments_count:{
                        min:"চিঠির সাথে নূন্যতম একটি বরাদ্দ যুক্ত থাকা আবশ্যক।",
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
                    else if(element.hasClass('hidden-field'))
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
            init_datepicker('sub_header_memo_date');
            init_datepicker('sub_header_memo_date_2');
            init_datepicker('signature_date');
            init_datepicker('signature_date_2');
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
            CKEDITOR.replace('allotment_table' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:200,
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
            CKEDITOR.replace('signature_info_left' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:150,
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
            CKEDITOR.replace('letter_acknowledgement' , {
                toolbarCanCollapse: true,
                toolbarStartupExpanded: false,
                enterMode: CKEDITOR.ENTER_BR,
                shiftEnterMode: CKEDITOR.ENTER_P,
                extraPlugins: 'divarea,tableresize',
                height:150,
                line_height:0.3
            });
        });

    </script>

{{--    Allotment Table--}}
    <script>
        var selectedAllotment=[];
        var selectedAllotmentDetail=[];
        $(window).on('load',function(){
            $('#unlinked_allotments').select2({
                placeholder: 'ইউনিটের নাম লিখে খুঁজুন',
                ajax: {
                    url: '{{route('unit-allotment-letter.get_unlinked_allotment_by_search_key')}}',
                    dataType: 'json',
                    type: 'POST',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term,
                            selected: selectedAllotment,
                            allowedLinkedOptions:[],
                            _token: csrfToken
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.unit_name+' | '+item.short_name1+' | '+item.short_name2+' | '+bn_Numbers(taka_format(item.amount.toString()))+'/- | '+item.unit_office_id+' | '+item.unit_ddo_id+' | '+bn_Numbers(item.unit_id.toString()),
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        $('#addAllotmentBtn').on('click',function (){
           $('#allotmentSubFormModal').modal('show');
        });

        $('#addAllotmentToTableBtn').on('click',function (){
            if($('#unlinked_allotments').val()!==null && $('#unlinked_allotments').val()!=='' && $('#unlinked_allotments').val()!==undefined) {
                addSelectedAllotment();
                updateModalAllotmentTable();
                $('#unlinked_allotments').val('').trigger('change');
            }
        });
        function addSelectedAllotment(){
            let allotmentInnerText=$('#unlinked_allotments')[0].selectedOptions[0].innerText;
            let allotmentInnerTextArr=allotmentInnerText.split(" | ");
            let allotmentId=$('#unlinked_allotments').val();
            let allotmentInnerArr={
                "id":allotmentId,
                "unit_id":en_Numbers(allotmentInnerTextArr[6]),
                "unit_name":allotmentInnerTextArr[0],
                "short_name1":allotmentInnerTextArr[1],
                "short_name2":allotmentInnerTextArr[2],
                "amount":allotmentInnerTextArr[3],
                "office_id":allotmentInnerTextArr[4],
                "ddo_id":allotmentInnerTextArr[5],
            };
            selectedAllotmentDetail.push(allotmentInnerArr);
            selectedAllotment.push(allotmentId);
            $('#linked_allotments').append('<input type="hidden" class="linked-allotment" id="linked_allotment_'+allotmentId+'" name="linked_allotments[]" value="'+allotmentId+'">');
            $('#linked_allotments_count').val($('#linked_allotments').children('.linked-allotment').length);
        }
        function updateModalAllotmentTable(){
            let htm='';
            for(let i=0; i<selectedAllotmentDetail.length; i++){
                htm+='<tr>';
                htm+='<td class="text-center">';
                htm+='<button class="btn btn-xs btn-danger" onclick="removeSelectedAllotment('+i+')"><span class="fa fa-trash"></span></button>';
                htm+='</td>';
                htm+='<td class="text-center">';
                htm+=bn_Numbers((i+1).toString());
                htm+='</td>';
                htm+='<td>';
                htm+=selectedAllotmentDetail[i].unit_name;
                htm+='</td>';
                htm+='<td>';
                htm+=selectedAllotmentDetail[i].short_name2;
                htm+='</td>';
                htm+='<td class="text-center">';
                htm+=selectedAllotmentDetail[i].office_id;
                htm+='</td>';
                htm+='<td class="text-center">';
                htm+=selectedAllotmentDetail[i].ddo_id;
                htm+='</td>';
                htm+='<td class="text-right">';
                htm+=selectedAllotmentDetail[i].amount;
                htm+='</td>';
                htm+='</tr>';
            }
            $('#modalAllotmentTable tbody').html(htm);
        }

        function removeSelectedAllotment(index){
            $('#linked_allotment_'+selectedAllotment[index]).remove();
            selectedAllotmentDetail.splice(index,1);
            selectedAllotment.splice(index,1);
            $('#linked_allotments_count').val($('#linked_allotments').children('.linked-allotment').length);
            updateModalAllotmentTable();
        }

        $('#changeAllotmentTableBtn').on('click',function (){
            //if(selectedAllotment.length>0) {
                let allotment_table_html=$('#allotment_table').html();
                allotment_table_html=allotment_table_html.trim();
                if(allotment_table_html.length>0) {
                    if (confirm("আপনি কি সত্যিই বরাদ্দ ছক পরিবর্তন করতে চান? এতে টেক্সট এডিটরে যদি আপনি ম্যানুয়ালি কিছু পরিবর্তন করে থাকেন তবে সেটি মুছে যাবে। সতর্কতার জন্য যদি ম্যানুয়ালি পরিবর্তন করে থাকেন তবে তা কপি করে অন্য কোথাও সংরক্ষণ করতে পারেন।")) {
                        changeAllotmentTable();
                        $('#allotmentSubFormModal').modal('hide');
                    }
                }
                else{
                    changeAllotmentTable();
                    $('#allotmentSubFormModal').modal('hide');
                }
           // }
        });
        function changeAllotmentTable(){
            let selectedUnits=[];
            for(let i=0; i<selectedAllotmentDetail.length; i++){
                selectedUnits.push(selectedAllotmentDetail[i].unit_id);
            }
            selectedUnits=arrayUnique(selectedUnits);
            save_letter_to(selectedUnits);
            let code_1st_arr=[];
            let htm='';
            if(selectedUnits.length>0) {
                htm = '';
                htm += '<div>';
                htm += '<table style="border-collapse: collapse; border: 1px solid black; width:100%;">';
                htm += '<thead><tr>';
                console.log(selectedUnits);
                if(selectedUnits.length>1) {
                    htm += '<th>ক্রমিক</th>';
                    htm += '<th>ইউনিটের নাম</th>';
                }
                htm += '<th>অফিস আইডি</th><th>ডিডিও আইডি</th><th>কোডের নাম</th><th>বরাদ্দকৃত অর্থ</th></tr></thead><tbody>';
                for (let i = 0; i < selectedUnits.length; i++) {
                    let groupObj = groupArrayOfObjects(selectedAllotmentDetail, "unit_id");
                    let group = groupObj[selectedUnits[i]];
                    if (group.length > 1) {
                        htm += '<tr>';
                        if(selectedUnits.length>1) {
                            htm += '<td rowspan="' + group.length + '" style="text-align: center;">' + bn_Numbers((i + 1).toString()) + '</td>';
                            htm += '<td rowspan="' + group.length + '">' + group[0].unit_name + '</td>';
                        }
                        htm += '<td rowspan="' + group.length + '" style="text-align: center;">' + group[0].office_id + '</td>';
                        htm += '<td rowspan="' + group.length + '" style="text-align: center;">' + group[0].ddo_id + '</td>';
                        code_1st_arr.push(group[0].short_name1);
                        htm += '<td style="text-align: center;">' + group[0].short_name2 + '</td>';
                        let amount = en_Numbers(group[0].amount.replace(/,/g,'').replace('/-',''));
                        htm += '<td> = ' + amountToTakaWithWordInBn(amount) + '</td>';
                        htm += '</tr>';
                        for (let k = 1; k < group.length; k++) {
                            htm += '<tr>';
                            code_1st_arr.push(group[k].short_name1);
                            htm += '<td style="text-align: center;">' + group[k].short_name2 + '</td>';
                            let amount = en_Numbers(group[k].amount.replace(/,/g,'').replace('/-',''));
                            htm += '<td> = ' + amountToTakaWithWordInBn(amount)  + '</td>';
                            htm += '</tr>';
                        }
                    } else {
                        htm += '<tr>';
                        if(selectedUnits.length>1) {
                            htm += '<td style="text-align: center;">' + bn_Numbers((i + 1).toString()) + '</td>';
                            htm += '<td>' + group[0].unit_name + '</td>';
                        }
                        htm += '<td style="text-align: center;">' + group[0].office_id + '</td>';
                        htm += '<td style="text-align: center;">' + group[0].ddo_id + '</td>';
                        code_1st_arr.push(group[0].short_name1);
                        htm += '<td style="text-align: center;">' + group[0].short_name2 + '</td>';
                        let amount = en_Numbers(group[0].amount.replace(/,/g,'').replace('/-',''));
                        htm += '<td> = ' + amountToTakaWithWordInBn(amount)  + '</td>';
                        htm += '</tr>';
                    }

                }
                htm += '</tbody></table></div>';
                code_1st_arr=arrayUnique(code_1st_arr);
                let code_1st_text = code_1st_arr.join(", ")
                htm='<div style="width:100%; text-align: center; font-weight: bold;"><u>‌❛'+code_1st_text+'❜</u></div>'+htm;
            }
            else{
                htm = '';
            }
            CKEDITOR.instances.allotment_table.setData(htm);
            $('#allotment_table').html(htm);
        }
    </script>

    {{--    Letter To--}}
    <script>
        function save_letter_to(selectedUnits){
            let recipient_data=[];
            let hiddenInputHtml='';
            if(selectedUnits.length>0){
                for(let i=0; i<selectedUnits.length; i++){
                    let recipient_datum={
                        "unit_id":selectedUnits[i],
                        "recipient_type":'unit_head',
                        "recipient_group_no":'1',
                    };
                    hiddenInputHtml+='<input type="hidden" name="letter_to_recipient['+i+'][unit_id]" value="'+selectedUnits[i]+'">';
                    hiddenInputHtml+='<input type="hidden" name="letter_to_recipient['+i+'][recipient_type]" value="unit_head">';
                    hiddenInputHtml+='<input type="hidden" name="letter_to_recipient['+i+'][recipient_group_no]" value="1">';
                    recipient_data.push(recipient_datum);
                }
            }
            $('#letter_to_hidden_input').html(hiddenInputHtml);
            generate_letter_recipient_html('letter_to',recipient_data);
        }
    </script>

{{--    Acknowledgement To--}}
    <script>
        var selectedLetterAcknowledgementRecipient=[];
        var selectedLetterAcknowledgementRecipientDetail=[];
        $(window).on('load',function(){
            $('#select_letter_acknowledgement_recipient').select2({
                placeholder: 'জ্ঞাতার্থের জন্য প্রাপকের নাম লিখে খুঁজুন',
                ajax: {
                    url: '{{route('unit-allotment-letter.get_letter_acknowledgement_recipient_by_search_key')}}',
                    dataType: 'json',
                    type: 'POST',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term,
                            selected: selectedLetterAcknowledgementRecipient,
                            _token: csrfToken
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.letter_name+' | '+item.unit_name,
                                    id: item.recipient_type+'_'+item.unit_id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        $('#letter_acknowledgement_modal_button').on('click',function () {
            show_acknowledgement_modal();
        });

        function show_acknowledgement_modal(){
            $('#acknowledgementFormModal').modal('show');
        }

        $('#addLetterAcknowledgementRecipientBtn').on('click',function (){
            if($('#select_letter_acknowledgement_recipient').val().length> 0 && $('#select_letter_acknowledgement_recipient').val()!==null && $('#select_letter_acknowledgement_recipient').val()!=='' && $('#select_letter_acknowledgement_recipient').val()!==undefined) {
                for(let i=0;i<$('#select_letter_acknowledgement_recipient').val().length;i++) {
                    addSelectedAcknowledgementRecipient(i);
                }
                updateModalAcknowledgementRecipientTable();
                $('#select_letter_acknowledgement_recipient').val('').trigger('change');
            }
        });

        function addSelectedAcknowledgementRecipient(i){
            let letter_acknowledgement_recipient=$('#select_letter_acknowledgement_recipient').val()[i];
            let selectedLetterAcknowledgementRecipientInnerText=$('#select_letter_acknowledgement_recipient')[0].selectedOptions[i].innerText;
            let selectedLetterAcknowledgementRecipientInnerTextArr=selectedLetterAcknowledgementRecipientInnerText.split(" | ");
            selectedLetterAcknowledgementRecipient.push(letter_acknowledgement_recipient);
            let selectedLetterAcknowledgementRecipientArr={
                "id":letter_acknowledgement_recipient,
                "letter_name":selectedLetterAcknowledgementRecipientInnerTextArr[0],
                "unit_name":selectedLetterAcknowledgementRecipientInnerTextArr[1],
                "recipient_group_no":0
            };
            selectedLetterAcknowledgementRecipientDetail.push(selectedLetterAcknowledgementRecipientArr);
        }

        function updateModalAcknowledgementRecipientTable(){
            let htm='';
            for(let i=0; i<selectedLetterAcknowledgementRecipientDetail.length; i++){
                htm+='<tr>';
                htm+='<td class="text-center">';
                htm+='<button type="button" class="btn btn-xs btn-danger" onclick="removeSelectedLetterAcknowledgementRecipient('+i+')"><span class="fa fa-trash"></span></button>';
                htm+='</td>';
                htm+='<td class="text-center">';
                htm+=bn_Numbers((i+1).toString());
                htm+='</td>';
                htm+='<td>';
                htm+=selectedLetterAcknowledgementRecipientDetail[i].unit_name;
                htm+='</td>';
                htm+='<td>';
                htm+=selectedLetterAcknowledgementRecipientDetail[i].letter_name;
                htm+='</td>';
                htm+='<td>';
                htm+='<input type="number" value="'+selectedLetterAcknowledgementRecipientDetail[i].recipient_group_no+'" class="form form-control letter_acknowledgement_recipient_group_no_'+selectedLetterAcknowledgementRecipientDetail[i].id+'">';
                htm+='</td>';
                htm+='</tr>';
            }
            $('#modalLetterAcknowledgementRecipientTable tbody').html(htm);
        }

        function removeSelectedLetterAcknowledgementRecipient(index){
            selectedLetterAcknowledgementRecipientDetail.splice(index,1);
            selectedLetterAcknowledgementRecipient.splice(index,1);
            updateModalAcknowledgementRecipientTable();
        }

        $('#changeLetterAcknowledgementRecipientTableBtn').on('click',function (){
            //if(selectedLetterAcknowledgementRecipient.length>0) {
                let letter_acknowledgement_recipient_table_html=$('#letter_acknowledgement').html();
                letter_acknowledgement_recipient_table_html=letter_acknowledgement_recipient_table_html.trim();
                if(letter_acknowledgement_recipient_table_html.length>0) {
                    if (confirm("আপনি কি সত্যিই অনুলিপির ছক পরিবর্তন করতে চান?")) {
                        changeLetterAcknowledgementRecipientTable();
                        $('#acknowledgementFormModal').modal('hide');
                    }
                }
                else{
                    changeLetterAcknowledgementRecipientTable();
                    $('#acknowledgementFormModal').modal('hide');
                }
            //}
        });

        function changeLetterAcknowledgementRecipientTable(){
            let recipient_data=[];
            let hiddenInputHtml='';
            if(selectedLetterAcknowledgementRecipientDetail.length>0){
                for(let i=0; i<selectedLetterAcknowledgementRecipientDetail.length; i++){
                    let unit_recipient_type=selectedLetterAcknowledgementRecipientDetail[i].id;
                    let unit_recipient_type_arr=unit_recipient_type.split("_");
                    let recipient_group_no=$('.letter_acknowledgement_recipient_group_no_'+unit_recipient_type).val();
                    recipient_group_no=parseInt(recipient_group_no);
                    let recipient_datum={
                        "unit_id":unit_recipient_type_arr[2],
                        "recipient_type":unit_recipient_type_arr[0]+'_'+unit_recipient_type_arr[1],
                        "recipient_group_no":recipient_group_no,
                    };
                    hiddenInputHtml+='<input type="hidden" name="letter_acknowledgement_recipient['+i+'][unit_id]" value="'+unit_recipient_type_arr[2]+'">';
                    hiddenInputHtml+='<input type="hidden" name="letter_acknowledgement_recipient['+i+'][recipient_type]" value="'+unit_recipient_type_arr[0]+'_'+unit_recipient_type_arr[1]+'">';
                    hiddenInputHtml+='<input type="hidden" name="letter_acknowledgement_recipient['+i+'][recipient_group_no]" value="'+recipient_group_no+'">';
                    recipient_data.push(recipient_datum);
                }
            }
            $('#letter_acknowledgement_hidden_input').html(hiddenInputHtml);
            generate_letter_recipient_html('letter_acknowledgement',recipient_data);
        }

        function generate_letter_recipient_html(field_type,recipient_data){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let route = '{{route('unit-allotment-letter.get_generate_letter_recipient_html')}}';
            $.ajax({
                url: route,
                data: {
                    field_type: field_type,
                    recipient_data:recipient_data,
                    _token: csrfToken
                },
                type: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        let htm= response.htm;
                        if(field_type==='letter_to') {
                            $('#letter_to_showing_box').html(htm);
                            $('#letter_to').html(htm);
                            CKEDITOR.instances.letter_to.setData(htm);
                        }
                        else{
                            $('#letter_acknowledgement_showing_box').html(htm);
                            $('#letter_acknowledgement').html(htm);
                            CKEDITOR.instances.letter_acknowledgement.setData(htm);
                        }
                    }
                }
            });
        }

        $('#letter_to_editor_button').on('click',function (){
            if($('#letter_to_editor_button').hasClass('off')){
                $('#letter_to_editor_button').removeClass('off btn-dark');
                $('#letter_to_editor_button').addClass('btn-warning');
                $('#letter_to_editor_button').html('সম্পন্ন করুন');
                $('#letter_to_showing_box').css('display','none');
                $('#letter_to_field').css('display','block');
            }
            else{
                let htm=CKEDITOR.instances.letter_to.getData();
                $('#letter_to_showing_box').html(htm);
                $('#letter_to_editor_button').removeClass('btn-warning');
                $('#letter_to_editor_button').addClass('btn-dark off');
                $('#letter_to_editor_button').html('বিতরণের তথ্য পরিবর্তন করুন');
                $('#letter_to_field').css('display','none');
                $('#letter_to_showing_box').css('display','block');
            }
        });

        $('#letter_acknowledgement_editor_button').on('click',function (){
            if($('#letter_acknowledgement_editor_button').hasClass('off')){
                $('#letter_acknowledgement_editor_button').removeClass('off btn-dark');
                $('#letter_acknowledgement_editor_button').addClass('btn-warning');
                $('#letter_acknowledgement_editor_button').html('সম্পন্ন করুন');
                $('#letter_acknowledgement_showing_box').css('display','none');
                $('#letter_acknowledgement_field').css('display','block');
            }
            else{
                let htm=CKEDITOR.instances.letter_acknowledgement.getData();
                $('#letter_acknowledgement_showing_box').html(htm);
                $('#letter_acknowledgement_editor_button').removeClass('btn-warning');
                $('#letter_acknowledgement_editor_button').addClass('btn-dark off');
                $('#letter_acknowledgement_editor_button').html('সর্বশেষ পরিবর্তন করুন');
                $('#letter_acknowledgement_field').css('display','none');
                $('#letter_acknowledgement_showing_box').css('display','block');
            }
        });
    </script>
@endsection
