@extends('admin.layouts.app')

@section('uncommonExCss')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Lookup</h5>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form id="addLookupForm" action="{{route('settings.lookup.store')}}" method="post" class="">
                        <div class="card-body card-block">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input type="text" id="name" name="name" placeholder="Enter Lookup Name" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Priority</label>
                                    <input type="number" id="priority" name="priority" placeholder="Enter Lookup Priority" class="form-control" value="0">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Parent</label>
                                    <select class="form-control select2" name="parent_id" id="parent_id">
                                        <option value="0"> None </option>
                                        @foreach($parents as $parent)
                                            <option value="{{$parent->id}}"> {{$parent->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea name="description" id="description" style="width: 100%;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Status</label>
                                    <select class="form-control select2" name="status" id="status">
                                        <option value="1"> Active </option>
                                        <option value="0"> Inactive </option>
                                    </select>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                                    <button type="reset" class="btn btn-sm btn-default" onclick="resetForm('addLookupForm','Add Lookup Form','Do you really want to reset this form?');return false;">Reset</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('uncommonExJs')

@endsection

@section('uncommonInJs')
    <script>
        (function() {
            "use strict";
        })(jQuery);
    </script>
@endsection
