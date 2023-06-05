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
                        <h5 class="card-title">ইউনিটের তালিকা</h5>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light text-default" role="button" data-toggle="modal" data-target="#filter"><span class="fa fa-filter"></span> ফিল্টার &nbsp; &nbsp;<span class="badge badge-dark" id="filter_count">0</span></button>
                            @if(auth()->user()->can('create-unit'))
                                <a href="{{route('unit.create')}}" class="btn btn-sm btn-default pull-right"><span class="fa fa-plus-circle"></span> ইউনিটের তথ্য যুক্ত করুন</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive" style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="unitTable" class="table table-bordered table-hover table-striped" style="font-size: 14px; width:100%;">
                                <thead>
                                <tr>
                                    <th data-sl="0" >ক্রঃনং</th>
                                    <th data-sl="1"  style="min-width:240px;">Action</th>
                                    <th data-sl="2" >নাম (ইংরেজিতে)</th>
                                    <th data-sl="3" >নাম (বাংলায়)</th>
                                    <th data-sl="4" >উর্ধ্বস্থ রেঞ্জ/মেট্রো</th>
                                    <th data-sl="5" >প্রাতিষ্ঠানিক কোড</th>
                                    <th data-sl="6" >অফিস আইডি</th>
                                    <th data-sl="7" >ডিডিও আইডি</th>
                                    <th data-sl="8" >ইউনিট প্রধানের নাম</th>
                                    <th data-sl="9" >ইউনিট প্রধানের নাম (পত্রে ব্যবহারের জন্য)</th>
                                    <th data-sl="10" >ইউনিট প্রধানের পদবী</th>
                                    <th data-sl="11" >ইউনিট প্রধানের ইমেইল</th>
                                    <th data-sl="12" >ইউনিট প্রধানের মোবাইল নম্বর</th>
                                    <th data-sl="13" >দৃঃ আঃ এর জন্য অফিসারের নাম</th>
                                    <th data-sl="14" >দৃঃ আঃ এর জন্য অফিসারের নাম (পত্রে ব্যবহারের জন্য)</th>
                                    <th data-sl="15" >দৃঃ আঃ এর জন্য অফিসারের পদবী</th>
                                    <th data-sl="16" >দৃঃ আঃ জন্য অফিসার এর ইমেইল</th>
                                    <th data-sl="17" >দৃঃ আঃ জন্য অফিসার এর মোবাইল নম্বর</th>
                                    <th data-sl="18" >ইউনিটের অবস্থা</th>
                                    <th data-sl="19" >অগ্রাধিকার</th>
                                    <th data-sl="20"  style="min-width: 200px;" >বর্ণনা</th>
                                    <th data-sl="21" >সর্বশেষ সংস্কারক</th>
                                    <th data-sl="22"  style="min-width: 200px;">সর্বশেষ সংস্করণ</th>
                                    <th data-sl="23" >তথ্য যুক্ত করেছেন</th>
                                    <th data-sl="24"  style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
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
        var unitTableColumnNames=[];
        (function() {
            "use strict";

            let unitTableColumnTh=document.querySelectorAll('#unitTable thead tr th');
            for(let i=0; i<unitTableColumnTh.length; i++){unitTableColumnNames[i]=unitTableColumnTh[i].innerText}
            $('#unitTable thead th').each(function () {
                var title = $(this).text();
                let except=['ক্রঃনং','Action','ইউনিটের অবস্থা','সর্বশেষ সংস্করণ','তথ্য যুক্ত হয়েছে'];
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
        var unitTable= $('#unitTable').DataTable({
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
                url:'{!! route('unit.get_index') !!}',
                dataType: "json",
                contentType: "application/json",
                type: "POST",
                headers : {
                    'Accept': 'application/json',
                },
                data: function ( d ) {
                    d['_token']=csrfToken;
                    d['parent_unit_id_filter']=$('#parent_unit_id_filter').val();
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
                {data:'parent_unit_name',name:'parent_unit.name',class:'text-left'},
                {data:'institution_code',name:'institution_code',class:'text-left'},
                {data:'office_id',name:'office_id',class:'text-left'},
                {data:'ddo_id',name:'ddo_id',class:'text-left'},
                {data:'unit_head_name',name:'unit_head_name',class:'text-left'},
                {data:'unit_head_letter_name',name:'unit_head_letter_name',class:'text-left'},
                {data:'unit_head_designation',name:'unit_head_designation.name',class:'text-center'},
                {data:'unit_head_email',name:'unit_head_email',class:'text-left'},
                {data:'unit_head_mobile',name:'unit_head_mobile',class:'text-left'},
                {data:'for_attention_name',name:'for_attention_name',class:'text-left'},
                {data:'for_attention_letter_name',name:'for_attention_letter_name',class:'text-left'},
                {data:'for_attention_designation',name:'for_attention_designation.name',class:'text-center'},
                {data:'for_attention_email',name:'for_attention_email',class:'text-left'},
                {data:'for_attention_mobile',name:'for_attention_mobile',class:'text-left'},
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
                    title:'{{ config('app.name', 'Laravel') }}: ইউনিটের তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title:'{{ config('app.name', 'Laravel') }}: ইউনিটের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title:'{{ config('app.name', 'Laravel') }}: ইউনিটের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function ( e, dt, node, config ) {
                        showUserTablesCombinationModal(unitTableColumnNames,'ইউনিটের তালিকা','unitTable');
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


        unitTable.columns().every(function (k) {

            var table = this;
            $('input', this.header()).on('keyup change', function () {
                let columns= unitTable.context[0].aoColumns;
                let sl=[];
                for(let i=0; i<columns.length; i++){
                    sl[i]=columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value==='') {
                    unitTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length()
        {
            var button = document.createElement("button");
            button.innerHTML="Custom";
            var node = document.createElement("input");
            node.type='number';
            node.id='unitTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value','5000');
            node.setAttribute('onkeyup','changeLength2(event,this)');
            button.setAttribute('onclick','changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("unitTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }
        function changeLength(){
            let customLength=document.getElementById("unitTable_length_custom").value;
            unitTable.page.len(customLength).draw();
        }

        function changeLength2(event,ele){
            let customLength=ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                unitTable.page.len(customLength).draw();
            }
        }

        $(window).on('load',function () {
            $('#unitTable').dataTable().fnSort([ [0,'desc']] );
            setTimeout(function () {
                get_set_combination(unitTable,'unitTable',unitTableColumnNames);
            },500);
        });

    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    @include('admin.units.modals.index_filter')
    <script>
        $('#filter_submit').on('click',function () {
            unitTable.ajax.reload();
        });

        $('#filter_reset').on('click',function () {
            $('#filter .select2').val(null).trigger('change');
            setTimeout(function () {
                unitTable.ajax.reload();
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
            let parent_unit_id_filter=$('#parent_unit_id_filter').val();
            let status_filter=$('#status_filter').val();

            if(parent_unit_id_filter.length>0){count++;}
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
                let status=document.getElementById('unitTable_info').innerHTML;
                $('#custom_status').html(status);
            },500)
        }

        $(window).on('load',function (){
            filter_count();
        });
    </script>
@endsection
