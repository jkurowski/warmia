<div class="modal fade modal-form" id="portletModal" tabindex="-1" aria-labelledby="portletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="portletModalLabel">Etap</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fe-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-form container">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="inputName" class="col-3 col-form-label control-label required text-end">Nazwa</label>
                                    <div class="col-9">
                                        <input type="text" value="{{$stage->name}}" class="validate[required] form-control @error('name') is-invalid @enderror" id="inputName" name="name" >
                                        @if($errors->first('name'))<div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>@endif
                                        @if($stage->id)
                                            <input type="hidden" name="stage_id" value="{{$stage->id}}" id="inputStageId">
                                        @endif
                                        @isset($stage_id)
                                            <input type="hidden" name="current_stage_id" value="{{$stage_id}}" id="inputCurrentStageId">
                                        @endif
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
        boardStageModal = new bootstrap.Modal(modal),
        button = document.getElementById('sendAjax')
        form = document.getElementById('modalForm'),
        $inputStageId = $('#inputStageId'),
        $inputCurrentStageId = $('#inputCurrentStageId'),
        $inputName = $('#inputName'),
        $stages = $( "#stages" );

    boardStageModal.show();
    modal.addEventListener('hidden.bs.modal', event => {
        modal.remove();
    })

    const $alert = $('.alert-danger');

    const Stage = ({ id, name}) => `<div class="stage" data-stage-id="${id}"><div class="stage-title"><span>${name}</span><a role="button" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-menu-dots"><i class="fe-more-horizontal-"></i></a><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item dropdown-stage-create" href="#">Dodaj etap</a></li><li><a class="dropdown-item dropdown-stage-edit" href="#">Edytuj etap</a></li><li><a class="dropdown-item dropdown-stage-delete" href="#">Usuń etap</a></li><li><hr class="dropdown-divider"></li><li><a class="dropdown-item dropdown-item-create" href="#">Dodaj zadanie</a></li></ul></div><div class="stage-tasks" data-stage-id="${id}"></div></div>`;

    form.addEventListener('submit', (e)=> {
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.crm.board.stage.store') }}",
            method: 'POST',
            async: false,
            data: {
                '_token': '{{ csrf_token() }}',
                'name': $inputName.val(),
                'id': $inputStageId.val(),
                'current_stage_id': $inputCurrentStageId.val()
            },
            success: function(result) {
                if (result.action === 'created') {
                    $([{id: result.id, name: result.name}].map(Stage).join('')).insertAfter($(".stage[data-stage-id=" + result.current_stage_id + "]"));
                    $stages.sortable('refresh');
                    const items = $stages.sortable('toArray', {attribute: 'data-stage-id'});
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'items': items
                        },
                        url: '{{ route('admin.crm.board.stage.sort') }}',
                        success: function () {
                            toastr.options =
                                {
                                    "closeButton" : true,
                                    "progressBar" : true
                                }
                            toastr.success("Utworzono nowy etap");
                            $('.stage[data-stage-id="0"]').remove();
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

                } else if (result.action === 'updated') {

                    $(".stage[data-stage-id=" + result.id + "] .stage-title span").text(result.name);
                    toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                    toastr.info("Etap został zaktualizowany");

                }
                boardStageModal.hide();
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
