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
                        <h5 class="card-title">@lang('commons/content_header.Add Unit')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="addUnitForm" action="{{route('unit.store')}}" method="post" class="">
                        <div class="card-body">
                            {{ csrf_field() }}
                            @php
                                $old_data=Session::get('_old_input');
                            @endphp
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> নাম (ইংরেজিতে) <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="ইংরেজিতে নাম লিখুন"  value="@if($old_data!=null){{$old_data['name']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> নাম (বাংলা) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_bangla" id="name_bangla" class="form-control" placeholder="বাংলায় নাম লিখুন"  value="@if($old_data!=null){{$old_data['name_bangla']}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">উর্ধ্বস্থ রেঞ্জ/মেট্রো</label>
                                    <select class="form-control select2" name="parent_unit_id" id="parent_unit_id">
                                        @foreach($range_metros as $opt)
                                            <option value="{{$opt->id}}" @if($old_data!=null && $old_data['parent_unit_id']==$opt->id) selected @endif >{{$opt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> প্রাতিষ্ঠানিক কোড</label>
                                    <input type="text" name="institution_code" id="institution_code" class="form-control" placeholder="প্রাতিষ্ঠানিক কোড লিখুন"  value="@if($old_data!=null){{$old_data['institution_code']}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> অফিস আইডি</label>
                                    <input type="text" name="office_id" id="office_id" class="form-control" placeholder="অফিস আইডি লিখুন"  value="@if($old_data!=null){{$old_data['office_id']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> ডিডিও আইডি</label>
                                    <input type="text" name="ddo_id" id="ddo_id" class="form-control" placeholder="ডিডিও আইডি লিখুন"  value="@if($old_data!=null){{$old_data['ddo_id']}}@endif">
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-6 col-sm-12">--}}
{{--                                    <input type="hidden" id="unit_head_id_selected_text" name="unit_head_id_selected_text" value="@if($old_data!=null) {{$old_data['unit_head_id_selected_text']}} @endif">--}}
{{--                                    <input type="hidden" id="unit_head_id_selected_value" name="unit_head_id_selected_value" value="@if($old_data!=null) {{$old_data['unit_head_id_selected_value']}} @endif">--}}
{{--                                    <label class="form-control-label">ইউনিট প্রধান <span class="text-danger">*</span></label>--}}
{{--                                    <select class="form-control select2" name="unit_head_id" id="unit_head_id">--}}
{{--                                        @if($old_data!=null && $old_data['unit_head_id_selected_value']>0)--}}
{{--                                            <option value="{{$old_data['unit_head_id_selected_value']}}" selected >{{$old_data['unit_head_id_selected_text']}}</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-md-6 col-sm-12">--}}
{{--                                    <input type="hidden" id="for_attention_id_selected_text" name="for_attention_id_selected_text" value="@if($old_data!=null) {{$old_data['for_attention_id_selected_text']}} @endif">--}}
{{--                                    <input type="hidden" id="for_attention_id_selected_value" name="for_attention_id_selected_value" value="@if($old_data!=null) {{$old_data['for_attention_id_selected_value']}} @endif">--}}
{{--                                    <label class="form-control-label">দৃঃ আঃ এর জন্য অফিসার</label>--}}
{{--                                    <select class="form-control select2" name="for_attention_id" id="for_attention_id">--}}
{{--                                        @if($old_data!=null && $old_data['for_attention_id_selected_value']>0)--}}
{{--                                            <option value="{{$old_data['for_attention_id_selected_value']}}" selected >{{$old_data['for_attention_id_selected_text']}}</option>--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> ইউনিট প্রধানের নাম (ইংরেজিতে) <span class="text-danger">*</span></label>
                                    <input type="text" name="unit_head_name" id="unit_head_name" class="form-control" placeholder="ইউনিট প্রধানের ইংরেজিতে নাম লিখুন"  value="@if($old_data!=null){{$old_data['unit_head_name']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">  ইউনিট প্রধানের নাম (পত্রে ব্যবহারের জন্য) <span class="text-danger">*</span></label>
                                    <input type="text" name="unit_head_letter_name" id="unit_head_letter_name" class="form-control" placeholder="ইউনিট প্রধানের পত্রে ব্যবহারযোগ্য নাম লিখুন"  value="@if($old_data!=null){{$old_data['unit_head_letter_name']}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> ইউনিট প্রধানের ইমেইল</label>
                                    <input type="text" name="unit_head_email" id="unit_head_email" class="form-control" placeholder="ইউনিট প্রধানের ইমেইল লিখুন"  value="@if($old_data!=null){{$old_data['unit_head_email']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> ইউনিট প্রধানের মোবাইল নং</label>
                                    <input type="text" name="unit_head_mobile" id="unit_head_mobile" class="form-control" placeholder="ইউনিট প্রধানের মোবাইল নং লিখুন"  value="@if($old_data!=null){{$old_data['unit_head_mobile']}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">ইউনিট প্রধানের পদবী</label>
                                    <select class="form-control select2" name="unit_head_designation_id" id="unit_head_designation_id">
                                        @foreach($designations as $opt)
                                            <option value="{{$opt->id}}" @if($old_data!=null && $old_data['unit_head_designation_id']==$opt->id) selected @endif >{{$opt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> দৃঃ আঃ এর জন্য অফিসারের নাম (ইংরেজিতে)</label>
                                    <input type="text" name="for_attention_name" id="for_attention_name" class="form-control" placeholder="দৃঃ আঃ এর জন্য অফিসারের ইংরেজিতে নাম লিখুন"  value="@if($old_data!=null){{$old_data['for_attention_name']}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">  দৃঃ আঃ এর জন্য অফিসারের নাম (পত্রে ব্যবহারের জন্য)</label>
                                    <input type="text" name="for_attention_letter_name" id="for_attention_letter_name" class="form-control" placeholder="দৃঃ আঃ এর জন্য অফিসারের পত্রে ব্যবহারযোগ্য নাম লিখুন"  value="@if($old_data!=null){{$old_data['for_attention_letter_name']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> দৃঃ আঃ এর জন্য অফিসারের ইমেইল</label>
                                    <input type="text" name="for_attention_email" id="for_attention_email" class="form-control" placeholder="দৃঃ আঃ এর জন্য অফিসারের ইমেইল লিখুন"  value="@if($old_data!=null){{$old_data['for_attention_email']}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> দৃঃ আঃ এর জন্য অফিসারের মোবাইল নং</label>
                                    <input type="text" name="for_attention_mobile" id="for_attention_mobile" class="form-control" placeholder="দৃঃ আঃ এর জন্য অফিসারের মোবাইল নং লিখুন"  value="@if($old_data!=null){{$old_data['for_attention_mobile']}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">দৃঃ আঃ এর জন্য অফিসারের পদবী</label>
                                    <select class="form-control select2" name="for_attention_designation_id" id="for_attention_designation_id">
                                        <option value="">বাছাই করুন</option>
                                        @foreach($designations as $opt)
                                            <option value="{{$opt->id}}" @if($old_data!=null && $old_data['for_attention_designation_id']==$opt->id) selected @endif >{{$opt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> অগ্রাধিকার</label>
                                    <input type="number" name="priority" id="priority" class="form-control" placeholder="কোডের অগ্রাধিকার লিখুন" value="@if($old_data!=null){{$old_data['priority']}}@else{{0}}@endif">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">অবস্থা</label>
                                    <select class="form-control select2" name="status" id="status">
                                        <option value="1" @if($old_data!=null && $old_data['status']==1) selected @endif >সক্রিয়</option>
                                        <option value="0" @if($old_data!=null && $old_data['status']==0) selected @endif >নিষ্ক্রিয়</option>
                                    </select>
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
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('addUnitForm','প্রাপকের তথ্য যুক্ত করণ ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
            $("#addUnitForm").validate({
                rules: {
                    name: {
                        required:true,
                    },
                    name_bangla: {
                        required:true,
                    },
                    unit_head_name: {
                        required:true,
                    },
                    unit_head_letter_name: {
                        required:true,
                    },
                    unit_head_email:{
                        email:true
                    },
                    unit_head_mobile:{
                        number: true,
                        maxlength:11
                    },
                    for_attention_email:{
                        email:true
                    },
                    for_attention_mobile:{
                        number: true,
                        maxlength:11
                    },
                    // unit_head_id: {
                    //     required:true,
                    // },
                },
                messages: {
                    name: {
                        required:"ইংরেজিতে নাম লিখুন",
                    },
                    name_bangla: {
                        required:"বাংলায় নাম লিখুন",
                    },
                    unit_head_name: {
                        required:"ইউনিট প্রধানের নাম লিখুন",
                    },
                    unit_head_letter_name: {
                        required:"ইউনিট প্রধানের পত্রে ব্যবহারযোগ্য নাম লিখুন",
                    },
                    unit_head_email:{
                        email:"ইমেইল টি সঠিক ফরম্যাটে লিখুন"
                    },
                    unit_head_mobile:{
                        number: "শুধু ইংরেজি ডিজিটে মোবাইল নাম্বার লিখুন",
                        maxlength:"১১ ডিজিটের মধ্যেই মোবাইল নাম্বার লিখুন"
                    },
                    for_attention_email:{
                        email:"ইমেইল টি সঠিক ফরম্যাটে লিখুন"
                    },
                    for_attention_mobile:{
                        number: "শুধু ইংরেজি ডিজিটে মোবাইল নাম্বার লিখুন",
                        maxlength:"১১ ডিজিটের মধ্যেই মোবাইল নাম্বার লিখুন"
                    }
                    // unit_head_id: {
                    //     required:"ইউনিট প্রধান বাছাই করুন",
                    // },
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

        {{--$(window).on('load',function (){--}}
        {{--    $('#unit_head_id').select2({--}}
        {{--        placeholder: 'ইউনিট প্রধানের নাম লিখে খুঁজুন',--}}
        {{--        ajax: {--}}
        {{--            url: '{{route('recipient.get_recipient_by_search_key')}}',--}}
        {{--            dataType: 'json',--}}
        {{--            type: 'POST',--}}
        {{--            delay: 250,--}}
        {{--            data: function (data) {--}}
        {{--                let unit_head_id= $('#unit_head_id').val();--}}
        {{--                let unit_head_arr=[];--}}
        {{--                if(unit_head_id>0){--}}
        {{--                    unit_head_arr.push(unit_head_id);--}}
        {{--                }--}}
        {{--                return {--}}
        {{--                    selected: unit_head_arr,--}}
        {{--                    searchTerm: data.term,--}}
        {{--                    _token: csrfToken--}}
        {{--                };--}}
        {{--            },--}}
        {{--            processResults: function (data) {--}}
        {{--                return {--}}
        {{--                    results: $.map(data, function (item) {--}}
        {{--                        return {--}}
        {{--                            text: item.letter_name,--}}
        {{--                            id: item.id--}}
        {{--                        }--}}
        {{--                    })--}}
        {{--                };--}}
        {{--            },--}}
        {{--            cache: true--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $('#for_attention_id').select2({--}}
        {{--        placeholder: 'দৃঃ আঃ জন্য অফিসারের নাম লিখে খুঁজুন',--}}
        {{--        allowClear: true,--}}
        {{--        ajax: {--}}
        {{--            url: '{{route('recipient.get_recipient_by_search_key')}}',--}}
        {{--            dataType: 'json',--}}
        {{--            type: 'POST',--}}
        {{--            delay: 250,--}}
        {{--            data: function (data) {--}}
        {{--                let for_attention_id= $('#for_attention_id').val();--}}
        {{--                let for_attention_arr=[];--}}
        {{--                if(for_attention_id>0){--}}
        {{--                    for_attention_arr.push(for_attention_id);--}}
        {{--                }--}}
        {{--                return {--}}
        {{--                    selected: for_attention_arr,--}}
        {{--                    searchTerm: data.term,--}}
        {{--                    _token: csrfToken--}}
        {{--                };--}}
        {{--            },--}}
        {{--            processResults: function (data) {--}}
        {{--                return {--}}
        {{--                    results: $.map(data, function (item) {--}}
        {{--                        return {--}}
        {{--                            text: item.letter_name,--}}
        {{--                            id: item.id--}}
        {{--                        }--}}
        {{--                    })--}}
        {{--                };--}}
        {{--            },--}}
        {{--            cache: true--}}
        {{--        }--}}
        {{--    });--}}

        {{--    observe_unit_head_id();--}}
        {{--    observe_for_attention_id();--}}
        {{--});--}}

        {{--$('#unit_head_id').on('change',function(){--}}
        {{--    observe_unit_head_id();--}}
        {{--});--}}
        {{--$('#for_attention_id').on('change',function(){--}}
        {{--    observe_for_attention_id();--}}
        {{--});--}}

        {{--function observe_unit_head_id(){--}}
        {{--    if($('#unit_head_id')[0].selectedOptions.length>0){--}}
        {{--        let text= $('#unit_head_id')[0].selectedOptions[0].innerText;--}}
        {{--        $('#unit_head_id_selected_text').val(text);--}}
        {{--        $('#unit_head_id_selected_value').val($('#unit_head_id').val());--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        $('#unit_head_id_selected_text').val('');--}}
        {{--        $('#unit_head_id_selected_value').val('');--}}
        {{--    }--}}
        {{--}--}}

        {{--function observe_for_attention_id(){--}}
        {{--    if($('#for_attention_id')[0].selectedOptions.length>0){--}}
        {{--        let text= $('#for_attention_id')[0].selectedOptions[0].innerText;--}}
        {{--        $('#for_attention_id_selected_text').val(text);--}}
        {{--        $('#for_attention_id_selected_value').val($('#for_attention_id').val());--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        $('#for_attention_id_selected_text').val('');--}}
        {{--        $('#for_attention_id_selected_value').val('');--}}
        {{--    }--}}
        {{--}--}}

    </script>
@endsection
