@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-inbox"></i>Inbox</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="{{ route('admin.crm.inbox.raport') }}" class="btn btn-primary">Generuj raport</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="table-overflow">
                <table class="table data-table w-100">
                    <thead class="thead-default">
                    <tr>
                        <th>#</th>
                        <th>Imię</th>
                        <th>E-mail</th>
                        <th>Miejsce</th>
                        <th class="colsearch">Źródło</th>
                        <th class="colsearch">Kampania</th>
                        <th>Click Identifier</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody class="content"></tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('/js/datatables.min.js') }}" charset="utf-8"></script>
        <link href="{{ asset('/css/datatables.min.css') }}" rel="stylesheet">
        <script>
            $(function () {
                $.fn.dataTable.ext.errMode = 'none';
                $('.data-table').on( 'error.dt', function ( e, settings, techNote, message ) {
                    console.log( 'An error has been reported by DataTables: ', message );
                });
            });
            $(document).ready(function(){
                const t = $('.data-table').DataTable({
                    processing: true,
                    serverSide: false,
                    responsive: true,
                    dom: 'Brtip',
                    "buttons": [
                        {
                            extend: 'excelHtml5',
                            header: true,
                            exportOptions: {
                                modifier: {
                                    order: 'index',  // 'current', 'applied', 'index',  'original'
                                    page: 'all',      // 'all',     'current'
                                    search: 'applied'     // 'none', 'applied', 'removed'
                                }
                            }
                        },
                        {
                            extend: 'csv',
                            header: true,
                            exportOptions: {
                                modifier: {
                                    order: 'index',  // 'current', 'applied', 'index',  'original'
                                    page: 'all',      // 'all',     'current'
                                    search: 'applied'     // 'none', 'applied', 'removed'
                                }
                            }
                        },
                        'colvis',
                    ],
                    language: {
                        "url": "{{ asset('/js/polish.json') }}"
                    },
                    iDisplayLength: 13,
                    ajax: "{{route('admin.crm.inbox.datatable')}}",
                    columns: [
                        {data: null, defaultContent:''},
                        {data: 'name', name: 'name'},
                        {data: 'mail', name: 'mail'},
                        {data: 'source', name: 'source'},
                        {data: 'referrer', name: 'referrer'},
                        {data: 'campaign', name: 'campaign'},
                        {data: 'click', name: 'click'},
                        {data: 'created_at', name: 'created_at'}
                    ],
                    bSort: false,
                    columnDefs: [
                        {className: 'option-120', targets: [7]},
                        {className: 'text-break', targets: [6]},
                        {className: 'select-column', targets: [4, 5]}
                    ],
                    initComplete: function () {
                        this.api().columns('.select-column').every(function () {
                            const column = this;
                            const select = $('<select class="form-select"><option value="">' + this.header().textContent + '</option></select>')
                                .appendTo($(column.header()).empty())
                                .on('change', function () {
                                    const val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });
                            column.data().unique().sort().each(function (value) {
                                if (value !== null) {
                                    select.append('<option value="' + value + '">' + value + '</option>')
                                }

                            });
                        });

                        $('<button class="dt-button buttons-refresh">Odśwież tabelę</button>').appendTo('div.dt-buttons');

                        $(".buttons-refresh").click(function () {
                            t.ajax.reload();
                        });
                    },
                    'createdRow': function(row, data, dataIndex){
                        $('td', row).eq(6).addClass('text-break');
                    },
                });
                t.on( 'init.dt', function () {
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    });
                });
                t.on( 'order.dt search.dt', function () {
                    const count = t.page.info().recordsDisplay;
                    t.column(0, {
                        search:'applied',
                        order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = count - i
                    } );
                }).draw();
            });
        </script>
    @endpush
@endsection
