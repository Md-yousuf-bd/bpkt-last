
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="filterLabel">প্রেরিত মেইল খুঁজুন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card card-body float-right" style="width:90%; overflow-y:auto; max-height: 400px; box-shadow: 0 0 2px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.2) !important;">
                            <div class="form">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label class="form-control-label">প্রেরণের অবস্থা</label>
                                        <select class="form-control select2" id="status_filter" style="width:100%;" multiple>
                                            <option value="1" >সফল</option>
                                            <option value="0" >অসফল</option>
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


</script>
