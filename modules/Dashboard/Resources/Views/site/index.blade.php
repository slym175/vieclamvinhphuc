@extends('admin.layouts.app')
@section('title', 'Site')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title">
                        <i class="ik ik-layers bg-blue"></i>
                        <div class="d-inline">
                            <h5>Dashboard</h5>
                            <span>{{ Breadcrumbs::render('admin.site') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <h5 class="mb-4 text-center">{{ trans('auth.dashboard_greeting', ["name" => auth()->user()->name]) }}</h5>
            </div>
        </div>
    </div>
@endsection

@push('css') @endpush
@push('js_defer') @endpush
@push('js') @endpush
