@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-users"></i>Klienci</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit"></div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <table class="table data-table mb-0 w-100">
                        <thead class="thead-default">
                        <tr>
                            <th></th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>E-mail</th>
                            <th>Telefon</th>
                            <th>Miasto</th>
                            <th>Handlowiec</th>
                            <th>Status</th>
                            <th>Dołączył</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content"></tbody>
                    </table>
                </div>
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
                    ajax: "{{route('admin.crm.clients.datatable')}}",
                    columns: [
                        {data: null, defaultContent:''},
                        {data: 'name', name: 'name'},
                        {data: null, defaultContent:''},
                        {data: 'mail', name: 'mail'},
                        {data: 'phone', name: 'phone'},
                        {data: null, defaultContent:''},
                        {data: null, defaultContent:''},
                        {data: null, defaultContent:''},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'actions', name: 'actions'}
                    ],
                    bSort: false,
                    columnDefs: [
                        {className: 'text-center', targets: [0]},
                        {className: 'option-120', targets: [2]},
                        {className: 'text-end', targets: [9]}
                    ]
                });
                t.on( 'init.dt', function () {
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    });
                })
            });
        </script>
    @endpush
@endsection
