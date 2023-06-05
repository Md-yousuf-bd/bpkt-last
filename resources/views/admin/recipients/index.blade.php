@extends('admin.layouts.app')

@section('uncommonExCss')
    @include('admin.layouts.commons.dataTableCss')
@endsection

@section('uncommonInCss')
    <style>

        h6{
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">প্রাপকের তালিকা</h5>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light text-default" role="button" data-toggle="modal" data-target="#filter"><span class="fa fa-filter"></span> ফিল্টার &nbsp; &nbsp;<span class="badge badge-dark" id="filter_count">0</span></button>
                            @if(auth()->user()->can('create-recipient'))
                                <a href="{{route('recipient.create')}}" class="btn btn-sm btn-default pull-right"><span class="fa fa-plus-circle"></span> প্রাপকের তথ্য যুক্ত করুন</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive" style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="recipientTable" class="table table-bordered table-hover table-striped" style="font-size: 14px; width:100%;">
                                <thead>
                                <tr>
                                    <th data-sl="0" >ক্রঃনং</th>
                                    <th data-sl="1"  style="min-width:240px;">Action</th>
                                    <th data-sl="2" >নাম (ইংরেজিতে)</th>
                                    <th data-sl="3" >নাম (বাংলায়)</th>
                                    <th data-sl="4" >নাম (পত্রে ব্যাবহার জন্য)</th>
                                    <th data-sl="5" >পদবী</th>
                                    <th data-sl="6" >ইমেইল</th>
                                    <th data-sl="7" >মোবাইল নং</th>
                                    <th data-sl="8" >প্রাপকের অবস্থা</th>
                                    <th data-sl="9" >অগ্রাধিকার</th>
                                    <th data-sl="10"  style="min-width: 200px;" >বর্ণনা</th>
                                    <th data-sl="11" >সর্বশেষ সংস্কারক</th>
                                    <th data-sl="12"  style="min-width: 200px;">সর্বশেষ সংস্করণ</th>
                                    <th data-sl="13" >তথ্য যুক্ত করেছেন</th>
                                    <th data-sl="14"  style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .content -->

@endsection

@section('uncommonExJs')
    @include('admin.layouts.commons.dataTableJs')
@endsection

@section('uncommonInJs')
    <script>
        var recipientTableColumnNames=[];
        (function() {
            "use strict";

            let recipientTableColumnTh=document.querySelectorAll('#recipientTable thead tr th');
            for(let i=0; i<recipientTableColumnTh.length; i++){recipientTableColumnNames[i]=recipientTableColumnTh[i].innerText}
            $('#recipientTable thead th').each(function () {
                var title = $(this).text();
                let except=['ক্রঃনং','Action','প্রাপকের অবস্থা','সর্বশেষ সংস্করণ','তথ্য যুক্ত হয়েছে'];
                if(!except.includes(title)) {
                    $(this).html( '<input type="text" class="col-search-input no-print form-control" style="width:100%; min-width: 80px;"/><br>'+ title);
                }
                else{
                    $(this).html( '<div></div><br><br>'+ title);
                }
            });

        })(jQuery);

        $('th').on("click", function (event) {
            if($(event.target).is("input"))
                event.stopImmediatePropagation();
        });

        var customLen=0;
        $(window).on('load',function(){
            set_custom_length();
        });

        var csrfToken= $('meta[name="csrf-token"]').attr('content');
        var recipientTable= $('#recipientTable').DataTable({
            lengthMenu: [[100, 500, 1000, 2500, -1], [100, 500, 1000, 2500, 'All']],
            processing:true,
            colReorder: true,
            serverSide:true,
            scrollX:true,
            responsive: true,
            scrollCollapse: true,
            dom: "Bflrtip",
            scrollY:($(window).height()*0.7)+"px",
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            },
            ajax: {
                url:'{!! route('recipient.get_index') !!}',
                dataType: "json",
                contentType: "application/json",
                type: "POST",
                headers : {
                    'Accept': 'application/json',
                },
                data: function ( d ) {
                    d['_token']=csrfToken;
                    d['designation_id_filter']=$('#designation_id_filter').val();
                    d['status_filter']=$('#status_filter').val();
                    return JSON.stringify( d );
                },
                complete: function(response) {
                    let result=response.responseJSON;
                    setCustomStatus();
                },
                error: function (xhr, error, thrown) {
                    alert("An error occurred while attempting to retrieve data via ajax.\n"+thrown );
                }
            },
            createdRow: function( row, data, dataIndex ) {
            },
            columns:[
                {data:'DT_RowIndex',name:'id'},
                {data:'action',name:'action',searchable: false, orderable: false},
                {data:'name',name:'name',class:'text-left'},
                {data:'name_bangla',name:'name_bangla',class:'text-left'},
                {data:'letter_name',name:'letter_name',class:'text-left'},
                {data:'designation_name',name:'designation.name',class:'text-left'},
                {data:'email',name:'email',class:'text-left'},
                {data:'mobile',name:'mobile',class:'text-left'},
                {data:'status_modified',name:'status',class:'text-center'},
                {data:'priority',name:'priority',class:'text-center'},
                {data:'description_modified',name:'description',class:'text-justify'},
                {data:'updater_user',name:'updater_user.name',class:'text-center'},
                {data:'DT_RowData.data-updated_at',name:'updated_at',class:'text-center'},
                {data:'creator_user',name:'creator_user.name',class:'text-center'},
                {data:'DT_RowData.data-created_at',name:'created_at',class:'text-center'},
            ],
            buttons: [
                {
                    extend: 'print',
                    title:'{{ config('app.name', 'Laravel') }}: প্রাপকের তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title:'{{ config('app.name', 'Laravel') }}: প্রাপকের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title:'{{ config('app.name', 'Laravel') }}: প্রাপকের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function ( e, dt, node, config ) {
                        showUserTablesCombinationModal(recipientTableColumnNames,'প্রাপকের তালিকা','recipientTable');
                    }
                },
                {
                    text: 'Reset',
                    action: function ( e, dt, node, config ) {
                        if(confirm('আপনি কি সত্যিই সম্পূর্ণ তালিকা রিসেট করতে চান?')) {
                            location.reload();
                        }
                    }
                }

            ]
        });


        recipientTable.columns().every(function (k) {

            var table = this;
            $('input', this.header()).on('keyup change', function () {
                let columns= recipientTable.context[0].aoColumns;
                let sl=[];
                for(let i=0; i<columns.length; i++){
                    sl[i]=columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value==='') {
                    recipientTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length()
        {
            var button = document.createElement("button");
            button.innerHTML="Custom";
            var node = document.createElement("input");
            node.type='number';
            node.id='recipientTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value','5000');
            node.setAttribute('onkeyup','changeLength2(event,this)');
            button.setAttribute('onclick','changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("recipientTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }
        function changeLength(){
            let customLength=document.getElementById("recipientTable_length_custom").value;
            recipientTable.page.len(customLength).draw();
        }

        function changeLength2(event,ele){
            let customLength=ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                recipientTable.page.len(customLength).draw();
            }
        }

        $(window).on('load',function () {
            $('#recipientTable').dataTable().fnSort([ [0,'desc']] );
            setTimeout(function () {
                get_set_combination(recipientTable,'recipientTable',recipientTableColumnNames);
            },500);
        });

    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    @include('admin.recipients.modals.index_filter')
    <script>
        $('#filter_submit').on('click',function () {
            recipientTable.ajax.reload();
        });

        $('#filter_reset').on('click',function () {
            $('#filter .select2').val(null).trigger('change');
            setTimeout(function () {
                recipientTable.ajax.reload();
                filter_count();
            },500);
        });

        $("#filter").on("hidden.bs.modal", function () {
            filter_count();
        });

        $('#filter input').on('blur,change',function (){
            filter_count();
        });

        $('#filter select').on('blur,change',function (){
            filter_count();
        });

        function filter_count(){
            let count=0;
            let designation_id_filter=$('#designation_id_filter').val();
            let status_filter=$('#status_filter').val();

            if(designation_id_filter.length>0){count++;}
            if(status_filter.length>0){count++;}

            let ele=$('#filter_count');
            if(count>0){
                ele.parent().removeClass('btn-light');
                ele.parent().removeClass('text-default');
                ele.parent().addClass('btn-warning');
            }
            else{
                ele.parent().removeClass('btn-warning');
                ele.parent().addClass('btn-light');
                ele.parent().addClass('text-default');
            }

            ele.html(count);
        }
        function setCustomStatus(){
            setTimeout(function (){
                let status=document.getElementById('recipientTable_info').innerHTML;
                $('#custom_status').html(status);
            },500)
        }

        $(window).on('load',function (){
            filter_count();
        });
    </script>
@endsection
