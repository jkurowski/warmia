@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title row"><i class="fe-grid"></i>Boksy z obrazkami</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    <a href="{{route('admin.box.create')}}" class="btn btn-primary">Dodaj boks</a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="table-overflow">
                @if (session('success'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('success') }}
                        <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                    </div>
                @endif
                <table id="sortable" class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>Nazwa</th>
                        <th>Tekst</th>
                        <th class="text-center">Obrazek</th>
                        <th class="text-center">Miejsce</th>
                        <th>Data modyfikacji</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $item)
                        <tr id="recordsArray_{{ $item->id }}">
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->text }}</td>
                            <td class="text-center">
                                @if($item->file)<img src="/uploads/box/{{$item->file}}" alt="{{ $item->name }}" style="width:40px;margin: 0 auto">
                                @endif
                            </td>
                            <td class="text-center">{!! boxPlace($item->place_id) !!}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.box.edit', [$item->id, 'lang' => 'en'])}}" class="btn action-button lang-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><img src="{{ asset('/cms/flags/en.png') }}" alt="Tłumaczenie: en"></a>
                                </div>
                            </td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <span class="btn action-button move-button me-1"><i class="fe-move"></i></span>
                                    <a href="{{route('admin.box.edit', $item->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.box.destroy', $item->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button
                                            type="submit"
                                            class="btn action-button confirm"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Usuń wpis"
                                            data-id="{{ $item->id }}"
                                        ><i class="fe-trash-2"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('admin.box.create')}}" class="btn btn-primary">Dodaj boks</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">$(document).ready(function(){$("#sortable tbody.content").sortuj('{{route('admin.box.sort')}}');});</script>
@endpush
