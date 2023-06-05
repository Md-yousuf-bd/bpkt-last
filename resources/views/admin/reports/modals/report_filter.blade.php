
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="filterLabel"> রিপোর্ট ফিল্টার করুন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card card-body float-right" style="width:90%; overflow-y:auto; max-height: 400px; box-shadow: 0 0 2px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.2) !important;">
                            <div class="form">
                                <div class="row">
                                    <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <label class="form-control-label">কোড</label>
                                        <select class="form-control select2" id="code_id_filter" style="width:100%;" multiple="multiple">
                                            @foreach($codes as $opt)
                                                <option value="{{$opt->id}}">{{$opt->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">ইউনিট</label>
                                        <select class="form-control select2" id="unit_id_filter" style="width:100%;" multiple="multiple">

                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">অর্থবছর</label>
                                        <select class="form-control select2" id="fiscal_year_filter" style="width:100%;" multiple="multiple">
                                            {!!  \App\Http\PigeonHelpers\otherHelper::get_fiscal_year_options(array(\App\Http\PigeonHelpers\otherHelper::get_fiscal_year_by_date(date('Y-m-d'))))!!}
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">স্মারকের তারিখ হতে</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date_from_filter" style="width:100%; height:37px;" readonly="readonly" value="">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-dark btn-sm" style="height:37px;" type="button" onclick="clearThis('date_from_filter')">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">স্মারকের তারিখ পর্যন্ত</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date_to_filter" style="width:100%; height:37px;" readonly="readonly" value="">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-dark btn-sm" style="height:37px;" type="button" onclick="clearThis('date_to_filter')">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                    @if($page_name=="Top Sheet")
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="form-control-label">স্মারক</label>
                                            <select class="form-control select2" id="memo_filter" style="width:100%;" multiple="multiple">
                                            </select>
                                        </div>
                                    @endif
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
                    let selected=$('#unit_id_filter').val();
                    return {
                        selected: (selected.length>0)?selected:[],
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
        @if($page_name=="Top Sheet")
        $('#memo_filter').select2({
            placeholder: 'স্মারক লিখে খুঁজুন',
            ajax: {
                url: '{{route('unit-allotment-letter.get_memo_by_search_key')}}',
                dataType: 'json',
                type: 'POST',
                delay: 250,
                data: function (data) {
                    let selected=$('#memo_filter').val();
                    return {
                        selected: (selected.length>0)?selected:[],
                        searchTerm: data.term,
                        date_from_filter: $('#date_from_filter').val(),
                        date_to_filter: $('#date_to_filter').val(),
                        _token: csrfToken
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.sub_header_memo_first_part+item.sub_header_memo_second_part,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        @endif
    });



</script>
