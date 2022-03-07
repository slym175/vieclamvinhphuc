<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand d-flex justify-content-start align-items-center" href="">
            <div class="logo-img">
                <img style="max-width: 100%" t src="{{ asset('assets/shared/favicon-32x32.png') }}" class="header-brand-img" alt="lavalite">
            </div>
            <span class="text">{{ config('app.name') }}</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <!-- <div class="nav-lavel">Navigation</div> -->
                <div class="nav-item active">
                    <a href=""><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Widgets</span> <span class="badge badge-danger">150+</span></a>
                    <div class="submenu-content">
                        <a href="" class="menu-item">Basic</a>
                        <a href="" class="menu-item">Statistic</a>
                        <a href="" class="menu-item">Data</a>
                        <a href="" class="menu-item">Chart Widget</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
