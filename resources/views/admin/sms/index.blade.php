@extends('admin.layouts.app')

@section('uncommonExCss')
    @include('admin.layouts.commons.dataTableCss')
    <link rel="stylesheet" type="text/css" href="{{asset('bower/pikaday/pikaday.css')}}">
@endsection

@section('uncommonInCss')
    <style>

        h6{
            font-weight: bold;
        }
        .btn{
            min-width:75px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">প্রেরিত এসএমএস এর তালিকা</h5>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light text-default" role="button" data-toggle="modal" data-target="#filter"><span class="fa fa-filter"></span> ফিল্টার &nbsp; &nbsp;<span class="badge badge-dark" id="filter_count">0</span></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive" style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="smsTable" class="table table-bordered table-hover table-striped" style="font-size: 14px; width:100%;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th data-sl="0" >ক্রঃনং</th>
                                    <th data-sl="1" >প্রেরণের অবস্থা</th>
                                    <th data-sl="2" >প্রাপকের ফোন নম্বর</th>
                                    <th data-sl="3" >প্রাপক ইউনিট</th>
                                    <th data-sl="4" >এসএমএস বডি</th>
                                    <th data-sl="5" >এসএমএস কাউন্ট</th>
                                    <th data-sl="6" >প্রতি এসএমএস খরচ</th>
                                    <th data-sl="7" >মোট খরচ</th>
                                    <th data-sl="8" >প্রেরণের অবস্থার বিবরণি</th>
                                    <th data-sl="9" >বরাদ্দ কোড</th>
                                    <th data-sl="10" >বরাদ্দের খাত</th>
                                    <th data-sl="11" >সেন্ডার আইডি</th>
                                    <th data-sl="12" >এসএমএস কোম্পানি</th>
                                    <th data-sl="13" >তথ্য যুক্ত করেছেন</th>
                                    <th data-sl="14"  style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
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
    <script src="{{asset('bower/pikaday/pikaday.js')}}"></script>
@endsection

@section('uncommonInJs')
    <script>
        var smsTableColumnNames=[];
        (function() {
            "use strict";

            let smsTableColumnTh=document.querySelectorAll('#smsTable thead tr:nth-child(2) th');
            for(let i=0; i<smsTableColumnTh.length; i++){smsTableColumnNames[i]=smsTableColumnTh[i].innerText}
            $('#smsTable thead tr:nth-child(2) th').each(function () {
                var title = $(this).text();
                let except=['ক্রঃনং','প্রেরণের অবস্থা','তথ্য যুক্ত হয়েছে'];
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
        var smsTable= $('#smsTable').DataTable({
            lengthMenu: [[100, 500, 1000, 2500, -1], [100, 500, 1000, 2500, 'All']],
            processing:true,
            colReorder: true,
            serverSide:true,
            scrollX:true,
            responsive: true,
            scrollCollapse: true,
            dom: "Bflrtip",
            scrollY:($(window).height()*0.7)+"px",
            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };


                pageTotalTotalCharge = api.column( 'total_charge:name', { page: 'current'} ).data()
                    .reduce( function (a, b) {
                        b=en_Numbers(b);
                        b=b.replace(',','');
                        return intVal(a) + intVal(b);
                    }, 0 );

                let bn_pageTotalTotalCharge=bn_Numbers((taka_format(pageTotalTotalCharge)).toString());
                $( api.column( 'total_charge:name' ).footer() ).html(bn_pageTotalTotalCharge);
                if($( api.column('total_charge:name').context[0].nTHead.firstElementChild.childNodes[api.column( 'total_charge:name' )[0][0]])!==undefined && api.column('total_charge:name')
                        .context[0].nTHead.firstElementChild
                        .childNodes[api.column('total_charge:name')[0][0]]
                    !==undefined) {
                    api.column('total_charge:name')
                        .context[0].nTHead.firstElementChild
                        .childNodes[api.column('total_charge:name')[0][0]]
                        .innerHTML = bn_pageTotalTotalCharge;
                }
            },
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            },
            ajax: {
                url:'{!! route('sms.get_index') !!}',
                dataType: "json",
                contentType: "application/json",
                type: "POST",
                headers : {
                    'Accept': 'application/json',
                },
                data: function ( d ) {
                    d['_token']=csrfToken;
                    d['status_filter']=$('#status_filter').val();
                    d['date_from_filter']=$('#date_from_filter').val();
                    d['date_to_filter']=$('#date_to_filter').val();
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
                {data:'status_modified',name:'status',class:'text-center'},
                {data:'to_number',name:'to_number',class:'text-center'},
                {data:'unit_name',name:'units.name_bangla',class:'text-center'},
                {data:'content_modified',name:'content',class:'text-justify'},
                {data:'DT_RowData.data-sms_count',name:'sms_count',class:'text-right'},
                {data:'DT_RowData.data-per_sms_charge',name:'per_sms_charge',class:'text-right'},
                {data:'DT_RowData.data-total_charge',name:'total_charge',class:'text-right'},
                {data:'status_message_modified',name:'status_message',class:'text-justify'},
                {data:'code',name:'codes.code',class:'text-center'},
                {data:'allocation_sector',name:'unit_allotments.allocation_sector',class:'text-justify'},
                {data:'sender_id',name:'sender_id',class:'text-center'},
                {data:'sms_bulk',name:'sms_bulk',class:'text-center'},
                {data:'creator_user',name:'creator_user.name',class:'text-center'},
                {data:'DT_RowData.data-created_at',name:'created_at',class:'text-center'},
            ],
            buttons: [
                {
                    extend: 'print',
                    title:'{{ config('app.name', 'Laravel') }}: এসএমএস এর তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title:'{{ config('app.name', 'Laravel') }}: এসএমএস এর তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title:'{{ config('app.name', 'Laravel') }}: এসএমএস এর তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function ( e, dt, node, config ) {
                        showUserTablesCombinationModal(smsTableColumnNames,'এসএমএস এর তালিকা','smsTable');
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


        smsTable.columns().every(function (k) {

            var table = this;
            $('input', this.header()).on('keyup change', function () {
                let columns= smsTable.context[0].aoColumns;
                let sl=[];
                for(let i=0; i<columns.length; i++){
                    sl[i]=columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value==='') {
                    smsTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length()
        {
            var button = document.createElement("button");
            button.innerHTML="Custom";
            var node = document.createElement("input");
            node.type='number';
            node.id='smsTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value','5000');
            node.setAttribute('onkeyup','changeLength2(event,this)');
            button.setAttribute('onclick','changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("smsTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }
        function changeLength(){
            let customLength=document.getElementById("smsTable_length_custom").value;
            smsTable.page.len(customLength).draw();
        }

        function changeLength2(event,ele){
            let customLength=ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                smsTable.page.len(customLength).draw();
            }
        }

        $(window).on('load',function () {
            $('#smsTable').dataTable().fnSort([ [0,'desc']] );
            setTimeout(function () {
                get_set_combination(smsTable,'smsTable',smsTableColumnNames);
            },500);
        });

    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    @include('admin.sms.modals.index_filter')
    <script>
        $('#filter_submit').on('click',function () {
            smsTable.ajax.reload();
        });

        $('#filter_reset').on('click',function () {
            $('#filter .select2').val(null).trigger('change');
            setTimeout(function () {
                smsTable.ajax.reload();
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
            let date_from_filter=$('#date_from_filter').val();
            let date_to_filter=$('#date_to_filter').val();
            let status_filter=$('#status_filter').val();

            if(status_filter.length>0){count++;}
            if(date_from_filter!==''){count++;}
            if(date_to_filter!==''){count++;}

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
                let status=document.getElementById('smsTable_info').innerHTML;
                $('#custom_status').html(status);
            },500)
        }

        $(window).on('load',function (){
            filter_count();
        });

    </script>
@endsection
