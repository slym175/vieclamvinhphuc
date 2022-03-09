<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand d-flex justify-content-start align-items-center" href="">
            <div class="logo-img">
                <img style="max-width: 100%" t src="{{ asset('assets/shared/favicon-32x32.png') }}"
                     class="header-brand-img" alt="lavalite">
            </div>
            <span class="text">{{ config('app.name') }}</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i>
        </button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $p_menu = array(array(
            'icon' => 'ik ik-bar-chart-2',
            'title' => trans('menu.dashboard'),
            'url' => route_check('app.admin.dashboard'),
            'active' => is_current_route('app.admin.dashboard') || is_current_route('app.admin.index'),
            'children' => array()
        ),array(
            'icon' => 'ik ik-file',
            'title' => trans('menu.media'),
            'url' => route_check('unisharp.lfm.show'),
            'active' => is_current_route('unisharp.lfm.show'),
            'children' => array()
        ));
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                @foreach($p_menu as $menu)
                    <div
                        class="nav-item {{ $menu['active'] ? 'active' : '' }} {{ is_array($menu['children']) || !empty($menu['children']) ? '' : 'has-sub' }}">
                        <a href="{{ $menu['url'] ?? 'javascritp:void(0)' }}">
                            <i class="{{ $menu['icon'] ?? '' }}"></i>
                            <span>{{ $menu['title'] ?? '' }}</span>
                        </a>
                        @if(is_array($menu['children']) || !empty($menu['children']))
                            <div class="submenu-content">
                                @foreach($menu['children'] as $menuChildren1)
                                    <a href="{{ $menuChildren1['url'] ?? '' }}" class="menu-item">{{ $menuChildren1['title'] ?? '' }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>
        </div>
    </div>
</div>
