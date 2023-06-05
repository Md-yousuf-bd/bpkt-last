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
                        <h5 class="card-title">@lang('commons/content_header.Edit Recipient')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="editRecipientForm" action="{{route('recipient.update',[$recipient->id])}}" method="post" class="">
                        <div class="card-body">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> নাম (ইংরেজিতে) <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="ইংরেজিতে নাম লিখুন"  value="{{$recipient->name ?? ''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> নাম (বাংলা) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_bangla" id="name_bangla" class="form-control" placeholder="বাংলায় নাম লিখুন"  value="{{$recipient->name_bangla ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> নাম (পত্রে ব্যবহারের জন্য) <span class="text-danger">*</span></label>
                                    <input type="text" name="letter_name" id="letter_name" class="form-control" placeholder="পত্রে ব্যবহারের জন্য নাম লিখুন"  value="{{$recipient->letter_name ?? ''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">পদবী</label>
                                    <select class="form-control select2" name="designation_id" id="designation_id">
                                        @foreach($designations as $opt)
                                            <option value="{{$opt->id}}" @if($recipient->designation_id==$opt->id) selected @endif >{{$opt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> ইমেইল</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="ইমেইল লিখুন"  value="{{$recipient->email ?? ''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> মোবাইল নম্বর</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control" placeholder="মোবাইল নম্বর লিখুন"  value="{{$recipient->mobile ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> অগ্রাধিকার</label>
                                    <input type="number" name="priority" id="priority" class="form-control" placeholder="কোডের অগ্রাধিকার লিখুন" value="{{$recipient->priority ?? ''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">অবস্থা</label>
                                    <select class="form-control select2" name="status" id="status">
                                        <option value="1" @if($recipient->status==1) selected @endif >সক্রিয়</option>
                                        <option value="0" @if($recipient->status==0) selected @endif >নিষ্ক্রিয়</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label"> বর্ণনা</label>
                                    <textarea name="description" id="description" class="form-control">{{$recipient->description ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="submitButton" value="submitForm" style="margin-left: 10px;" class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Update')</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('editRecipientForm','প্রাপকের তথ্য পরিবর্তন ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
            $("#editRecipientForm").validate({
                rules: {
                    name: {
                        required:true,
                    },
                    name_bangla: {
                        required:true,
                    },
                    letter_name: {
                        required:true,
                    },
                    email:{
                        email:true
                    },
                    mobile:{
                        number: true,
                        maxlength:11
                    }
                },
                messages: {
                    name: {
                        required:"ইংরেজিতে নাম লিখুন",
                    },
                    name_bangla: {
                        required:"বাংলায় নাম লিখুন",
                    },
                    letter_name: {
                        required:"পত্রে ব্যবহারের জন্য নাম লিখুন",
                    },
                    email:{
                        email:"ইমেইল টি সঠিক ফরম্যাটে লিখুন"
                    },
                    mobile:{
                        number: "শুধু ইংরেজি ডিজিটে মোবাইল নাম্বার লিখুন",
                        maxlength:"১১ ডিজিটের মধ্যেই মোবাইল নাম্বার লিখুন"
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
