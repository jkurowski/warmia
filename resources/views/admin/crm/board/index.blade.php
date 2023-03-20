@extends('admin.layout')

@section('content')
    <div class="container-fluid h-100">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-filter"></i>Tablica Kanban</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit"></div>
                </div>
            </div>
        </div>
        <div id="board" class="card mt-3">
            <div class="container-fluid h-100">
                <div class="board-title">{{ $board->first()->name }}</div>
                <div class="stages-container">
                    <div id="stages" class="stages-row">
                        @if($board->first()->stages->count() == 0)
                            <div class="stage" data-stage-id="0">
                                <a class="btn btn-primary dropdown-stage-create" href="#">Uwórz etap</a>
                            </div>
                        @endif
                        @foreach($board->first()->stages as $stage)
                        <div class="stage" data-stage-id="{{ $stage->id }}">
                            <div class="stage-title">
                                <span>{{ $stage->name }}</span>
                                <a role="button" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-menu-dots"><i class="fe-more-horizontal-"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item dropdown-stage-create" href="#">Dodaj etap</a></li>
                                    <li><a class="dropdown-item dropdown-stage-edit" href="#">Edytuj etap</a></li>
                                    <li><a class="dropdown-item dropdown-stage-delete" href="#">Usuń etap</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item dropdown-item-create" href="#">Dodaj zadanie</a></li>
                                </ul>
                            </div>
                            <div class="stage-tasks" data-stage-id="{{ $stage->id }}">
                                @foreach($stage->tasks as $task)
                                    <div class="task" data-task-id="{{ $task->id }}">
                                        <div class="task-body">
                                            <div class="task-name w-100">{{ $task->name }}</div>
                                            @if($task->client)<div class="task-desc w-100"><a href="">{{ $task->client->name }}</a></div>@endif
                                            <div class="task-date w-50 d-flex align-items-center">{{ $task->created_at->diffForHumans() }}</div>
                                            <div class="task-action  d-flex align-items-center justify-content-end w-50">
                                                <a role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fe-more-horizontal-"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item dropdown-item-edit" href="#">Edytuj zadanie</a></li>
                                                    <li><a class="dropdown-item dropdown-item-delete" href="#">Usuń zadanie</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('style')
        <style>#content .content {height: 100%}</style>
    @endpush
    @routes('board')
    @push('scripts')
        <script src="{{ asset('/js/ui/jquery-ui.js') }}" charset="utf-8"></script>
        <link href="{{ asset('/js/ui/jquery-ui.css') }}" rel="stylesheet">
        <script>
            sortableFunctions = {
                sortableStageTasks: function sortableStageTasks(element){
                    element.sortable({
                        cursor: "grabbing",
                        containment: "#stages",
                        connectWith: ".stage-tasks",
                        placeholder: "ui-state-highlight",
                        start: function(event, ui){
                            ui.placeholder.height(ui.item.height());
                            ui.placeholder.html(ui.item[0].outerHTML);
                        },
                        update: function(event, ui) {
                            const task_parent = ui.item.parent();
                            const task_parent_id = task_parent.data('stage-id');
                            const items = task_parent.sortable('toArray', {attribute: 'data-task-id'});

                            if (this === task_parent[0]) {
                                jQuery.ajax({
                                    type: 'POST',
                                    data: {
                                        '_token': '{{ csrf_token() }}',
                                        'items': items,
                                        'stage_id': task_parent_id
                                    },
                                    url: route('admin.crm.board.task.sort'),
                                    success: function () {
                                        toastr.options =
                                            {
                                                "closeButton": true,
                                                "progressBar": true
                                            }
                                        toastr.success("Zmiana pozycji zapisana");
                                    },
                                    error: function () {
                                        toastr.options =
                                            {
                                                "closeButton": true,
                                                "progressBar": true
                                            }
                                        toastr.error("Wystąpił błąd");
                                    }
                                });
                            }
                        }
                    }).disableSelection();
                },
                sortableStages: function sortableStages(element){
                    element.sortable({
                        cursor: "grabbing",
                        containment: "#board",
                        connectWith: "#stages",
                        placeholder: "ui-state-highlight",
                        axis: "x",
                        update: function() {
                            const items = $(this).sortable('toArray', {attribute: 'data-stage-id'});
                            jQuery.ajax({
                                type: 'POST',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    'items': items
                                },
                                url: route('admin.crm.board.stage.sort'),
                                success: function () {
                                    toastr.options =
                                        {
                                            "closeButton" : true,
                                            "progressBar" : true,
                                            "preventDuplicates": true
                                        }
                                    toastr.success("Tablica została zaktualizowana");
                                },
                                error: function () {
                                    toastr.options =
                                        {
                                            "closeButton" : true,
                                            "progressBar" : true,
                                            "preventDuplicates": true
                                        }
                                    toastr.error("Wystąpił błąd podczas zapisu");
                                }
                            });
                        }
                    }).disableSelection();
                }
            }

            $( function() {
                const $stageTasks = $( ".stage-tasks" ), $stages = $( "#stages" );

                sortableFunctions.sortableStageTasks($stageTasks);
                sortableFunctions.sortableStages($stages)

                $stages.on('click', '.dropdown-item-delete', function(event){
                    const target = event.target;
                    const parent = target.closest(".task");
                    $.confirm({
                        title: "Potwierdzenie usunięcia",
                        message: "Czy na pewno chcesz usunąć?",
                        buttons: {
                            Tak: {
                                "class": "btn btn-primary",
                                action: function() {
                                    $.ajax({
                                        url: route('admin.crm.board.task.destroy', parent.dataset.taskId),
                                        type: "DELETE",
                                        data: {
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function() {
                                            toastr.options =
                                                {
                                                    "closeButton" : true,
                                                    "progressBar" : true
                                                }
                                            toastr.success("Wpis został poprawnie usunięty");
                                            parent.style.height = "0px"
                                            parent.remove();
                                        }
                                    })
                                }
                            },
                            Nie: {
                                "class": "btn btn-secondary",
                                action: function() {}
                            }
                        }
                    })
                });

                $stages.on('click', '.dropdown-item-edit', function(event){
                    const target = event.target;
                    const parent = target.closest(".task");
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': parent.dataset.taskId
                        },
                        url: route('admin.crm.board.task.form'),
                        success: function(response) {
                            if(response) {
                                $('body').append(response);
                            } else {
                                alert('Error');
                            }
                        }
                    });
                });

                $stages.on('click', '.dropdown-item-create', function(event){
                    const target = event.target;
                    const parent = target.closest(".stage");
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'stage_id': parent.dataset.stageId
                        },
                        url: route('admin.crm.board.task.form'),
                        success: function(response) {
                            if(response) {
                                $('body').append(response);
                            } else {
                                alert('Error');
                            }
                        }
                    });
                });

                $stages.on('click', '.dropdown-stage-create', function(event){
                    const target = event.target;
                    const parent = target.closest(".stage");
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'stage_id': parent.dataset.stageId
                        },
                        url: route('admin.crm.board.stage.form'),
                        success: function(response) {
                            if(response) {
                                $('body').append(response);
                            } else {
                                alert('Error');
                            }
                        }
                    });
                });

                $stages.on('click', '.dropdown-stage-edit', function(event){
                    const target = event.target;
                    const parent = target.closest(".stage");
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': parent.dataset.stageId
                        },
                        url: route('admin.crm.board.stage.form'),
                        success: function(response) {
                            if(response) {
                                $('body').append(response);
                            } else {
                                alert('Error');
                            }
                        }
                    });
                });

                $stages.on('click', '.dropdown-stage-delete', function(event){
                    const target = event.target;
                    const parent = target.closest(".stage");
                    $.confirm({
                        title: "Potwierdzenie usunięcia",
                        message: "Czy na pewno chcesz usunąć?",
                        buttons: {
                            Tak: {
                                "class": "btn btn-primary",
                                action: function() {
                                    {{--$.ajax({--}}
                                    {{--    url: '{{ route('admin.crm.board.ajaxDestroyTask') }}',--}}
                                    {{--    type: "DELETE",--}}
                                    {{--    data: {--}}
                                    {{--        _token: '{{ csrf_token() }}',--}}
                                    {{--        'id': parent.dataset.taskId--}}
                                    {{--    },--}}
                                    {{--    success: function() {--}}
                                    {{--        toastr.options =--}}
                                    {{--            {--}}
                                    {{--                "closeButton" : true,--}}
                                    {{--                "progressBar" : true--}}
                                    {{--            }--}}
                                    {{--        toastr.success("Wpis został poprawnie usunięty");--}}
                                    {{--    }--}}
                                    {{--})--}}
                                }
                            },
                            Nie: {
                                "class": "btn btn-secondary",
                                action: function() {}
                            }
                        }
                    })
                });
            });
        </script>
    @endpush
@endsection
