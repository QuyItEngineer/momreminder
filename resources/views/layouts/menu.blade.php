<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><span>Dashboard</span></a>
</li>

@can('campaigns.read')
    <li class="dropdown {{ Request::is('campaigns*') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Campaigns</a>
        <ul class="dropdown-menu" role="menu">
            @can('campaigns.read')
                <li><a href="{!! route('campaigns.index') !!}">Campaigns</a></li>
            @endcan
            @can('campaigns.create')
                <li><a href="{!! route('campaigns.create') !!}">Add New</a></li>
            @endcan
            @can('campaigns.read')
                <li><a href="#">Unsubcribed list</a></li>
            @endcan
        </ul>
    </li>
@endcan

@can('messages.read')
    <li>
        <a href="{!! route('messages.index') !!}">Report Messages</a>
    </li>
@endcan
@can('calls.read')
    <li>
        <a href="{!! route('calls.index') !!}">Report Calls</a>
    </li>
@endcan

@can('records.read')
    <li class="dropdown {{ Request::is('records*') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Records</a>
        <ul class="dropdown-menu" role="menu">
            @can('records.read')
                <li><a href="{!! route('records.index') !!}">Records</a></li>
            @endcan
            @can('records.create')
                <li><a href="{!! route('records.create') !!}">Add New</a></li>
            @endcan
        </ul>
    </li>
@endcan
@can('templates.read')
    <li class="dropdown {{ Request::is('templates*') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Templates</a>
        <ul class="dropdown-menu" role="menu">
            @can('templates.read')
                <li><a href="{{route('templates.index')}}">Templates</a></li>
            @endcan
            @can('templates.create')
                <li><a href="{{route('templates.create')}}">Add New</a></li>
            @endcan
        </ul>
    </li>
@endcan

<li class="dropdown {{ Request::is('groups*') ? 'active' : '' }}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Groups</a>
    <ul class="dropdown-menu" role="menu">
        @can('groups.read')
            <li><a href="{!! route('groups.index') !!}">Groups</a></li>
        @endcan
        @can('groups.create')
            <li><a href="{!! route('groups.create') !!}">Add New</a></li>
        @endcan
    </ul>
</li>

<li class="dropdown {{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Contacts</a>
    <ul class="dropdown-menu" role="menu">
        @can('contacts.read')
            <li><a href="{!! route('contacts.index') !!}">All Contacts</a></li>
        @endcan
        @can('contacts.create')
            <li><a href="{!! route('contacts.create') !!}">Add New</a></li>
        @endcan
        @can('contacts.import')
            <li><a href="{!! route('contacts.import') !!}">Import</a></li>
        @endcan
    </ul>
</li>

@can('users.read')
    <li class="dropdown {{ Request::is('users*')
    || Request::is('buyCredit')
     ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Users</a>
        <ul class="dropdown-menu" role="menu">
            @can('users.read')
                <li><a href="{!! route('users.index') !!}">Users</a></li>
            @endcan
            @can('users.create')
                <li><a href="{!! route('users.create') !!}">Add New</a></li>
            @endcan
        </ul>
    </li>
@endcan

@can('settings.read')
    <li class="dropdown {{
    (Request::is('roles*')
    || Request::is('settings*')
    || Request::is('packages*')
    || Request::is('permissions*')) ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Settings</a>
        <ul class="dropdown-menu" role="menu">
            @can('settings.read')
                <li><a href="{!! route('settings.create') !!}">Settings</a></li>
            @endcan
            @can('roles.read')
                <li><a href="{!! route('roles.index') !!}">Roles</a></li>
            @endcan
            @can('permissions.read')
                <li><a href="{!! route('permissions.index') !!}">Permissions</a></li>
            @endcan
            @can('settings.emailer')
                <li><a href="{!! route('settings.emailer') !!}">Emailer</a></li>
            @endcan
            @can('packages.create')
                <li><a href="{!! route('packages.index') !!}">Packages</a></li>
            @endcan
        </ul>
    </li>
@endcan

<li>
    <a href="">Watch Video</a>
</li>
<li>
    <a href="{!! route('packages.buy_credit') !!}">Purchase</a>
</li>
