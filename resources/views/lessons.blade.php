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
  <link rel="stylesheet" href="{{asset('lesson_card/lesson_card.css')}}">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    {{View::make('header')}}

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Lessons</h2>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Lessons</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
              <div class="col">
                <h3>Search Lesson Videos</h3>
              </div>
            </div>
            
            <div class="row">
              <div class="col-4"></div>
              <div class="col-4"></div>
            </div>

            <form action="/filter_lessons" method="post">
              @csrf
              <table class="table table-primary">
                <tr>
                  <td><label for="">Select Grade</label></td>
                  <td><label for="">Select Subject</label></td>
                  <td></td>
                </tr>
                <tr>
                  <td width="350">
                    <select id="" class="form-control" name="gradeFilter">
                      @foreach($classes as $each_class)
                        <option value="{{ $each_class['id'] }}">{{ $each_class['name'] }}</option>
                      @endforeach
                        <option value="any" selected></option>
                    </select>
                  </td>
                  <td width="350">
                    <select class="form-control" name="subjectFilter">
                      @foreach($subjects as $each_subject)
                        <option value="{{ $each_subject['id'] }}">{{ $each_subject['name'] }}</option>
                      @endforeach
                        <option value="any" selected></option>
                    </select>
                  </td>
                  <td>
                    <input type="submit" class="btn btn-primary" value="Filter Results">
                    <a href="/lessons" class="btn btn-success">All Lessons</a>
                    {{-- <input type="reset" class="btn btn-success" value="All Lessons"> --}}
                  </td>
                </tr>
              </table>
            </form>

            <div class="row">
                @foreach($filter_lessons as $lesson)
                    <!-- <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-1-item">
                            <figure class="thumnail">
                            {{-- <a href="course-single.html"><img src="{{asset('public/image/'.$lesson['lesson_thumbnail'])}}" alt="Image" class="img-fluid"></a> --}}
                            <div class="price">$99.00</div>
                            {{-- <div class="category"><h3>{{$lesson['name']}}</h3></div>   --}}
                            </figure>
                            <div class="course-1-content pb-4">
                            {{-- <h2>{{$lesson['lesson_name']}}</h2> --}}
                            <div class="rating text-center mb-3">
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                            </div>
                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-3 mt-4" style="margin: -5px !important">
                    <div class="card profile-card-5">
                        <div class="card-img-block">
                            <img class="card-img-top" src="{{asset('public/image/'.$lesson['lesson_thumbnail'])}}" alt="Card image cap">
                        </div>
                        <div class="card-body pt-0 text-center">
                            <h4 class="card-title">{{ $lesson['name'] }}</h5>
                            <h5 class="card-title">{{ $lesson['lesson_name'] }}</h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            
                            <a href="/lesson/{{$lesson['lesson_id']}}" class="btn btn-primary btn-sm">Explore</a>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-mortarboard"></span>
              <h3>Our Philosphy</h3>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-school-material"></span>
              <h3>Academics Principle</h3>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                Dolore, amet reprehenderit.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <span class="icon flaticon-library"></span>
              <h3>Key of Success</h3>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                Dolore, amet reprehenderit.</p>
            </div>
          </div>
        </div>
      </div>
      

    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- <div class="col-lg-3">
            <p class="mb-4"><img src="images/logo.png" alt="Image" class="img-fluid"></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nemo minima qui dolor, iusto iure.</p>  
            <p><a href="#">Learn More</a></p>
          </div> -->
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
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
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
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

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