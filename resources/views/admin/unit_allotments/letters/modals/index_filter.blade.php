
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="filterLabel">ইউনিটে বরাদ্দের চিঠি খুঁজুন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card card-body float-right" style="width:90%; overflow-y:auto; max-height: 400px; box-shadow: 0 0 2px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.2) !important;">
                            <div class="form">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label class="form-control-label">কোড</label>
                                        <select class="form-control select2" id="code_id_filter" style="width:100%;" multiple="multiple">
                                            @foreach($codes as $opt)
                                                <option value="{{$opt->id}}" @if(isset($filter_selected_data) && isset($filter_selected_data['code_id_filter']) && $filter_selected_data['code_id_filter'] == $opt->id) selected @endif>{{$opt->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label class="form-control-label">ইউনিট</label>
                                        <select class="form-control select2" id="unit_id_filter" style="width:100%;" multiple="multiple">
                                            @if(isset($filter_selected_data)&& isset($filter_selected_data['unit_id_filter']))
                                                <option value="{{$filter_selected_data['unit_id_filter']->id}}" selected>{{$filter_selected_data['unit_id_filter']->code}}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">সাক্ষরের অবস্থা</label>
                                        <select class="form-control select2" id="sign_status_filter" style="width:100%;">
                                            <option value="">বাছাই করুন</option>
                                            <option value="not singed" @if(isset($filter_selected_data) && isset($filter_selected_data['sign_status_filter']) && $filter_selected_data['sign_status_filter']=="not singed") selected @endif >উভয় স্বাক্ষর ছাড়া</option>
                                            <option value="both singed" @if(isset($filter_selected_data) && isset($filter_selected_data['sign_status_filter']) && $filter_selected_data['sign_status_filter']=="both singed") selected @endif >উভয় স্বাক্ষর সহ</option>
                                            <option value="only 1st singed" @if(isset($filter_selected_data) && isset($filter_selected_data['sign_status_filter']) && $filter_selected_data['sign_status_filter']=="only 1st singed") selected @endif >শুধু উপরের স্বাক্ষর সহ</option>
                                            <option value="only 2nd singed" @if(isset($filter_selected_data) && isset($filter_selected_data['sign_status_filter']) && $filter_selected_data['sign_status_filter']=="only 2nd singed") selected @endif >শুধু নিচের স্বাক্ষর সহ</option>
                                            <option value="any not signed" @if(isset($filter_selected_data) && isset($filter_selected_data['sign_status_filter']) && $filter_selected_data['sign_status_filter']=="any not signed") selected @endif >যেকোন স্বাক্ষর ছাড়া</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">স্মারকের অবস্থা</label>
                                        <select class="form-control select2" id="memo_status_filter" style="width:100%;">
                                            <option value="">বাছাই করুন</option>
                                            <option value="no memo" @if(isset($filter_selected_data) && isset($filter_selected_data['memo_status_filter']) && $filter_selected_data['memo_status_filter']=="no memo") selected @endif >উভয় স্মারক ছাড়া</option>
                                            <option value="both memo" @if(isset($filter_selected_data) && isset($filter_selected_data['memo_status_filter']) && $filter_selected_data['memo_status_filter']=="both memo") selected @endif >উভয় স্মারক সহ</option>
                                            <option value="only 1st memo" @if(isset($filter_selected_data) && isset($filter_selected_data['memo_status_filter']) && $filter_selected_data['memo_status_filter']=="only 1st memo") selected @endif >শুধু উপরের স্মারক সহ</option>
                                            <option value="only 2nd memo" @if(isset($filter_selected_data) && isset($filter_selected_data['memo_status_filter']) && $filter_selected_data['memo_status_filter']=="only 2nd memo") selected @endif >শুধু নিচের স্মারক সহ</option>
                                            <option value="any no memo" @if(isset($filter_selected_data) && isset($filter_selected_data['memo_status_filter']) && $filter_selected_data['memo_status_filter']=="any no memo") selected @endif >যেকোন স্মারক ছাড়া</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">অর্থবছর</label>
                                        <select class="form-control select2" id="fiscal_year_filter" style="width:100%;" multiple="multiple">
                                            @if(isset($filter_selected_data) && isset($filter_selected_data['fiscal_year_filter']) && count($filter_selected_data['fiscal_year_filter'])>0)
                                                {!!  \App\Http\PigeonHelpers\otherHelper::get_fiscal_year_options($filter_selected_data['fiscal_year_filter'])!!}
                                            @else
                                                {!!  \App\Http\PigeonHelpers\otherHelper::get_fiscal_year_options()!!}
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">তারিখের ধরণ</label>
                                        <select class="form-control select2" id="date_type_filter" style="width:100%;">
                                            <option value="">বাছাই করুন</option>
                                            <option value="sub_header_memo_date" @if(isset($filter_selected_data) && isset($filter_selected_data['date_type_filter']) && $filter_selected_data['date_type_filter']=="sub_header_memo_date") selected @endif >উপরের স্মারকের তারিখ</option>
                                            <option value="sub_header_memo_date_2" @if(isset($filter_selected_data) && isset($filter_selected_data['date_type_filter']) && $filter_selected_data['date_type_filter']=="sub_header_memo_date_2") selected @endif >নিচের স্মারকের তারিখ</option>
                                            <option value="signature_date" @if(isset($filter_selected_data) && isset($filter_selected_data['date_type_filter']) && $filter_selected_data['date_type_filter']=="signature_date") selected @endif >উপরের সাক্ষরের তারিখ</option>
                                            <option value="signature_date_2" @if(isset($filter_selected_data) && isset($filter_selected_data['date_type_filter']) && $filter_selected_data['date_type_filter']=="signature_date_2") selected @endif >নিচের সাক্ষরের তারিখ</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">তারিখ হতে</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date_from_filter" style="width:100%; height:37px;" readonly="readonly" value="@if(isset($filter_selected_data) && isset($filter_selected_data['date_from_filter'])) {{$filter_selected_data['date_from_filter']}} @endif">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-dark btn-sm" style="height:37px;" type="button" onclick="clearThis('date_from_filter')">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">তারিখ পর্যন্ত</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date_to_filter" style="width:100%; height:37px;" readonly="readonly" value="@if(isset($filter_selected_data) && isset($filter_selected_data['date_to_filter'])) {{$filter_selected_data['date_to_filter']}} @endif">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-dark btn-sm" style="height:37px;" type="button" onclick="clearThis('date_to_filter')">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                        <button class="btn btn-default btn-xs" style="float: left !important;" type="reset" id="filter_reset" >রিসেট</button>
                        <button class="btn btn-success btn-xs" style="float: right !important;" data-dismiss="modal" type="button" id="filter_submit"><span class="fa fa-search"></span> খুঁজুন</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function (){
        init_datepicker('date_from_filter');
        init_datepicker('date_to_filter');
    });
    $(window).on('load',function (){
        $('#unit_id_filter').select2({
            placeholder: 'ইউনিটের নাম লিখে খুঁজুন',
            ajax: {
                url: '{{route('unit.get_unit_by_search_key')}}',
                dataType: 'json',
                type: 'POST',
                delay: 250,
                data: function (data) {
                    return {
                        selected: $('#unit_id_filter').val(),
                        searchTerm: data.term,
                        _token: csrfToken
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
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
    });


</script>
