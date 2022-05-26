<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Abqariy</title>
  <link rel="shortcut icon" href="{{asset ('template/images/quran.png') }}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title">Group Details</p>
                                        @foreach($creator as $g)
                                        <h1>{{$g->groupName}}</h1>
                                        <h4>{{$g->groupDesc}}</h4>
                                        @endforeach
                                        <p style="color:white">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>
                                    <div>
                                </div>                  
                            </div>
                        </div>
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
                      <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Attendance</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <!-- Session -->


                    <!-- /notice -->
                    <div class="tab-pane fade show active" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                      <div class="row">
                        <div class="col-md-12 stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <br>
                              <div class="table-responsive">
                              <table id="" class="table">
                                  <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Attendance</td>
                                        <th></th>
                                        <th>Notes</th>
                                        <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($att as $atten)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$atten->attend->meetingDate}}</td>
                                        <td>{{$atten->attend->meetingTime}}</td>
                                        @if($atten->userAttendance == '1')
                                        <td>Attend</td>
                                        @else($userAttendance == '2')
                                        <td>Not Attend</td>
                                        @endif
                                        <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$atten->id}}">Update</button>
                                        <div class="modal fade" id="exampleModalCenter{{$atten->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle{{$atten->id}}">Session Details</h5>
                                                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="/updateattend"  method="post">
                                                @csrf
                                                  <div class="form-group">
                                                      <label for="meetingTime" class="col-form-label">Description:</label>
                                                      <input type="text" class="form-control" id="meetingTime" value="{{$atten->attend->meetingDesc}}" readonly>
                                                      <label for="meetingTime" class="col-form-label">Moderator:</label>
                                                      <input type="text" class="form-control" id="meetingTime" value="{{$atten->attend->meetingModerator}}" readonly>
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
                                                  <button type="submit" name="id" class="btn btn-primary me-2" value="{{$atten->id}}">Submit</button>
                                                </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                          </td>
                                          <td><a href ="{{url('/downloads',$atten->attend->meetingNotes)}}"><button type="button" class="btn btn-secondary .btn-{color} mdi mdi-download">&nbspNote</td>
                                          <td>
                                            @if($atten->attend->meetingLink !=NULL)
                                            <a href ='{{$atten->attend->meetingLink}}' target="_blank"><button type="button" class="btn btn-secondary .btn-{color}">Join Meeting</td>
                                            @endif
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
                  <br>
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