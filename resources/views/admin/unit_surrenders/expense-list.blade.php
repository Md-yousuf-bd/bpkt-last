@extends('admin.layouts.app')

@section('uncommonExCss')
    @include('admin.layouts.commons.dataTableCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower/pikaday/pikaday.css') }}">
@endsection

@section('uncommonInCss')
    <style>
        h6 {
            font-weight: bold;
        }

        .btn {
            min-width: 75px !important;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">ইউনিটে খরছের তালিকা</h5>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light text-default" role="button" data-toggle="modal"
                                data-target="#filter"><span class="fa fa-filter"></span> ফিল্টার &nbsp; &nbsp;<span
                                    class="badge badge-dark" id="filter_count">0</span></button>
                            @if (auth()->user()->can('create-unit-surrender'))
                                <a href="{{ route('unit-surrender.create-expense') }}"
                                    class="btn btn-sm btn-default pull-right"><span class="fa fa-plus-circle"></span> ইউনিটে
                                    খরছের তথ্য যুক্ত করুন</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="custom_status">Showing 0 to 0 of 0 entries</div>
                        <div class="table-responsive"
                            style="font-size: 13px; background: white; padding: 10px;  overflow: auto;">
                            <table id="unitExpenseTable" class="table table-bordered table-hover table-striped"
                                style="font-size: 14px; width:100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right"></th>
                                        {{-- <th></th>
                                        <th></th>
                                        <th></th> --}}
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
                                        <th data-sl="0">ক্রঃনং</th>
                                        <th data-sl="1" style="min-width:240px;">Action</th>
                                        <th data-sl="2">কোড</th>
                                        <th data-sl="3">ইউনিট</th>
                                        <th data-sl="4">অর্থের পরিমান</th>
                                        {{-- <th data-sl="5">অনুমোদনের অবস্থা</th>
                                        <th data-sl="6">অনুমোদনের তারিখ</th>
                                        <th data-sl="7">অনুমোদনকারী</th> --}}
                                        <th data-sl="8">অর্থবছর</th>
                                        <th data-sl="9">খরছের তারিখ</th>
                                        <th data-sl="10">খরছের স্মারক</th>
                                        <th data-sl="11">খরছের স্মারকের তারিখ</th>
                                        <th data-sl="12" style="min-width: 200px;">বর্ণনা</th>
                                        <th data-sl="13">সর্বশেষ সংস্কারক</th>
                                        <th data-sl="14" style="min-width: 200px;">সর্বশেষ সংস্করণ</th>
                                        <th data-sl="15">তথ্য যুক্ত করেছেন</th>
                                        <th data-sl="16" style="min-width: 200px;">তথ্য যুক্ত হয়েছে</th>
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
                                        <th class="text-right"></th>
                                        <th></th>
                                        <th></th>
                                        {{-- <th></th>
                                        <th></th>
                                        <th></th> --}}
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
    <script src="{{ asset('bower/pikaday/pikaday.js') }}"></script>
@endsection

@section('uncommonInJs')
    <script>
        var unitExpenseTableColumnNames = [];
        (function() {
            "use strict";

            let unitExpenseTableColumnTh = document.querySelectorAll('#unitExpenseTable thead tr:nth-child(2) th');
            for (let i = 0; i < unitExpenseTableColumnTh.length; i++) {
                unitExpenseTableColumnNames[i] = unitExpenseTableColumnTh[i].innerText
            }
            $('#unitExpenseTable thead tr:nth-child(2) th').each(function() {
                var title = $(this).text();
                let except = ['ক্রঃনং', 'Action', 'সমর্পন তারিখ',
                    'সর্বশেষ সংস্করণ', 'তথ্য যুক্ত হয়েছে'
                ];
                if (!except.includes(title)) {
                    $(this).html(
                        '<input type="text" class="col-search-input no-print form-control" style="width:100%; min-width: 80px;"/><br>' +
                        title);
                } else {
                    $(this).html('<div></div><br><br>' + title);
                }
            });

        })(jQuery);

        $('th').on("click", function(event) {
            if ($(event.target).is("input"))
                event.stopImmediatePropagation();
        });

        var customLen = 0;
        $(window).on('load', function() {
            set_custom_length();
        });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var unitExpenseTable = $('#unitExpenseTable').DataTable({
            lengthMenu: [
                [100, 500, 1000, 2500, -1],
                [100, 500, 1000, 2500, 'All']
            ],
            processing: true,
            colReorder: true,
            serverSide: true,
            scrollX: true,
            responsive: true,
            scrollCollapse: true,
            dom: "Bflrtip",
            scrollY: ($(window).height() * 0.7) + "px",
            footerCallback: function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };


                pageTotalAmount = api.column('amount:name', {
                        page: 'current'
                    }).data()
                    .reduce(function(a, b) {
                        b = en_Numbers(b);
                        b = b.replace(',', '');
                        return intVal(a) + intVal(b);
                    }, 0);

                let bn_pageTotalAmount = bn_Numbers((taka_format(pageTotalAmount)).toString());
                // totalData.amount=bn_pageTotalAmount;
                $(api.column('amount:name').footer()).html(bn_pageTotalAmount);
                if ($(api.column('amount:name').context[0].nTHead.firstElementChild.childNodes[api.column(
                        'amount:name')[0][0]]) !== undefined && api.column('amount:name')
                    .context[0].nTHead.firstElementChild
                    .childNodes[api.column('amount:name')[0][0]] !==
                    undefined) {
                    api.column('amount:name')
                        .context[0].nTHead.firstElementChild
                        .childNodes[api.column('amount:name')[0][0]]
                        .innerHTML = bn_pageTotalAmount;
                }
            },
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {},
            ajax: {
                url: '{!! route('unit-surrender.get_expense') !!}',
                dataType: "json",
                contentType: "application/json",
                type: "POST",
                headers: {
                    'Accept': 'application/json',
                },
                data: function(d) {
                    d['_token'] = csrfToken;
                    d['code_id_filter'] = $('#code_id_filter').val();
                    d['unit_id_filter'] = $('#unit_id_filter').val();
                    d['fiscal_year_filter'] = $('#fiscal_year_filter').val();
                    d['status_filter'] = $('#status_filter').val();
                    d['date_type_filter'] = $('#date_type_filter').val();
                    d['date_from_filter'] = $('#date_from_filter').val();
                    d['date_to_filter'] = $('#date_to_filter').val();
                    return JSON.stringify(d);
                },
                complete: function(response) {
                    let result = response.responseJSON;
                    setCustomStatus();
                },
                error: function(xhr, error, thrown) {
                    alert("An error occurred while attempting to retrieve data via ajax.\n" + thrown);
                }
            },
            createdRow: function(row, data, dataIndex) {
                console.log(data)
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    class: 'action'
                },
                {
                    data: 'code',
                    name: 'code.code',
                    class: 'text-left'
                },
                {
                    data: 'unit_name_bangla',
                    name: 'unit.name_bangla',
                    class: 'text-left'
                },
                {
                    data: 'DT_RowData.data-amount',
                    name: 'amount',
                    class: 'text-right'
                },
                // {
                //     data: 'status_modified',
                //     name: 'status',
                //     class: 'text-justify is-approved'
                // },
                // {
                //     data: 'DT_RowData.data-approved_at',
                //     name: 'approved_at',
                //     class: 'text-center approved-at'
                // },
                // {
                //     data: 'approved_user',
                //     name: 'approved_user.name',
                //     class: 'text-center approved-by'
                // },
                {
                    data: 'DT_RowData.data-fiscal_year',
                    name: 'fiscal_year',
                    class: 'text-center'
                },
                {
                    data: 'DT_RowData.data-transaction_date',
                    name: 'transaction_date',
                    class: 'text-center'
                },
                {
                    data: 'expense_memo',
                    name: 'expense_memo',
                    class: 'text-left'
                },
                {
                    data: 'DT_RowData.data-expense_memo_date',
                    name: 'expense_memo_date',
                    class: 'text-center'
                },
                {
                    data: 'description_modified',
                    name: 'description',
                    class: 'text-justify'
                },
                {
                    data: 'updater_user',
                    name: 'updater_user.name',
                    class: 'text-center'
                },
                {
                    data: 'DT_RowData.data-updated_at',
                    name: 'updated_at',
                    class: 'text-center'
                },
                {
                    data: 'creator_user',
                    name: 'creator_user.name',
                    class: 'text-center'
                },
                {
                    data: 'DT_RowData.data-created_at',
                    name: 'created_at',
                    class: 'text-center'
                },
            ],
            buttons: [{
                    extend: 'print',
                    title: '{{ config('app.name', 'Laravel') }}: ইউনিটে খরছের তালিকা',
                    footer: true,
                    exportOptions: {
                        stripHtml: false,
                        columns: ':visible'
                    }

                },
                {
                    extend: 'excel',
                    title: '{{ config('app.name', 'Laravel') }}: ইউনিটে খরছের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    extend: 'copy',
                    title: '{{ config('app.name', 'Laravel') }}: ইউনিটে খরছের তালিকা',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }

                },
                {
                    text: 'Column Settings',
                    action: function(e, dt, node, config) {
                        showUserTablesCombinationModal(unitExpenseTableColumnNames, 'খরছের তালিকা',
                            'unitExpenseTable');
                    }
                },
                {
                    text: 'Reset',
                    action: function(e, dt, node, config) {
                        if (confirm('আপনি কি সত্যিই সম্পূর্ণ তালিকা রিসেট করতে চান?')) {
                            location.reload();
                        }
                    }
                }

            ]
        });


        unitExpenseTable.columns().every(function(k) {

            var table = this;
            $('input', this.header()).on('keyup change', function() {
                let columns = unitExpenseTable.context[0].aoColumns;
                let sl = [];
                for (let i = 0; i < columns.length; i++) {
                    sl[i] = columns[i].sl;
                }

                let a = sl.indexOf(table[0][0]);
                if (table.search() !== this.value || this.value === '') {
                    unitExpenseTable.columns(a).search(this.value).draw();
                }
            });

        });

        function set_custom_length() {
            var button = document.createElement("button");
            button.innerHTML = "Custom";
            var node = document.createElement("input");
            node.type = 'number';
            node.id = 'unitExpenseTable_length_custom';
            node.classList.add("form");
            node.classList.add("form-control");
            node.setAttribute('value', '5000');
            node.setAttribute('onkeyup', 'changeLength2(event,this)');
            button.setAttribute('onclick', 'changeLength()');
            node.setAttribute("style", "float:right !important; width:120px !important; margin-left:5px!important;");
            button.setAttribute("style", "float:right !important; margin-left:-1px!important; height:29px;");
            let el = document.getElementById("unitExpenseTable_length");
            el.querySelector("label").appendChild(button);
            el.querySelector("label").appendChild(node);
        }

        function changeLength() {
            let customLength = document.getElementById("unitExpenseTable_length_custom").value;
            unitExpenseTable.page.len(customLength).draw();
        }

        function changeLength2(event, ele) {
            let customLength = ele.value;
            if (event.keyCode === 13) {
                event.preventDefault();
                unitExpenseTable.page.len(customLength).draw();
            }
        }

        $(window).on('load', function() {
            $('#unitExpenseTable').dataTable().fnSort([
                [0, 'desc']
            ]);
            setTimeout(function() {
                get_set_combination(unitExpenseTable, 'unitExpenseTable',
                    unitExpenseTableColumnNames);
            }, 500);
        });
    </script>
    @include('admin.layouts.commons.modals.user_tables_combination')
    @include('admin.unit_surrenders.modals.expense_filser')
    <script>
        $('#filter_submit').on('click', function() {
            unitExpenseTable.ajax.reload();
        });

        $('#filter_reset').on('click', function() {
            $('#filter .select2').val(null).trigger('change');
            setTimeout(function() {
                unitExpenseTable.ajax.reload();
                filter_count();
            }, 500);
        });

        $("#filter").on("hidden.bs.modal", function() {
            filter_count();
        });

        $('#filter input').on('blur,change', function() {
            filter_count();
        });

        $('#filter select').on('blur,change', function() {
            filter_count();
        });

        function filter_count() {
            let count = 0;
            let code_id_filter = $('#code_id_filter').val();
            let unit_id_filter = $('#unit_id_filter').val();
            let fiscal_year_filter = $('#fiscal_year_filter').val();
            let date_type_filter = $('#date_type_filter').val();
            let date_from_filter = $('#date_from_filter').val();
            let date_to_filter = $('#date_to_filter').val();
            let status_filter = $('#status_filter').val();

            if (code_id_filter.length > 0) {
                count++;
            }
            if (unit_id_filter.length > 0) {
                count++;
            }
            if (fiscal_year_filter.length > 0) {
                count++;
            }
            if (status_filter.length > 0) {
                count++;
            }
            if (date_type_filter !== '') {
                count++;
            }
            if (date_from_filter !== '') {
                count++;
            }
            if (date_to_filter !== '') {
                count++;
            }

            let ele = $('#filter_count');
            if (count > 0) {
                ele.parent().removeClass('btn-light');
                ele.parent().removeClass('text-default');
                ele.parent().addClass('btn-warning');
            } else {
                ele.parent().removeClass('btn-warning');
                ele.parent().addClass('btn-light');
                ele.parent().addClass('text-default');
            }

            ele.html(count);
        }

        // function setCustomStatus() {
        //     setTimeout(function() {
        //         let status = document.getElementById('unitExpenseTable_info').innerHTML;
        //         $('#custom_status').html(status);
        //     }, 500)
        // }

        $(window).on('load', function() {
            filter_count();
        });

        // @if (auth()->user()->can('approved-unit-surrender'))
        //     function approved(id) {
        //         if (confirm('আপনি কি সত্যিই সমর্পনটি অনুমোদন করতে চান?')) {
        //             var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //             let route = '{{ route('unit-surrender.approved') }}';
        //             $.ajax({
        //                 url: route,
        //                 data: {
        //                     id: id,
        //                     _token: csrfToken
        //                 },
        //                 type: 'POST',
        //                 headers: {
        //                     'Accept': 'application/json',
        //                 },
        //                 dataType: 'JSON',
        //                 success: function(response) {
        //                     if (response) {
        //                         @if (auth()->user()->can('unapproved-unit-surrender'))
        //                             $('#row_' + id + ' .is-approved').html(
        //                                 '<a class="btn btn-sm btn-success text-light" title="অননুমোদিত করতে ক্লিক করুন।" onclick="unapproved(' +
        //                                 id + ')">অনুমোদিত</a>');
        //                         @else
        //                             $('#row_' + id + ' .is-approved').html(
        //                                 '<span class="badge badge-success text-light">অনুমোদিত</a>');
        //                         @endif
        //                         $('#row_' + id + ' .approved-by').html(response.approved_by);
        //                         $('#row_' + id + ' .approved-at').html(response.approved_at);
        //                         $('#row_' + id + ' .action').html(response.action);
        //                         alertify.notify('সমর্পনটি অনুমোদিত হয়েছে।', 'success', 5, function() {});
        //                     } else {
        //                         alertify.notify('সমর্পনটি অনুমোদিত হয়নি।', 'error', 5, function() {});
        //                     }
        //                 }
        //             });
        //         }
        //     }
        // @endif
        // @if (auth()->user()->can('unapproved-unit-surrender'))
        //     function unapproved(id) {
        //         if (confirm('আপনি কি সত্যিই সমর্পনটি অননুমোদন করতে চান?')) {
        //             var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //             let route = '{{ route('unit-surrender.unapproved') }}';
        //             $.ajax({
        //                 url: route,
        //                 data: {
        //                     id: id,
        //                     _token: csrfToken
        //                 },
        //                 type: 'POST',
        //                 headers: {
        //                     'Accept': 'application/json',
        //                 },
        //                 dataType: 'JSON',
        //                 success: function(response) {
        //                     if (response) {
        //                         @if (auth()->user()->can('approved-unit-surrender'))
        //                             $('#row_' + id + ' .is-approved').html(
        //                                 '<a class="btn btn-sm btn-danger text-light" title="অনুমোদিত করতে ক্লিক করুন।" onclick="approved(' +
        //                                 id + ')">অননুমোদিত</a>');
        //                         @else
        //                             $('#row_' + id + ' .is-approved').html(
        //                                 '<span class="badge badge-danger text-light">অননুমোদিত</a>');
        //                         @endif
        //                         $('#row_' + id + ' .approved-by').html(response.approved_by);
        //                         $('#row_' + id + ' .approved-at').html(response.approved_at);
        //                         $('#row_' + id + ' .action').html(response.action);
        //                         alertify.notify('সমর্পনটি অনুমোদন বাতিল হয়েছে।', 'success', 5, function() {});
        //                     } else {
        //                         alertify.notify('সমর্পনটি অনুমোদন বাতিল হয়নি।', 'error', 5, function() {});
        //                     }
        //                 }
        //             });
        //         }
        //     }
        // @endif
    </script>
@endsection
