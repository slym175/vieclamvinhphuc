<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand d-flex justify-content-start align-items-center" href="">
            <div class="logo-img">
                <img style="max-width: 100%" src="{{ asset('assets/shared/favicon-32x32.png') }}"
                     class="header-brand-img" alt="lavalite">
            </div>
            <span class="text">{{ config('app.name') }}</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i>
        </button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $primary_menu = array(
            'tools' => array (
                array(
                    'icon' => 'ik ik-bar-chart-2',
                    'title' => trans('menu.dashboard'),
                    'url' => route_check('app.admin.dashboard'),
                    'active' => is_current_route('app.admin.dashboard') || is_current_route('app.admin.index'),
                    'children' => array()
                ),
            ),
            'settings' => array (
                array(
                    'icon' => 'ik ik-aperture',
                    'title' => trans('menu.location'),
                    'url' => route_check('app.admin.location.index'),
                    'active' => is_current_route('app.admin.location.index'),
                    'children' => array()
                ),
            )
        );
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                @foreach($primary_menu as $key => $menus)
                    <div class="nav-lavel"><?= isset($key) && $key ? trans('menu.'.$key) : '' ?></div>
                    @foreach($menus as $key => $menu)
                        <div
                            class="nav-item {{ $menu['active'] ? 'active' : '' }} {{ is_array($menu['children']) && !empty($menu['children']) ? 'has-sub' : '' }}">
                            <a href="{{ isset($menu['url']) && $menu['url'] ? $menu['url'] : 'javascritp:void(0)' }}">
                                <i class="{{ isset($menu['icon']) && $menu['icon'] ? $menu['icon'] : '' }}"></i>
                                <span>{{ isset($menu['title']) && $menu['title'] ? $menu['title'] : '' }}</span>
                            </a>
                            @if(is_array($menu['children']) && !empty($menu['children']))
                                <div class="submenu-content">
                                    @foreach($menu['children'] as $menuChildren1)
                                        <div
                                            class="nav-item <?= is_array($menuChildren1['children']) && !empty($menuChildren1['children']) ? 'has-sub' : '' ?>">
                                            <a href="{{ isset($menuChildren1['url']) && $menuChildren1['url'] ? $menuChildren1['url'] : '' }}"
                                               class="menu-item {{ is_array($menuChildren1['children']) && !empty($menuChildren1['children']) ? 'has-sub' : '' }}">
                                                {{ isset($menuChildren1['title']) && $menuChildren1['title'] ? $menuChildren1['title'] : '' }}
                                            </a>
                                            @if(is_array($menuChildren1['children']) && !empty($menuChildren1['children']))
                                                <div class="submenu-content" style="">
                                                    @foreach($menuChildren1['children'] as $menuChildren2)
                                                        <a href="{{ isset($menuChildren2['url']) && $menuChildren2['url'] ? $menuChildren2['url'] : '' }}"
                                                           class="menu-item">
                                                            {{ isset($menuChildren2['title']) && $menuChildren2['title'] ? $menuChildren2['title'] : '' }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </nav>
        </div>
    </div>
</div>
