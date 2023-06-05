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
                        <h5 class="card-title">ইউনিটে বরাদ্দের চিঠির তালিকা</h5>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light text-default" role="button" data-toggle="modal" data-target="#filter"><span class="fa fa-filter"></span> ফিল্টার &nbsp; &nbsp;<span class="badge badge-dark" id="filter_count">0</span></button>
                            @if(auth()->user()->can('create-allotment-letter'))
                                <a href="{{route('unit-allotment-letter.create')}}" class="btn btn-sm btn-default pull-right"><span class="fa fa-plus-circle"></span> ইউনিটে বরাদ্দের চিঠি যুক্ত করুন</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive" style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="unitAllotmentLetterTable" class="table table-bordered table-hover table-striped" style="font-size: 14px; width:100%;">
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
                                    <th class="text-right"></th>
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
                                    <th data-sl="1"  style="min-width:240px;">Action</th>
                                    <th data-sl="2" >নথি নং (উপরের অংশ)</th>
                                    <th data-sl="3" >স্মারক (উপরের অংশ)</th>
                                    <th data-sl="4" >স্মারক এর তারিখ (উপরের অংশ)</th>
                                    <th data-sl="5" >নথি নং (নিচের অংশ)</th>
                                    <th data-sl="6" >স্মারক (নিচের অংশ)</th>
                                    <th data-sl="7" >স্মারক এর তারিখ (নিচের অংশ)</th>
                                    <th data-sl="8" >উপরের স্বাক্ষর</th>
                                    <th data-sl="9" >উপরের সাক্ষরের তারিখ</th>
                                    <th data-sl="10" >নিচের স্বাক্ষর</th>
                                    <th data-sl="11" >নিচের সাক্ষরের তারিখ</th>
                                    <th data-sl="12" >মোট বরাদ্দ সংখ্যা</th>
                                    <th data-sl="13" >মোট ইউনিট</th>
                                    <th data-sl="14" >মোট বরাদ্দকৃত অর্থের পরিমাণ</th>
                                    <th data-sl="15"  style="min-width: 250px;">চিঠির বিষয়</th>
                                    <th data-sl="16" >মোট প্রেরিত মেইল</th>
                                    <th data-sl="17" >মোট প্রেরিত এসএমএস</th>
                                    <th data-sl="18" >সর্বশেষ সংস্কারক</th>
                                    <th data-sl="19"  style="min-width: 200px;">সর্বশেষ সংস্করণ</th>
                                    <th data-sl="20" >তথ্য যুক্ত করেছেন</th>
                                    <th data-sl="21"  style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
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
                                    <th class="text-right"></th>
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
        var unitAllotmentLetterTableColumnNames=[];
        (function() {
            "use strict";

            let unitAllotmentLetterTableColumnTh=document.querySelectorAll('#unitAllotmentLetterTable thead tr:nth-child(2) th');
            for(let i=0; i<unitAllotmentLetterTableColumnTh.length; i++){unitAllotmentLetterTableColumnNames[i]=unitAllotmentLetterTableColumnTh[i].innerText}
            $('#unitAllotmentLetterTable thead tr:nth-child(2) th').each(function () {
                var title = $(this).text();
                let except=['ক্রঃনং','Action','স্মারক এর তারিখ (উপরের অংশ)','স্মারক এর তারিখ (নিচের অংশ)','উপরের স্বাক্ষর','উপরের সাক্ষরের তারিখ','নিচের স্বাক্ষর','নিচের সাক্ষরের তারিখ','মোট বরাদ্দ সংখ্যা','মোট ইউনিট','মোট বরাদ্দকৃত অর্থের পরিমাণ','মোট প্রেরিত মেইল','মোট প্রেরিত এসএমএস','সর্বশেষ সংস্করণ','তথ্য যুক্ত হয়েছে'];
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
        var unitAllotmentLetterTable= $('#unitAllotmentLetterTable').DataTable({
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


                pageTotalTotalAmount = api.column( 'total_amount:name', { page: 'current'} ).data()
                    .reduce( function (a, b) {
                        b=en_Numbers(b);
                        b=b.replace(',','');
                        return intVal(a) + intVal(b);
                    }, 0 );

                let bn_pageTotalTotalAmount=bn_Numbers((taka_format(pageTotalTotalAmount)).toString());
                $( api.column( 'total_amount:name' ).footer() ).html(bn_pageTotalTotalAmount);
                if($( api.column('total_amount:name').context[0].nTHead.firstElementChild.childNodes[api.column( 'total_amount:name' )[0][0]])!==undefined && api.column('total_amount:name')
                        .context[0].nTHead.firstElementChild
                        .childNodes[api.column('total_amount:name')[0][0]]
                    !==undefined) {
                    api.column('total_amount:name')
                        .context[0].nTHead.firstElementChild
                        .childNodes[api.column('total_amount:name')[0][0]]
                        .innerHTML = bn_pageTotalTotalAmount;
                }
            },
            fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            },
            ajax: {
                url:'{!! route('unit-allotment-letter.get_index') !!}',
                dataType: "json",
                contentType: "application/json",
                type: "POST",
                headers : {
                    'Accept': 'application/json',
                },
                data: function ( d ) {
                    d['_token']=csrfToken;
                    d['code_id_filter']=$('#code_id_filter').val();
                    d['unit_id_filter']=$('#unit_id_filter').val();
                    d['fiscal_year_filter']=$('#fiscal_year_filter').val();
                    d['sign_status_filter']=$('#sign_status_filter').val();
                    d['memo_status_filter']=$('#memo_status_filter').val();
                    d['date_type_filter']=$('#date_type_filter').val();
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
                {data:'action',name:'action',searchable: false, orderable: false,class:'action'},
                {data:'sub_header_memo_first_part',name:'sub_header_memo_first_part',class:'text-left'},
                {data:'sub_header_memo_second_part',name:'sub_header_memo_second_part',class:'text-center'},
                {data:'DT_RowData.data-sub_header_memo_date',name:'sub_header_memo_date',class:'text-center'},
                {data:'sub_header_memo_first_part_2',name:'sub_header_memo_first_part_2',class:'text-left'},
                {data:'sub_header_memo_second_part_2',name:'sub_header_memo_second_part_2',class:'text-center'},
                {data:'DT_RowData.data-sub_header_memo_date_2',name:'sub_header_memo_date_2',class:'text-center'},
                {data:'DT_RowData.data-is_signed',name:'is_signed',class:'text-center'},
                {data:'DT_RowData.data-signature_date',name:'signature_date',class:'text-center'},
                {data:'DT_RowData.data-is_signed_2',name:'is_signed_2',class:'text-center'},
                {data:'DT_RowData.data-signature_date_2',name:'signature_date_2',class:'text-center'},
                {data:'DT_RowData.data-total_allotments',name:'total_allotments',class:'text-center'},
                {data:'DT_RowData.data-total_units',name:'total_units',class:'text-center'},
                {data:'DT_RowData.data-total_amount',name:'total_amount',class:'text-right'},
                {data:'subject_modified',name:'description',class:'text-justify'},
                {data:'DT_RowData.data-mail_count',name:'mail_count',class:'text-right'},
                {data:'DT_RowData.data-sms_count',name:'sms_count',class:'text-right'},
                {data:'updater_user',name:'updater_user.name',class:'text-center'},
                {data:'DT_RowData.data-updated_at',name:'updated_at',class:'text-center'},
                {data:'creator_user',name:'creator_user.name',class:'text-center'},
                {data:'DT_RowData.data-created_at',name:'created_at',class:'text-center'},
            ],
            buttons: [
                {
                    extend: 'print',
                    title:'{{ config('app.name', 'Laravel') }}: ইউনিটে বরাদ্দের চিঠির তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml : false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title:'{{ config('app.name', 'Laravel') }}: ইউনিটে বরাদ্দের চিঠির তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title:'{{ config('app.name', 'Laravel') }}: ইউনিটে বরাদ্দের চিঠির তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function ( e, dt, node, config ) {
                        showUserTablesCombinationModal(unitAllotmentLetterTableColumnNames,'বরাদ্দের তালিকা','unitAllotmentLetterTable');
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


        unitAllotmentLetterTable.columns().every(function (k) {

            var table = this;
            $('input', this.header()).on('keyup change', function () {
                let columns= unitAllotmentLetterTable.context[0].aoColumns;
                let sl=[];
                for(let i=0; i<columns.length; i++){
                    sl[i]=columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value==='') {
                    unitAllotmentLetterTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length()
        {
            var button = document.createElement("button");
            button.innerHTML="Custom";
            var node = document.createElement("input");
            node.type='number';
            node.id='unitAllotmentLetterTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value','5000');
            node.setAttribute('onkeyup','changeLength2(event,this)');
            button.setAttribute('onclick','changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("unitAllotmentLetterTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }
        function changeLength(){
            let customLength=document.getElementById("unitAllotmentLetterTable_length_custom").value;
            unitAllotmentLetterTable.page.len(customLength).draw();
        }

        function changeLength2(event,ele){
            let customLength=ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                unitAllotmentLetterTable.page.len(customLength).draw();
            }
        }

        $(window).on('load',function () {
            $('#unitAllotmentLetterTable').dataTable().fnSort([ [0,'desc']] );
            setTimeout(function () {
                get_set_combination(unitAllotmentLetterTable,'unitAllotmentLetterTable',unitAllotmentLetterTableColumnNames);
            },500);
        });

    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    @include('admin.unit_allotments.letters.modals.index_filter')
    <script>
        $('#filter_submit').on('click',function () {
            unitAllotmentLetterTable.ajax.reload();
        });

        $('#filter_reset').on('click',function () {
            $('#filter .select2').val(null).trigger('change');
            setTimeout(function () {
                unitAllotmentLetterTable.ajax.reload();
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
            let code_id_filter=$('#code_id_filter').val();
            let unit_id_filter=$('#unit_id_filter').val();
            let fiscal_year_filter=$('#fiscal_year_filter').val();
            let date_type_filter=$('#date_type_filter').val();
            let date_from_filter=$('#date_from_filter').val();
            let date_to_filter=$('#date_to_filter').val();
            let sign_status_filter=$('#sign_status_filter').val();
            let memo_status_filter=$('#memo_status_filter').val();

            if(code_id_filter.length>0){count++;}
            if(unit_id_filter.length>0){count++;}
            if(fiscal_year_filter.length>0){count++;}
            if(date_type_filter!==''){count++;}
            if(memo_status_filter!==''){count++;}
            if(sign_status_filter!==''){count++;}
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
                let status=document.getElementById('unitAllotmentLetterTable_info').innerHTML;
                $('#custom_status').html(status);
            },500)
        }

        $(window).on('load',function (){
            filter_count();
        });

    </script>
@endsection
