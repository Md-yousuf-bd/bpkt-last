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
                        <h5 class="card-title">প্রেরিত মেইলের তালিকা</h5>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light text-default" role="button" data-toggle="modal" data-target="#filter"><span class="fa fa-filter"></span> ফিল্টার &nbsp; &nbsp;<span class="badge badge-dark" id="filter_count">0</span></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive" style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="emailTable" class="table table-bordered table-hover table-striped" style="font-size: 14px; width:100%;">
                                <thead>
                                <tr>
                                    <th data-sl="0" >ক্রঃনং</th>
                                    <th data-sl="1" >প্রেরণের অবস্থা</th>
                                    <th data-sl="2" >প্রাপক মেইল</th>
                                    <th data-sl="3" >প্রাপক ইউনিট</th>
                                    <th data-sl="4" >বিষয়</th>
                                    <th data-sl="5" >মেইল বডি</th>
                                    <th data-sl="6" >বরাদ্দ কোড</th>
                                    <th data-sl="7" >বরাদ্দের খাত</th>
                                    <th data-sl="8" >প্রেরক মেইল</th>
                                    <th data-sl="9" >মেইল সার্ভার</th>
                                    <th data-sl="10" >তথ্য যুক্ত করেছেন</th>
                                    <th data-sl="11"  style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
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
        var emailTableColumnNames=[];
        (function() {
            "use strict";

            let emailTableColumnTh=document.querySelectorAll('#emailTable thead tr:nth-child(1) th');
            for(let i=0; i<emailTableColumnTh.length; i++){emailTableColumnNames[i]=emailTableColumnTh[i].innerText}
            $('#emailTable thead tr:nth-child(2) th').each(function () {
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
        var emailTable= $('#emailTable').DataTable({
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
            },
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            },
            ajax: {
                url:'{!! route('email.get_index') !!}',
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
                {data:'to_mail',name:'to_mail',class:'text-left'},
                {data:'unit_name',name:'units.name_bangla',class:'text-center'},
                {data:'subject',name:'subject',class:'text-justify'},
                {data:'content_modified',name:'content',class:'text-justify'},
                {data:'code',name:'codes.code',class:'text-center'},
                {data:'allocation_sector',name:'unit_allotments.allocation_sector',class:'text-justify'},
                {data:'from_mail',name:'from_mail',class:'text-left'},
                {data:'mail_server',name:'mail_server',class:'text-center'},
                {data:'creator_user',name:'creator_user.name',class:'text-center'},
                {data:'DT_RowData.data-created_at',name:'created_at',class:'text-center'},
            ],
            buttons: [
                {
                    extend: 'print',
                    title:'{{ config('app.name', 'Laravel') }}: মেইলের তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title:'{{ config('app.name', 'Laravel') }}: মেইলের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title:'{{ config('app.name', 'Laravel') }}: মেইলের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function ( e, dt, node, config ) {
                        showUserTablesCombinationModal(emailTableColumnNames,'মেইলের তালিকা','emailTable');
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


        emailTable.columns().every(function (k) {

            var table = this;
            $('input', this.header()).on('keyup change', function () {
                let columns= emailTable.context[0].aoColumns;
                let sl=[];
                for(let i=0; i<columns.length; i++){
                    sl[i]=columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value==='') {
                    emailTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length()
        {
            var button = document.createElement("button");
            button.innerHTML="Custom";
            var node = document.createElement("input");
            node.type='number';
            node.id='emailTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value','5000');
            node.setAttribute('onkeyup','changeLength2(event,this)');
            button.setAttribute('onclick','changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("emailTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }
        function changeLength(){
            let customLength=document.getElementById("emailTable_length_custom").value;
            emailTable.page.len(customLength).draw();
        }

        function changeLength2(event,ele){
            let customLength=ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                emailTable.page.len(customLength).draw();
            }
        }

        $(window).on('load',function () {
            $('#emailTable').dataTable().fnSort([ [0,'desc']] );
            setTimeout(function () {
                get_set_combination(emailTable,'emailTable',emailTableColumnNames);
            },500);
        });

    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    @include('admin.emails.modals.index_filter')
    <script>
        $('#filter_submit').on('click',function () {
            emailTable.ajax.reload();
        });

        $('#filter_reset').on('click',function () {
            $('#filter .select2').val(null).trigger('change');
            setTimeout(function () {
                emailTable.ajax.reload();
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
                let status=document.getElementById('emailTable_info').innerHTML;
                $('#custom_status').html(status);
            },500)
        }

        $(window).on('load',function (){
            filter_count();
        });

    </script>
@endsection
