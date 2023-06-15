@extends('admin.layouts.app')

@section('uncommonExCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower/pikaday/pikaday.css') }}">
@endsection

@section('uncommonInCss')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('commons/content_header.Edit Unit Expense')</h5>
                        <div class="card-tools">

                        </div>
                    </div>
                    <form id="editUnitAllotmentForm"
                        action="{{ route('unit-expense.update_expense', [$unit_expense->id]) }}" method="post"
                        class="">
                        <div class="card-body">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="form-control-label">কোড</label>
                                    <select class="form-control select2" name="code_id" id="code_id" style="width:100%;">
                                        @foreach ($codes as $opt)
                                            <option value="{{ $opt->id }}"
                                                @if ($unit_expense->code_id == $opt->id) selected @endif>{{ $opt->code ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8 col-sm-12">
                                    <input type="hidden" id="unit_id_selected_text" name="unit_id_selected_text"
                                        value="{{ $unit_expense->unit->name_bangla ?? '' }}">
                                    <input type="hidden" id="unit_id_selected_value" name="unit_id_selected_value"
                                        value="{{ $unit_expense->unit_id }}">
                                    <label class="form-control-label">ইউনিট <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="unit_id" id="unit_id">
                                        @if ($unit_expense->unit_id > 0)
                                            <option value="{{ $unit_expense->unit_id }}" selected>
                                                {{ $unit_expense->unit->name_bangla ?? '' }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label"> অর্থের পরিমাণ <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        placeholder="অর্থের পরিমাণ লিখুন"
                                        @if ($unit_expense->status == 1) readonly="readonly" @endif
                                        value="{{ $unit_expense->amount ?? 0 }}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">খরছের তারিখ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="transaction_date"
                                            name="transaction_date" readonly="readonly"
                                            value="{{ $unit_expense->transaction_date ?? '' }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button"
                                                onclick="clearThis('transaction_date')">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">খরছের স্মারক</label>
                                    <input type="text" name="surrender_memo" id="surrender_memo" class="form-control"
                                        placeholder="খরছের স্মারক লিখুন" value="{{ $unit_expense->surrender_memo ?? '' }}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">খরছের স্মারকের তারিখ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="surrender_memo_date"
                                            name="surrender_memo_date" readonly="readonly"
                                            placeholder="খরছের স্মারকের তারিখ লিখুন"
                                            value="{{ $unit_expense->surrender_memo_date ?? '' }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark btn-sm" style="height:29px;" type="button"
                                                onclick="clearThis('surrender_memo_date')">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="form-control-label"> বর্ণনা</label>
                                    <textarea name="description" id="description" class="form-control">{{ $unit_expense->description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" name="submitButton" value="submitForm"
                                        style="margin-left: 10px;"
                                        class="btn btn-sm btn-primary float-right">@lang('commons/buttons.Update')</button>
                                    <button type="reset" class="btn btn-sm btn-default"
                                        onclick="resetForm('editUnitAllotmentForm','ইউনিটের সমর্পন যুক্ত করণ ফরম','আপনি কি সত্যি ফরমটি রিসেট করতে চান?');return false;">@lang('commons/buttons.Reset')</button>
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
    <script src="{{ asset('bower/pikaday/pikaday.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@endsection

@section('uncommonInJs')
    <script>
        $(function() {
            init_datepicker('transaction_date');
            init_datepicker('surrender_memo_date');
            $("#editUnitAllotmentForm").validate({
                rules: {
                    unit_id: {
                        required: true,
                    },
                    amount: {
                        required: true,
                        min: 1,
                    },
                    transaction_date: {
                        required: true,
                    },
                },
                messages: {
                    unit_id: {
                        required: "ইউনিটের নাম সিলেক্ট করুন।",
                    },
                    amount: {
                        required: "সমর্পন অর্থের পরিমান ইনপুট দিন।",
                        min: "সমর্পন অর্থের পরিমান 1 বা এর বেশি হতে হবে।"
                    },
                    transaction_date: {
                        required: "খরছের তারিখ ইনপুট দিন।"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.parent().hasClass('input-group')) {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass('select2')) {
                        let sibling = element.siblings('span');
                        error.insertAfter(sibling);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(window).on('load', function() {
            $('#unit_id').select2({
                placeholder: 'ইউনিটের নাম লিখে খুঁজুন',
                ajax: {
                    url: '{{ route('unit.get_unit_by_search_key') }}',
                    dataType: 'json',
                    type: 'POST',
                    delay: 250,
                    data: function(data) {
                        return {
                            selected: $('#unit_id').val(),
                            searchTerm: data.term,
                            _token: csrfToken
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name_bangla,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            observe_unit_id();
        });

        $('#unit_id').on('change', function() {
            observe_unit_id();
        });

        function observe_unit_id() {
            if ($('#unit_id')[0].selectedOptions.length > 0) {
                let text = $('#unit_id')[0].selectedOptions[0].innerText;
                $('#unit_id_selected_text').val(text);
                $('#unit_id_selected_value').val($('#unit_id').val());
            } else {
                $('#unit_id_selected_text').val('');
                $('#unit_id_selected_value').val('');
            }
        }
    </script>
@endsection
