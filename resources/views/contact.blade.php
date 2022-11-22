<?php

  $school_name = null;
  $school_address = null;
  $school_admin = null;
  $admin_tel = null;

  foreach($contact_details as $contact) {
    $school_name = $contact['school_name'];
    $school_address = $contact['school_address'];
    $school_admin = $contact['admin_name'];
    $admin_tel = $contact['admin_tel'];
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Eduvance &mdash; Video Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">
    {{View::make('header')}}

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-7">
            <h2 class="mb-0">Contact Us</h2>
            <p>Feel free to contact us for any questions.</p>
          </div>
        </div>
      </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Contact</span>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        @if(Session()->get('faild'))
            <div class="alert alert-danger" role="alert">
             {{ Session()->get('faild') }}
            </div>
        @elseif (Session()->get('success'))
            <div class="alert alert-success" role="alert">
              {{ Session()->get('success') }}
            </div>
        @endif
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h3>Contact Details</h3>
                <hr>
                <div class="row">
                  <div class="col">
                    <span><b>School Name</b></span>
                    <p>{{ $school_name }}</p>
                  </div>

                  <div class="col">
                    <span><b>School Address</b></span>
                    <p>{{ $school_address }}</p>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <span><b>School Email Address</b></span>
                    <p>{{ $school_admin }}</p>
                  </div>

                  <div class="col">
                    <span><b>School Contact Number</b></span>
                    <p>{{ $admin_tel }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h3 class="mt-5">Send us a Message</h3>
        <hr>

        <form action="/save_feedback" method="post">
          @csrf
          <div class="row mt-3">
            <div class="col-md-6 form-group">
              <label for="fname">First Name</label>
              <input type="text" name="fname" class="form-control form-control-lg">
            </div>
            <div class="col-md-6 form-group">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" class="form-control form-control-lg">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="eaddress">Email Address</label>
              <input type="text" name="mailAddress" class="form-control form-control-lg">
            </div>
            <div class="col-md-6 form-group">
              <label for="tel">Contact Number</label>
              <input type="text" name="tel" class="form-control form-control-lg">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="message">Message</label>
              <textarea name="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <input type="submit" value="Send Message" class="btn btn-primary btn-lg px-5">
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosphy</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis
              delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Academics Principle</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis
              delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Key of Success</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis
              delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
        </div>
      </div>
    </div>


    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="images/logo.png" alt="Image" class="img-fluid"></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nemo minima qui dolor, iusto iure.</p>
            <p><a href="#">Learn More</a></p>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Our Campus</span></h3>
            <ul class="list-unstyled">
              <li><a href="#">Acedemic</a></li>
              <li><a href="#">News</a></li>
              <li><a href="#">Our Interns</a></li>
              <li><a href="#">Our Leadership</a></li>
              <li><a href="#">Careers</a></li>
              <li><a href="#">Human Resources</a></li>
            </ul>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Our Courses</span></h3>
            <ul class="list-unstyled">
              <li><a href="#">Math</a></li>
              <li><a href="#">Science &amp; Engineering</a></li>
              <li><a href="#">Arts &amp; Humanities</a></li>
              <li><a href="#">Economics &amp; Finance</a></li>
              <li><a href="#">Business Administration</a></li>
              <li><a href="#">Computer Science</a></li>
            </ul>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Contact</span></h3>
            <ul class="list-unstyled">
              <li><a href="#">Help Center</a></li>
              <li><a href="#">Support Community</a></li>
              <li><a href="#">Press</a></li>
              <li><a href="#">Share Your Story</a></li>
              <li><a href="#">Our Supporters</a></li>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="copyright">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made
                with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                  target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- .site-wrap -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#51be78" />
    </svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>