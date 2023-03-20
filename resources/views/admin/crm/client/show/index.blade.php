@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-users"></i><a href="{{route('admin.crm.clients.index')}}">Klienci</a><span class="d-inline-flex me-2 ms-2">/</span>{{$client->name}}</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit"></div>
            </div>
        </div>
        @include('admin.crm.client.client_shared.menu')
        <div class="row">
            <div class="col-4">
                @include('admin.crm.client.client_shared.aside')
            </div>
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-body card-body-rem">
                        @include('form-elements.html-select', ['label' => 'Status', 'name' => 'status', 'selected' => '', 'select' => ['1' => 'Aktywny']])
                        @include('form-elements.html-select', ['label' => 'Pierwsze wrażenie', 'name' => 'impression', 'selected' => '', 'select' => ['1' => 'Bardzo dobre']])
                        @include('form-elements.html-input-text', ['label' => 'Imię', 'name' => 'name', 'value' => $client->name, 'required' => 1, 'class' => 'col-9'])
                        @include('form-elements.html-input-text', ['label' => 'Nazwisko', 'name' => 'lastname', 'value' => $client->name, 'required' => 1, 'class' => 'col-9'])
                        @include('form-elements.html-input-text', ['label' => 'Adres e-mail', 'name' => 'mail', 'value' => $client->mail, 'required' => 1, 'class' => 'col-9'])
                        @include('form-elements.html-input-text', ['label' => 'Adres e-mail 2', 'name' => 'mail2', 'value' => $client->mail2, 'class' => 'col-9'])
                        @include('form-elements.html-input-text', ['label' => 'Telefon', 'name' => 'phone', 'value' => $client->phone, 'required' => 1, 'class' => 'col-9'])
                        @include('form-elements.html-input-text', ['label' => 'Telefon 2', 'name' => 'phone2', 'value' => $client->phone2, 'class' => 'col-9'])
                        <div class="form-group row">
                            <div class="col-12"><div class="section">CRM</div></div>
                        </div>
                        @include('form-elements.html-select', ['label' => 'Status sprzedaży', 'name' => 'deal', 'selected' => '', 'select' => ['1' => 'Podpisanie umowy']])
                        @include('form-elements.html-select', ['label' => 'Miasto', 'name' => 'city', 'selected' => '', 'select' => ['1' => 'Warszawa']])
                        @include('form-elements.html-select', ['label' => 'Inwestycja', 'name' => 'investment_id', 'selected' => '', 'select' => ['1' => 'Nazwa inwestycji']])
                        @include('form-elements.html-select', ['label' => 'Opiekun', 'name' => 'user_id', 'selected' => '', 'select' => ['1' => 'Jan Kowalski']])
                        @include('form-elements.html-select', ['label' => 'Zródło kontaktu', 'name' => 'source', 'selected' => '', 'select' => ['1' => 'Reklama Google']])
                        @include('form-elements.html-input-text', ['label' => 'Pokoje', 'name' => 'room', 'value' => ''])
                        @include('form-elements.html-input-text', ['label' => 'Metraż', 'name' => 'area', 'value' => ''])
                        @include('form-elements.html-input-text', ['label' => 'Budżet', 'name' => 'budget', 'value' => ''])
                        @include('form-elements.html-input-text', ['label' => 'Przeznaczenie', 'name' => 'purpose', 'value' => ''])
                        @include('form-elements.html-input-text', ['label' => 'Przeznaczenie', 'name' => 'purpose', 'value' => ''])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){

            });
        </script>
    @endpush
@endsection
