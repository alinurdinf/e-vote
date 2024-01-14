@php
$links = [
[
"href" => "dashboard",
"text" => "Dashboard",
"is_multi" => false,
],

[
"href" => [
[
"section_text" => "User",
"section_list" => [
["href" => "user", "text" => "Data User"],
["href" => "user.new", "text" => "Buat User"]
]
]
],
"text" => "User",
"is_multi" => true,
],

[
"href" => [
[
"section_text" => "User",
"section_list" => [
["href" => "user", "text" => "Data User"],
["href" => "user.new", "text" => "Buat User"]
]
]
],
"text" => "User",
"is_multi" => true,
],

];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dummy</li>
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            @role('admin|sadmin')
            <li class="menu-header">Menu</li>
            <li class="dropdown {{ Request::routeIs('user') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-chart-bar"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('user') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user') }}">Data User</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('voter') ? 'active' : '' }}"><a class="nav-link" href="{{ route('voter') }}">Voter</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('candidate') ? 'active' : '' }}"><a class="nav-link" href="{{ route('candidate') }}">Candidate</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('batch') ? 'active' : '' }}"><a class="nav-link" href="{{ route('batch') }}">Batch</a></li>
                </ul>
            </li>
            @endrole
            <li class="{{ Request::routeIs('voting') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('voting')}}"><i class="fas fa-fire"></i><span>E-Voting</span></a>
            </li>
        </ul>
    </aside>
</div>
