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
        <a href="/redirect"><img src="{{asset ('template/images/Abqariy.png') }}" width="100" height="55" alt="logo"/></a>
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
              <span class="nav-profile-name">{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="/creatorprofile" class="dropdown-item">
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
                    <h2>Welcome back,Creator</h2>
                  </div>
                  
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Group Details</p>
                  @foreach($creator as $g)
                  <h1>{{$g->groupName}}</h1>
                  <h4>{{$g->groupDesc}}</h4>
                  @endforeach
                  <p style="color:white">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>
                  <div></div>                  
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
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Members</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Approve User</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Session</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <p class="card-title">Group Member List</p>
                                <br>
                                <div class="table-responsive">
                                    <table id="" class="table">
                                        <thead>
                                             <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @foreach($users->members as $user)
                                        <tbody>
                                            <tr>

                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td><a href="{{url('/kickmember',$user->id)}}"><button type="button" class="btn btn-danger .btn-{color}" onclick="return confirm('Are you sure?')">Delete</button></a></td>
                                               
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
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                      <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <p class="card-title">New Member Request</p>
                                    <div class="table-responsive">
                                        <table id="" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            @foreach($approve as $approve)
                                            @if($approve->groupID == $group->id && $approve->userApprove == '0')
                                            <tbody>
                                                <tr>
                                                    <td>{{$approve->user->name}}</td>
                                                    <td>{{$approve->user->email}}</td>
                                                    
                                                    <td><a value="1" href="{{url('/insert',[$approve->userID,$approve->groupID])}}"><button type="button" class="btn btn-success .btn-{color}">Approve</button></a></td>
                                                    <td><a href="{{url('/reject',[$approve->userID,$approve->groupID])}}"><button type="button" class="btn btn-danger .btn-{color}">Delete</button></a></td>
                                                </tr> 
                                            </tbody>
                                            @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                      <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <li class="nav-item nav-search d-none d-lg-block w-100">
                            @foreach($creator as $g)
                                <a href="{{url('/sessionform',$g->id )}}"><button class="btn btn-primary mt-2 mt-xl-0">New Session</button></a>
                            @endforeach
                                </li>
                                <br>
                                    <div class="table-responsive">
                                        <table id="" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>Progress</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($meet as $meeting)
                                              <tr>
                                                  <td>{{$meeting->meetingDate}}</td>          
                                                  <td>{{ Carbon\Carbon::parse($meeting->meetingTime)->format('H:i') }} </td>
                                                  <td>{{$meeting->meetingProgress}}</td> 
                                                  <td>
                                                    @foreach($attend as $att)
                                                    @if($meeting->id == $att->meetingID)
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$att->id}}">Update</button>
                                                      <div class="modal fade" id="exampleModalCenter{{$att->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle{{$att->id}}">Update Own Attendance</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body">
                                                              <form action="/updateattendance"  method="post">
                                                              @csrf
                                                                <div class="form-group">
                                                                    <label for="exampleSelectGender" class="col-form-label">Attendance</label>
                                                                      <select class="form-control" id="userAttendance" name="userAttendance" > 
                                                                        <option value="" disabled selected hidden>Please choose..</option>
                                                                        <option value="1">Attend</option>
                                                                        <option value="2">Not attend</option>
                                                                      </select>
                                                                  </div>
                                                                </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="id" class="btn btn-primary me-2" value="{{$att->id}}">Submit</button>
                                                              </div>
                                                              </form>
                                                            </div>
                                                          </div>
                                                          @endif
                                                        </div>
                                                        @endforeach
                                                      </td>
                                                    <td><a href="{{url('/meetingdetails',$meeting->id)}}"><button type="button" class="btn btn-primary .btn-{color}">Details</button></a></td>
                                                    <td><a href="{{url('/delete',$meeting->id)}}"><button type="button" class="btn btn-danger .btn-{color}" onclick="return confirm('Are you sure?')">Delete</button></a></td>
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

