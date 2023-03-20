<div class="card-header card-nav">
    <nav class="nav">
        <a
            class="nav-link {{ Request::routeIs('admin.crm.clients.show') ? ' active' : '' }}"
            href="{{ route('admin.crm.clients.show', $client->id) }}">
            <span class="fe-user"></span> Profil
        </a>
        <a
            class="nav-link {{ Request::routeIs('admin.crm.clients.calendar') ? ' active' : '' }}"
            href="{{ route('admin.crm.clients.calendar', $client->id) }}">
            <span class="fe-calendar"></span> Kalendarz
        </a>
        <a
            class="nav-link {{ Request::routeIs('admin.crm.clients.notes') ? ' active' : '' }}"
            href="{{ route('admin.crm.clients.notes', $client->id) }}">
            <span class="fe-book"></span> Notatki
        </a>
        <a
            class="nav-link {{ Request::routeIs('admin.crm.clients.files') ? ' active' : '' }}"
            href="{{ route('admin.crm.clients.files', $client->id) }}">
            <span class="fe-file"></span> Pliki
        </a>
        <a
            class="nav-link {{ Request::routeIs('admin.crm.clients.rodo') ? ' active' : '' }}"
            href="{{ route('admin.crm.clients.rodo', $client->id) }}">
            <span class="fe-check-circle"></span> Zgody
        </a>
        <a
            class="nav-link {{ Request::routeIs('admin.crm.clients.chat.*') ? ' active' : '' }}"
            href="{{ route('admin.crm.clients.chat.show', $client->id) }}">
            <span class="fe-mail"></span> Wiadomości
        </a>
    </nav>
</div>
