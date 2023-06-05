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
                        <h5 class="card-title">কোডের তালিকা</h5>
                        <div class="card-tools">
                            @if(auth()->user()->can('create-code'))
                                <a href="{{route('code.create')}}" class="btn btn-sm btn-default pull-right"><span class="fa fa-plus-circle"></span> কোডের তথ্য যুক্ত করুন</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive" style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="codeTable" class="table table-bordered table-hover table-striped" style="font-size: 14px; width:100%;">
                                <thead>
                                <tr>
                                    <th data-sl="0" >ক্রঃনং</th>
                                    <th data-sl="1"  style="min-width:180px;">Action</th>
                                    <th data-sl="2" >কোড</th>
                                    <th data-sl="3" >কোডের নাম</th>
                                    <th data-sl="4"  style="min-width: 200px;" >বর্ণনা</th>
                                    <th data-sl="5" >সর্বশেষ সংস্কারক</th>
                                    <th data-sl="6"  style="min-width: 200px;">সর্বশেষ সংস্করণ</th>
                                    <th data-sl="7" >তথ্য যুক্ত করেছেন</th>
                                    <th data-sl="8"  style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
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
        var codeTableColumnNames=[];
        (function() {
            "use strict";

            let codeTableColumnTh=document.querySelectorAll('#codeTable thead tr th');
            for(let i=0; i<codeTableColumnTh.length; i++){codeTableColumnNames[i]=codeTableColumnTh[i].innerText}
            $('#codeTable thead th').each(function () {
                var title = $(this).text();
                let except=['ক্রঃনং','Action','সর্বশেষ সংস্করণ','তথ্য যুক্ত হয়েছে'];
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
        var codeTable= $('#codeTable').DataTable({
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
                url:'{!! route('code.get_index') !!}',
                dataType: "json",
                contentType: "application/json",
                type: "POST",
                headers : {
                    'Accept': 'application/json',
                },
                data: function ( d ) {
                    d['_token']=csrfToken;
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
                {data:'code',name:'code',class:'text-left'},
                {data:'code_name',name:'code_name',class:'text-left'},
                {data:'description_modified',name:'description',class:'text-justify'},
                {data:'updater_user',name:'updater_user.name',class:'text-center'},
                {data:'DT_RowData.data-updated_at',name:'updated_at',class:'text-center'},
                {data:'creator_user',name:'creator_user.name',class:'text-center'},
                {data:'DT_RowData.data-created_at',name:'created_at',class:'text-center'},
            ],
            buttons: [
                {
                    extend: 'print',
                    title:'{{ config('app.name', 'Laravel') }}: কোডের তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title:'{{ config('app.name', 'Laravel') }}: কোডের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title:'{{ config('app.name', 'Laravel') }}: কোডের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function ( e, dt, node, config ) {
                        showUserTablesCombinationModal(codeTableColumnNames,'কোডের তালিকা','codeTable');
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


        codeTable.columns().every(function (k) {

            var table = this;
            $('input', this.header()).on('keyup change', function () {
                let columns= codeTable.context[0].aoColumns;
                let sl=[];
                for(let i=0; i<columns.length; i++){
                    sl[i]=columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value==='') {
                    codeTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length()
        {
            var button = document.createElement("button");
            button.innerHTML="Custom";
            var node = document.createElement("input");
            node.type='number';
            node.id='codeTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value','5000');
            node.setAttribute('onkeyup','changeLength2(event,this)');
            button.setAttribute('onclick','changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("codeTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }
        function changeLength(){
            let customLength=document.getElementById("codeTable_length_custom").value;
            codeTable.page.len(customLength).draw();
        }

        function changeLength2(event,ele){
            let customLength=ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                codeTable.page.len(customLength).draw();
            }
        }

        $(window).on('load',function () {
            $('#codeTable').dataTable().fnSort([ [0,'desc']] );
            setTimeout(function () {
                get_set_combination(codeTable,'codeTable',codeTableColumnNames);
            },500);
        });

    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    <script>
        function setCustomStatus(){
            setTimeout(function (){
                let status=document.getElementById('codeTable_info').innerHTML;
                $('#custom_status').html(status);
            },500)
        }
    </script>
@endsection
