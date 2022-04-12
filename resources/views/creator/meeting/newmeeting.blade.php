<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Abqariy</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset ('template/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{asset ('template/vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset ('template/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset ('template/images/quran.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="../../index.html"><img src="{{asset ('template/images/logo.svg') }}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="{{asset ('template/images/logo-mini.svg') }}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
         
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{asset ('template/images/faces/face5.jpg') }}" alt="profile"/>
              <span class="nav-profile-name">{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="/myprofile" class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
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
      <!-- partial:../../partials/_sidebar.html -->
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
          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create New Session</h4>
                  <p class="card-description">
                  Please fill in all the required information
                  </p>
                  <form class="forms-sample" action="/addsession" method="POST" enctype="multipart/form-data" >
                  @csrf
                  @foreach($meet as $meet)
                    <div class="form-group">
                      <label for="exampleInputName1">Group Name</label>
                      <input type="hidden" value="{{$meet->id}}" readonly  class="form-control" name="groupID">
                      <input type="text" value="{{$meet->groupName}}" readonly  class="form-control" name="groupName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Date</label>
                      <input type="date" class="form-control" id="meetingDate" name="meetingDate" placeholder="Date">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Time</label>
                      <input type="time" class="form-control" id="meetingTime" name="meetingTime" placeholder="Time">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Description</label>
                      <input type="text" class="form-control" id="meetingDesc" name="meetingDesc" placeholder="Description">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Meeting Link</label>
                      <input type="text" class="form-control" id="meetingLink" name="meetingLink"placeholder="Meeting Link">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Moderator</label>
                      <input type="text" class="form-control" id="meetingModerator" name="meetingModerator" placeholder="Moderator">
                    </div>
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="meetingNotes" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" name="meetingNotes" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                    @endforeach
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard  </a> templates</span>
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
  <!-- inject:js -->
  <script src="{{asset ('template/js/off-canvas.js') }}"></script>
  <script src="{{asset ('template/js/hoverable-collapse.js') }}"></script>
  <script src="{{asset ('template/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset ('template/js/file-upload.js') }}"></script>
  <!-- End custom js for this page-->
</body>

</html>
