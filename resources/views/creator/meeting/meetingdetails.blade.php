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
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset ('template/images/logo.svg') }}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset ('template/images/logo-mini.svg') }}" alt="logo"/></a>
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
              <img src="{{asset ('template/images/faces/face5.jpg') }}" alt="profile"/>
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
        </div>
        </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Attendance</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <br>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="d-flex justify-content-between flex-wrap">
                            <div class="d-flex justify-content-between align-items-end flex-wrap">
                           
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$meeting->id}}">Update</button>
                                        <div class="modal fade" id="exampleModalCenter{{$meeting->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle{{$meeting->id}}">Edit Meeting Details</h5>
                                                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="/editmeeting"  method="post" enctype="multipart/form-data">
                                                @csrf
                                                  <div class="form-group">
                                                      <label for="meetingDate"  class="col-form-label">Date:</label>
                                                      <input type="date" class="form-control" id="meetingDate" name="meetingDate" value="{{$meeting->meetingDate}}" >
                                                      <label for="meetingTime" class="col-form-label">Time:</label>
                                                      <input type="time" class="form-control" id="meetingTime" name="meetingTime" value="{{$meeting->meetingTime}}" >
                                                      <label for="meetingDesc" class="col-form-label">Description:</label>
                                                      <input type="text" class="form-control" id="meetingTime" name="meetingDesc" value="{{$meeting->meetingDesc}}" >
                                                      <label for="meetingModerator" class="col-form-label">Moderator:</label>
                                                      <input type="text" class="form-control" id="meetingModerator" name="meetingModerator" value="{{$meeting->meetingModerator}}" >
                                                      <label for="meetingLink" class="col-form-label">Meeting Link:</label>
                                                      <input type="text" class="form-control" id="meetingLink" name="meetingLink" value="{{$meeting->meetingLink}}" >
                                                      <!-- <label for="meetingNotes" class="col-form-label">Meeting Notes:</label>
                                                      <input type="file" class="form-control" id="meetingLink" name="meetingNotes" value="{{$meeting->meetingNotes}}" > -->
                                                    </div>
                                                  
                                                  </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" name="id" class="btn btn-primary me-2" value="{{$meeting->id}}">Submit</button>
                                                </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                            
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Meeting Details</h4>
                              <div class="table-responsive">
                                <table class="table">                                 
                                  <tbody>
                                    <tr>
                                      <td style="width:20%">Date:</td>
                                      <td style="width:80%">{{$meeting->meetingDate}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width:20%">Time:</td>
                                      <td style="width:80%">{{$meeting->meetingTime}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width:20%">Description:</td>
                                      <td style="width:80%">{{$meeting->meetingDesc}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width:20%">Link meeting:</td>
                                      <td style="width:80%"><a href ='{{$meeting->meetingLink}}' target="_blank">{{$meeting->meetingLink}}</a></td>
                                    </tr>
                                    <tr>
                                      <td style="width:20%">Moderator:</td>
                                      <td style="width:80%">{{$meeting->meetingModerator}}</td>
                                    <tr>
                                      <td style="width:20%">Progress:</td>
                                      <td style="width:80%">{{$meeting->meetingProgress}}</td>
                                    </tr>
                                    <tr>
                                      <td style="width:20%">Notes:</td>
                                      <td style="width:80%"><a href ="{{url('/download',$meeting->meetingNotes)}}">Download</a></td>
                                    </tr>
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
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Member Attendance</h4>
                                <div class="table-responsive">
                                  <table class="table">
                                      <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Attendance</th>
                                            <th>Feedback</th>
                                        </tr>
                                      </thead>
                                      @foreach($user as $mem)
                                      <tbody>
                                        <tr>
                                            <td>{{$mem->userID}}</td>
                                            <td>{{$mem->member->name}}</td>
                                            @if($mem->userAttendance == '1')
                                            <td>Attend</td>
                                            @else($mem->userAttendance == '2')
                                            <td>Not Attend</td>
                                            @endif
                                            @if($mem->userFeedback == NULL)
                                            <td>No feedback</td>
                                            @else
                                            <td>{{$mem->userFeedback}}</td>
                                            @endif
                                        </tr>
                                      </tbody>
                  
                                      @endforeach
                                    </table>
                                  </table>
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
