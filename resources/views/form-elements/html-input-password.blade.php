<div class="form-group row">
    @php
        if(isset($sublabel)){
            $sublabel = '<span>'.$sublabel.'</span>';
        } else {
            $sublabel = '';
        }
    @endphp
    @isset($required)
        {!! Form::label($name, '<div class="text-right">'.$label.' <span class="text-danger d-inline">*</span>'.$sublabel.'</div>', ['class' => 'col-3 col-form-label control-label required'], false) !!}
    @else
        {!! Form::label($name, '<div class="text-right">'.$label.''.$sublabel.'</div>', ['class' => 'col-3 col-form-label control-label required'], false) !!}
    @endisset
    <div class="@isset($class) {{ $class }} @else {{ 'col-4' }} @endisset">
        {!! Form::password($name, ['class' => 'form-control']) !!}
        @if($errors->first($name))<div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>@endif
    </div>
</div>
