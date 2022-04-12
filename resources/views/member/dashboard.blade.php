<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Abqariy</title>
  <link rel="shortcut icon" href="{{asset ('template/images/quran.png') }}" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset ('template/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{asset ('template/vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset ('template/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css --> 
  <link rel="stylesheet" href="{{asset ('template/css/style.css') }}">
  <!-- endinject -->
  
</head>
<body>
  
    
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="/redirect"><img src="{{asset ('template/images/logo.svg') }}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="/redirect"><img src="{{asset ('template/images/logo-mini.svg') }}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
         
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="template/images/faces/face5.jpg" alt="profile"/>
              <span class="nav-profile-name">{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="/memberprofile" class="dropdown-item">
                <i class="mdi mdi-account text-primary"></i>
                My Profile
              </a>
              @auth
                <a href="{{ route('logout') }}" class ="dropdown-item" onclick = "event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout text-primary"></i>Log Out
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                @csrf
                </form></a>
                @endauth
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/redirect">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h2>Welcome back,Member</h2>
                  </div>
                  
                </div>
               
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Joined Group</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Suggested Group</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="t-tab" data-bs-toggle="tab" href="#t" role="tab" aria-controls="t" aria-selected="false">Pending Group</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="row">
                        <div class="col-md-12 stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <li class="nav-item nav-search d-none d-lg-block w-100">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="search">
                                      <i class="mdi mdi-magnify"></i>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
                                </div>
                              </li>
                              <br>
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Group Name</th>
                                      <th>Group Desc</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  @foreach($user->grp as $user)
                                  <tbody>
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$user->groupName}}</td>
                                      <td>{{$user->groupDesc}}</td>
                                      <td><a href="{{url('/groupdetails',$user->id)}}"><button type="button" class="btn btn-primary .btn-{color}">Details</button></a></td>
                                      <td><a href="{{url('/join',$user->id)}}"><button type="button" class="btn btn-secondary .btn-{color}">Leave</button></td>
                                    </tr>
                                  </tbody>
                                  @endforeach
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
          
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="row">
                        <div class="col-md-12 stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <li class="nav-item nav-search d-none d-lg-block w-100">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="search">
                                      <i class="mdi mdi-magnify"></i>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
                                </div>
                              </li>
                              <br>
                              <div class="table-responsive">
                                <table id="" class="table">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Group Name</th>
                                      <th>Group Description</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($exists as $group)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$group->groupName}}</td>
                                      <td>{{$group->groupDesc}}</td>
                                      <td>
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$group->id}}">Details</button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModalCenter{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Group Details</h5>
                                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Group Name:{{$group->groupName}}</p>
                                              <p>Group Description : {{$group->groupDesc}}</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      </td>
                                      <td><a href="{{url('/join',$group->id)}}"><button type="button" class="btn btn-secondary .btn-{color}">Join</button></td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
          
                    <div class="tab-pane fade" id="t" role="tabpanel" aria-labelledby="t-tab">
                      <div class="row">
                        <div class="col-md-12 stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="" class="table">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Group Name</th>
                                      <th>Group Description</th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($request as $req)   
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$req->group->groupName}}</td>
                                      <td>{{$req->group->groupDesc}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright Abqariy 2022</span>

        </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset ('template/vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset ('template/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{asset ('template/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{asset ('template/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset ('template/js/off-canvas.js') }}"></script>
  <script src="{{asset ('template/js/hoverable-collapse.js') }}"></script>
  <script src="{{asset ('template/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset ('template/js/dashboard.js') }}"></script>
  <script src="{{asset ('template/js/data-table.js') }}"></script>
  <script src="{{asset ('template/js/jquery.dataTables.js') }}"></script>
  <script src="{{asset ('template/js/dataTables.bootstrap4.js') }}"></script>
  <!-- End custom js for this page-->

  <script src="{{asset ('template/js/jquery.cookie.js') }}" type="text/javascript"></script>
</body>

</html>

