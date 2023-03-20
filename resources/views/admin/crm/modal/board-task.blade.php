<div class="modal fade modal-form" id="portletModal" tabindex="-1" aria-labelledby="portletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="portletModalLabel">Zadanie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fe-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-form container">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="inputName" class="col-3 col-form-label control-label required text-end">Tytuł</label>
                                    <div class="col-9">
                                        <input type="text" value="{{$task->name}}" class="validate[required] form-control @error('name') is-invalid @enderror" id="inputName" name="name">
                                        @if($errors->first('name'))<div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>@endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputClient" class="col-3 col-form-label control-label required text-end">Klient</label>
                                    <div class="col-9">
                                        <input type="text" class="validate[required] form-control @error('client') is-invalid @enderror" id="inputClient" name="client" autocomplete="off">
                                        @if($task->id)
                                            <input type="hidden" name="task_id" value="{{$task->id}}" id="inputTaskId">
                                        @endif
                                        <input type="hidden" name="stage_id" value="{{$stage_id}}" id="inputStageId">
                                        <input type="hidden" name="client_id" value="0" id="inputClientId">
                                        @if($errors->first('client'))<div class="invalid-feedback d-block">{{ $errors->first('client') }}</div>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('/js/typeahead.min.js') }}" charset="utf-8"></script>
<script>
    const modal = document.getElementById('portletModal')
        boardTaskModal = new bootstrap.Modal(modal),
        button = document.getElementById('sendAjax')
        form = document.getElementById('modalForm'),
        $inputTaskId = $('#inputTaskId'),
        $inputStageId = $('#inputStageId'),
        $inputName = $('#inputName'),
        $inputClient = $('#inputClient'),
        $inputClientId = $('#inputClientId');

    boardTaskModal.show();

    const users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '{{ route('admin.rodo.clients.index') }}'
        }
    });

    modal.addEventListener('shown.bs.modal', event => {
        users.clearPrefetchCache();
        users.initialize();
        $inputClient.typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            },
            {
                name: 'users',
                display: 'name',
                source: users
            });
        $inputClient.bind('typeahead:select', function(ev, suggestion) {
            $inputClientId.val(suggestion.id);
        });

        @if($task->client)
        $inputClient.typeahead('val', '{{$task->client->name}}');
        $inputClientId.val({{$task->client->id}});
        @endif
    })
    document.getElementById('inputClient').addEventListener('input', (e) => {
        $inputClientId.val(0);
    })
    modal.addEventListener('hidden.bs.modal', event => {
        $('#portletModal').remove();
        users.clearPrefetchCache();
    })

    const $alert = $('.alert-danger');
    form.addEventListener('submit', (e)=> {
        e.preventDefault();

        const Task = ({ id, name, client_id, created_at }) => `<div class="task" data-task-id="${id}"><div class="task-body"><div class="task-name w-100">${name}</div><div class="task-desc w-100">${client_id}</div><div class="task-date w-50 d-flex align-items-center">${created_at}</div><div class="task-action d-flex align-items-center justify-content-end w-50"><a role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fe-more-horizontal-"></i></a><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item dropdown-item-edit" href="#">Edytuj zadanie</a></li><li><a class="dropdown-item dropdown-item-delete" href="#">Usuń zadanie</a></li></ul></div></div>`;

        $.ajax({
            url: "{{ route('admin.crm.board.task.store') }}",
            method: 'POST',
            async: false,
            data: {
                '_token': '{{ csrf_token() }}',
                'id': $inputTaskId.val(),
                'name': $inputName.val(),
                'client_id': $inputClientId.val(),
                'stage_id': $inputStageId.val()
            },
            success: function(result) {
                if (result.action === 'created') {
                    const $stageColumn = $(".stage-tasks[data-stage-id=" + result.stage_id + "]");
                    $stageColumn.append([
                        {
                            id: result.id,
                            name: result.name,
                            client_id: result.client_id,
                            created_at: result.created_at
                        },
                    ].map(Task).join(''));

                    // TODO: Dodać zapis sortowania tabeli po dodaniu task`a
                    //myfunctions.sortableStageTasks($stageColumn)

                    toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                    toastr.success("Wpis został poprawnie dodany");
                } else if (result.action === 'updated') {
                    $(".task[data-task-id=" + result.id + "] ").replaceWith([
                        {
                            id: result.id,
                            name: result.name,
                            client_id: result.client_id,
                            created_at: result.created_at
                        },].map(Task).join(''));
                    toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                    toastr.info("Wpis został poprawnie zapisany");
                }
                boardTaskModal.hide();
            },
            error : function(result){
                if(result.responseJSON.errors)
                {
                    $alert.html('');
                    $.each(result.responseJSON.errors, function(key, value){
                        $alert.show();
                        $alert.append('<span>'+value+'</span>');
                    });
                }
            }
        });
    });
</script>
