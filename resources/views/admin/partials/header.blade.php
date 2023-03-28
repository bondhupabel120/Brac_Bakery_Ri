<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <?php
        $admin = DB::table('admins')->where('id', Auth::guard('admin')->user()->id)->first();
    ?>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $admin->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('assets/backend/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-label="ModalLabel" aria-hidden="true ">
    <div class="modal-dialog " role="document ">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title" id="ModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal-->
{{-- <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="edidModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                    Edit </h5>
                <button class="close " type="button " data-dismiss="modal " aria-label="Close ">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group ">
                        <label for="Total_Course " class="col-form-label ">Total Course:</label>
                        <input type="number " class="form-control " id="Total_Course ">
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button class="btn btn-secondary " type="button " data-dismiss="modal ">Close</button>
                <button class="btn bg-gradient-primary text-white " type="button ">Update</button>
            </div>
        </div>
    </div>
</div> --}}
