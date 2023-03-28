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
    <div class="content-body  mb-4">
        <div class="row">
            <!-- Total Course  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary1 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <i class="fas fa-book fa-2x text-gray-300"></i>

                                    </div>
                                    <div>
                                        <div
                                            class="text-xs font-weight-bold text-primary1 text-uppercase mb-1">
                                            Total Category</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">

                                <!-- Nav Item - User Information -->
                                <div class="crud">
                                    <div class="dropdown no-arrow d-none">
                                        <a class="dropdown-toggle" href="#" id="crudDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="dot-item">
                                                <div class="dot1"></div>
                                                <div class="dot2"></div>
                                                <div class="dot3"></div>
                                            </div>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="crodDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i
                                                    class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Profile
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#Edit">
                                        <div class="dot-item">
                                            <div class="dot1"></div>
                                            <div class="dot2"></div>
                                            <div class="dot3"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                    <div>
                                        <div
                                            class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Product</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-auto">

                                <!-- Nav Item - User Information -->
                                <div class="crud">
                                    <a href="#" data-toggle="modal" data-target="#Edit">
                                        <div class="dot-item">
                                            <div class="dot1"></div>
                                            <div class="dot2"></div>
                                            <div class="dot3"></div>
                                        </div>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amounts -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                    <div>
                                        <div
                                            class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total User</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>

                                    </div>



                                </div>

                            </div>
                            <div class="col-auto">

                                <!-- Nav Item - User Information -->
                                <div class="crud">
                                    <div class="dropdown no-arrow d-none">
                                        <a class="dropdown-toggle" href="#" id="crudDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="dot-item">
                                                <div class="dot1"></div>
                                                <div class="dot2"></div>
                                                <div class="dot3"></div>
                                            </div>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="crodDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i
                                                    class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Profile
                                            </a>

                                        </div>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#Edit">
                                        <div class="dot-item">
                                            <div class="dot1"></div>
                                            <div class="dot2"></div>
                                            <div class="dot3"></div>
                                        </div>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Parents  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                    <div>
                                        <div
                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Order </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>

                                    </div>



                                </div>

                            </div>
                            <div class="col-auto">

                                <!-- Nav Item - User Information -->
                                <div class="crud">
                                    <div class="dropdown no-arrow d-none">
                                        <a class="dropdown-toggle" href="#" id="crudDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <div class="dot-item">
                                                <div class="dot1"></div>
                                                <div class="dot2"></div>
                                                <div class="dot3"></div>
                                            </div>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="crodDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i
                                                    class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Profile
                                            </a>

                                        </div>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#Edit">
                                        <div class="dot-item">
                                            <div class="dot1"></div>
                                            <div class="dot2"></div>
                                            <div class="dot3"></div>
                                        </div>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


