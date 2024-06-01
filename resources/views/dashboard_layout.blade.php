<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>NRPAS | @yield('title', 'NCAA RPAS Registration')</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background-color: #01B8E2; border-bottom: 1px solid #96e7ff;">
      <div class="container-fluid">
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="{{ route('dashboard') }}"
          ><img src="images/nrpaslogo.png" alt="NRPAS" style="height: 65px;"></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
          </form>
          @include('inc.top_navbar_links')
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li style="padding-top: 50px">
              <div class="text-white my-4 px-3 py-4">
                <div style="font-size: 12px;">Welcome,</div>
                <div style="font-size: 27px; font-weight: 700;">{{ ucwords(Auth::user()->profile->firstname) }}</div>
              </div>
            </li>
            <li>
              <a href="{{ route('dashboard') }}" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-house-door-fill"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{ route('profile.show') }}" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-person-fill"></i></span>
                <span>User Profile</span>
              </a>
            </li>
            <li>
              <a href="{{ route('rpas.index') }}" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-list-check"></i></span>
                <span>Registered RPAS</span>
                <span class="badge bg-white rounded-pill text-info">{{ Auth::user()->rpases->count() }}</span>
              </a>
            </li>
            <li>
              <a href="{{ route('rpas.create')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-plus-square"></i></span>
                <span>Add Drone</span>
              </a>
            </li>
            <li>
              <a href="{{ route('logout')}}" class="nav-link px-3 active d-block d-lg-none">
                <span class="me-2"><i class="bi bi-box-arrow-right"></i></span>
                <span>Logout</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3 active d-block d-lg-none">
                <span class="me-2"><i class="bi bi-question-square"></i></span>
                <span>Help</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div style="height: 40px;"></div>
        <div id="main-body">
            @yield('content')
        </div>
      </div>
      <div class="footer">
        @include('inc.footer_credit')
      </div>
    </main>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="/js/jquery-3.5.1.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap5.min.js"></script>
    <script src="/js/script.js"></script>
  </body>
</html>
