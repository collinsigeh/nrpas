<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>NRPAS | @yield('title', 'NCAA RPAS Registration')</title>
  </head>
  <body style="background-color: #f5f5f5;">
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background-color: #01B8E2;">
      <div class="container-fluid">
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          ><img src="/images/nrpaslogo.png" alt="NRPAS" style="height: 65px;"></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
          </form>
          @include('inc.top_navbar_links')
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <div class="container" id="main-body">
      <div style="height: 140px;"></div>
      @yield('content')
    </div>
    <footer>
        <div class="row">
            <div class="col-md-2 text-md-end py-3">
                <img src="/images/nrpaslogo.png" alt="" width="120px" style="padding-right: 20px;">
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-4 ps-md-5 py-3">
                  <a href="https://rpas-wg.org.ng/" class="footer-link">NRPAS Rulemaking Coalation<br>
                    Aviation House - P. M. B. 21029 Ikeja<br>
                    Murtala Mohammed Airport - Ikeja, Lagos</a>
                </div>
                <div class="col-md-4 ps-md-5 py-3">
                  <a href="http://www.ncaa.gov.ng/" class="footer-link">Nigerian Civil Aviation Authority</a><br>
                  <a href="http://www.nigeria.gov.ng/" class="footer-link">Federal Government of Nigeria</a><br>
                  <a href="http://www.nama.gov.ng/" class="footer-link">Nigerian Airspace Management Agency</a><br>
                </div>
                <div class="col-md-4 ps-md-5 py-3">
                  <a href="http://www.ncaa.gov.ng/directorates/consumer-protection/guidelines-for-filing-complaints/#" class="footer-link">Contact Nigerian CAA</a><br>
                  <a href="http://www.ncaa.gov.ng/directorates/consumer-protection/guidelines-for-filing-complaints/#" class="footer-link">Document Tracking Office (DTO)</a><br>
                  <a href="http://www.ncaa.gov.ng/directorates/consumer-protection/guidelines-for-filing-complaints/#" class="footer-link">Flight Standards Group (FSG)</a><br>
                </div>
              </div>
            </div>
            <div class="col-md-2 py-3">
              <img src="/images/ncaalogo.png" alt="">
            </div>
        </div>
        <div class="footer-credit">
          @include('inc.footer_credit')
        </div>
    </footer>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="/js/jquery-3.5.1.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap5.min.js"></script>
    <script src="/js/script.js"></script>
  </body>
</html>
