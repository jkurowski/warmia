<div class="modal fade modal-form" id="portletModal" tabindex="-1" aria-labelledby="portletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post" id="modalForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="portletModalLabel">Dodaj wydarzenie - {{$date}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fe-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-form container">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="position-relative">
                                        <input type="text" class="form-control border-bottom-left-radius-0 @error('activity') is-invalid @enderror" id="inputActivity" name="activity" placeholder="Rozmowa telefoniczna" required>
                                        @if($errors->first('activity'))<div class="invalid-feedback d-block">{{ $errors->first('activity') }}</div>@endif
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Typ wydarzenia">
                                        <input type="radio" class="btn-check" name="type" id="btnradio1" autocomplete="off" checked value="1">
                                        <label class="btn btn-primary" for="btnradio1"><i class="las la-phone"></i></label>

                                        <input type="radio" class="btn-check" name="type" id="btnradio2" autocomplete="off" value="2">
                                        <label class="btn btn-primary" for="btnradio2"><i class="las la-user-tie"></i></label>

                                        <input type="radio" class="btn-check" name="type" id="btnradio3" autocomplete="off" value="3">
                                        <label class="btn btn-primary" for="btnradio3"><i class="las la-clock"></i></label>

                                        <input type="radio" class="btn-check" name="type" id="btnradio4" autocomplete="off" value="4">
                                        <label class="btn btn-primary" for="btnradio4"><i class="lab la-font-awesome-flag"></i></label>

                                        <input type="radio" class="btn-check" name="type" id="btnradio5" autocomplete="off" value="5">
                                        <label class="btn btn-primary" for="btnradio5"><i class="las la-envelope"></i></label>
                                        <input type="radio" class="btn-check" name="type" id="btnradio6" autocomplete="off" value="6">
                                        <label class="btn btn-primary" for="btnradio6"><i class="las la-utensils"></i></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputDate" class="col-3 col-form-label control-label required text-end">Data</label>
                                    <div class="col-5">
                                        <input type="text" value="{{$date}}" class="validate[required] form-control @error('date') is-invalid @enderror" id="inputDate" name="date">
                                        @if($errors->first('date'))<div class="invalid-feedback d-block">{{ $errors->first('date') }}</div>@endif
                                    </div>
                                    @if(!$allday)
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="las la-clock"></i></span>
                                                <input type="time" value="{{$time}}" class="form-control @error('time') is-invalid @enderror" id="inputTime" name="time">
                                                @if($errors->first('time'))<div class="invalid-feedback d-block">{{ $errors->first('time') }}</div>@endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="inputClient" class="col-3 col-form-label control-label required text-end">Klient</label>
                                    <div class="col-9">
                                        <input type="text" class="validate[required] form-control @error('client') is-invalid @enderror" id="inputClient" name="client" autocomplete="off">
                                        <input type="hidden" name="client_id" value="0" id="inputClientId">
                                        @if($errors->first('client'))<div class="invalid-feedback d-block">{{ $errors->first('client') }}</div>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputNote" class="col-3 col-form-label control-label required text-end">Notatka</label>
                                    <div class="col-9">
                                        <textarea name="note" cols="30" rows="5" class="form-control @error('note') is-invalid @enderror" id="inputNote" style="resize: none"></textarea>
                                        @if($errors->first('note'))<div class="invalid-feedback d-block">{{ $errors->first('note') }}</div>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-3 col-form-label"></div>
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="activeCheck" name="active">
                                            <label class="form-check-label" for="activeCheck">Oznacz jako wykonane</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="allday" value="{{$allday}}" id="inputAllDay">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('/js/typeahead.min.js') }}" charset="utf-8"></script>
<script>
    const modal = document.getElementById('portletModal'),
        calendarEventModal = new bootstrap.Modal(modal),
        form = document.getElementById('modalForm'),
        inputDate = $('#inputDate'),
        inputTime = $('#inputTime'),
        inputActivity = $('#inputActivity'),
        inputClient = $('#inputClient'),
        inputClientId = $('#inputClientId'),
        inputNote = $('#inputNote'),
        inputAllDay = $('#inputAllDay');

    const users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '{{ route('admin.rodo.clients.index') }}'
        }
    });

    calendarEventModal.show();
    modal.addEventListener('shown.bs.modal', event => {
        inputDate.datepicker({
            format: 'yyyy-mm-dd',
        });
        users.clearPrefetchCache();
        users.initialize();
        inputClient.typeahead({
            hint: true,
            highlight: true,
            minLength: 3
        },
        {
            name: 'users',
            display: 'name',
            source: users
        });
        inputClient.bind('typeahead:select', function(ev, suggestion) {
            inputClientId.val(suggestion.id);
        });
    })
    document.getElementById('inputClient').addEventListener('input', () => {
        inputClientId.val(0);
    })
    modal.addEventListener('hidden.bs.modal', event => {
        $('#portletModal').remove();
        users.clearPrefetchCache();
    })

    const alert = $('.alert-danger');
    form.addEventListener('submit', (e)=> {
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.crm.calendar.store') }}",
            method: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'start': inputDate.val(),
                'end': inputDate.val(),
                'time': inputTime.val(),
                'name': inputActivity.val(),
                'note': inputNote.val(),
                'client_id': inputClientId.val(),
                'allday': inputAllDay.val(),
                'type': $('input[name="type"]:checked').val()
            },
            success: function(){
                calendarEventModal.hide();
            },
            error : function(result){
                if(result.responseJSON.data)
                {
                    alert.html('');
                    $.each(result.responseJSON.data, function(key, value){
                        alert.show();
                        alert.append('<span>'+value+'</span>');
                    });
                }
            }
        });
    });
</script>
