
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="filterLabel">ইউনিট খুঁজুন</h5>
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
                                        <label class="form-control-label">উর্ধ্বস্ত রেঞ্জ/মেট্রো</label>
                                        <select class="form-control select2" id="parent_unit_id_filter" style="width:100%;" multiple="multiple">
                                            @foreach($range_metros as $opt)
                                                <option value="{{$opt->id}}">{{$opt->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label class="form-control-label">অবস্থা</label>
                                        <select class="form-control select2" id="status_filter" style="width:100%;" multiple="multiple">
                                            <option value="1">সক্রিয়</option>
                                            <option value="0">নিষ্ক্রিয়</option>
                                        </select>
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

