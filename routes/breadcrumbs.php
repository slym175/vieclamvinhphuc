<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route_check('app.admin.dashboard'));
});

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Dashboard', route_check('app.admin.dashboard'));
});

Breadcrumbs::for('admin.site', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Site', route_check('app.admin.site.index'));
});

Breadcrumbs::for('admin.profile', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Profile', route_check('app.admin.profile.index'));
});
