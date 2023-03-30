@extends('admin.master')

@section('title')
    Admin Dashboard | {{ $appName }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="content-page-header mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <a href="javascript:void(0);"><i class="fas fa-th-large"></i> <span>Dashboard</span> </a>
                </h4>
            </div>
            <!-- end card body-->
        </div>
    </div>

</div>
@endsection


