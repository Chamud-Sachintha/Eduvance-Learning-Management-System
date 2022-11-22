<?php
  require base_path() . '/vendor/autoload.php';

  use GuzzleHttp\Client;

  if ($lesson_details[0]['platform_link'] != "N") {
    $vedio_link = $lesson_details[0]['platform_link'];
    $arr_link = explode("embed", $vedio_link);
    $sep_slash = explode("/", $arr_link[1]);

    //dd($arr_link[0]);

    $new_url = $arr_link[0] . "watch?v=" . $sep_slash[1];
    $sep = explode("/", $new_url);
    //dd($sep);
    $sec = explode(".", $sep[2]);
    //dd($sec);
    
    $update_url = $sep[0] . "//" . $sep[1] . $sec[0] . ".ss" . $sec[1] . "." . $sec[2] . "/" . $sep[3];
    //dd($lesson_details[0]['platform_link'] . "    " . $new_url);

    $myApiKey = ''; 
    $googleApi = 
        'https://www.googleapis.com/youtube/v3/videos?id='
        . $sep_slash[1] . '&key=' . $myApiKey . '&part=statistics';

    /* Create new resource */
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    /* Set the URL and options  */
    curl_setopt($ch, CURLOPT_URL, $googleApi);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    /* Grab the URL */
    $curlResource = curl_exec($ch);

    /* Close the resource */
    curl_close($ch);

    $youtubeData = json_decode($curlResource);

    $view_count = $youtubeData->items[0]->statistics->viewCount;
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

  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">

  <link rel="stylesheet" href="{{asset('fonts/flaticon/font/flaticon.css')}}">

  <link rel="stylesheet" href="{{asset('css/aos.css')}}">
  <link href="{{asset('css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>

  <style>
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

    .card-no-border .card {
      border: 0px;
      border-radius: 4px;
      -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
      box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05)
    }

    .card-body {
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 1.25rem
    }

    .comment-widgets .comment-row:hover {
      background: rgba(0, 0, 0, 0.02);
      cursor: pointer;
    }

    .comment-widgets .comment-row {
      border-bottom: 1px solid rgba(120, 130, 140, 0.13);
      padding: 15px;
    }

    .comment-text:hover {
      visibility: hidden;
    }

    .comment-text:hover {
      visibility: visible;
    }

    .label {
      padding: 3px 10px;
      line-height: 13px;
      color: #ffffff;
      font-weight: 400;
      border-radius: 4px;
      font-size: 75%;
    }

    .round img {
      border-radius: 100%;
    }

    .label-info {
      background-color: #1976d2;
    }

    .label-success {
      background-color: green;
    }

    .label-danger {
      background-color: #ef5350;
    }

    .action-icons a {
      padding-left: 7px;
      vertical-align: middle;
      color: #99abb4;
    }

    .action-icons a:hover {
      color: #1976d2;
    }

    .mt-100 {
      margin-top: 100px
    }

    .mb-100 {
      margin-bottom: 100px
    }
    
  </style>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    {{ View::make('header') }}

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
      style="background-image: url('{{asset('images/bg_1.jpg')}}')">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-7">
            <h2 class="mb-0">{{ $lesson_details[0]['lesson_name'] }}</h2>
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
          </div>
        </div>
      </div>
    </div>


    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="/">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="courses.html">Courses</a>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-4">
            <p>
              <!-- <img src="{{asset('public/image/'.$lesson_details[0]['lesson_thumbnail'])}}" alt="Image" class="img-fluid"> -->
              <!-- <iframe width="580" height="360" src="{{asset('public/vedios/'.$lesson_details[0]['lesson_vedio_link'])}}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe> -->
              
              @if($lesson_details[0]['lesson_vedio_link'] != "N")
                <video width="580" height="370" id="video" controls>
                  <source src="{{asset('public/vedios/'.$lesson_details[0]['lesson_vedio_link'])}}" type="video/mp4" id="video-for-play-count">
                </video>
                <div class="card" style="width: 580px;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-7">
                        <svg style="float: right; margin-top: 8px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                          <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                          <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                      </div>
                      <div class="col-5">
                        View Count :- {{ $viewCount }}
                      </div>
                    </div>
                  </div>
                </div>
              @else
                <iframe width="580" height="370"
                  src="{{ $lesson_details[0]['platform_link'] }}">
                </iframe>
                <div class="card" style="width: 580px;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-7">
                        <svg style="float: right; margin-top: 8px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                          <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                          <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                      </div>
                      <div class="col-5">
                        View Count :- {{ $view_count }}
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </p>
          </div>
          <div class="col-lg-5 ml-auto align-self-center" style="padding-left: 50px;">
            <h2 class="section-title-underline mb-5">
              <span>Lesson Details</span>
            </h2>
            <p><strong class="text-black d-block">Teacher:</strong>{{ $lesson_details[0]['username'] }}</p>
            <!-- <p class="mb-5"><strong class="text-black d-block">Hours:</strong> 8:00 am &mdash; 9:30am</p> -->
            <!-- <p><strong class="text-black d-block">Teacher:</strong> </p> -->
            <!-- <p class="mb-5"><strong class="text-black d-block">Hours:</strong> 8:00 am &mdash; 9:30am</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At itaque dolore libero corrupti! Itaque, delectus?</p>
                        <p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum totam facere.</p> -->
            
            @if ($lesson_details[0]['platform_link'] != "N")
              <div>
                <a href="{{ $update_url }}" target="_blank"
                  class="btn btn-primary">Download Lesson</a>
              </div>
            @else
              <div>
                <a href="{{asset('public/vedios/'.$lesson_details[0]['lesson_vedio_link']) }}" target="_blank"
                  class="btn btn-primary">Download Lesson</a>
              </div>
            @endif

            <!-- <ul class="ul-check primary list-unstyled mb-5">
                            <li>Lorem ipsum dolor sit amet consectetur</li>
                            <li>consectetur adipisicing  </li>
                            <li>Sit dolor repellat esse</li>
                            <li>Necessitatibus</li>
                            <li>Sed necessitatibus itaque </li>
                        </ul> -->

            <!-- <p>
                            <a href="#" class="btn btn-primary rounded-0 btn-lg px-5">Enroll</a>
                        </p> -->

          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lesson Materials</h4>
                <h6 class="card-subtitle">You can get All teh Lecture Materials Here</h6>
                <div class="row mt-3">
                  @foreach ($lessonDocuments as $document)
                      <?php
                        $path_parts = pathinfo( $document['document_name'], PATHINFO_EXTENSION);
                      ?>
                      <div class="col-3 text-center">
                        <div class="card">
                          <div class="card-body">
                            @if ($path_parts == "docx")
                              <img src="{{asset('doctypes/doc.png')}}" alt="" style="width: 200px; height: 200px;">
                              <div class="mt-3">
                                {{ $document['document_title'] }}
                                <a href="{{asset('public/documents/'.$document['document_name']) }}" class="btn btn-success btn-sm" style="color: white">Download Document</a>
                              </div>
                            @elseif ($path_parts == "pdf")
                              <img src="{{asset('doctypes/pdf.png')}}" alt="" style="width: 200px; height: 200px;">
                              <div class="mt-3">
                                {{ $document['document_title'] }}
                                <a href="{{asset('public/documents/'.$document['document_name']) }}" class="btn btn-success btn-sm" style="color: white">Download Document</a>
                              </div>
                            @endif
                          </div>
                        </div>
                      </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 mt-3">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lesson Summery</h4>
                <h6 class="card-subtitle">You can generate Lesson Summery here</h6>
                <div class="row">
                  <div class="col-12">
                    <form action="/generate" class="form-group" method="post">
                      @csrf
                      <input type="hidden" name="lessonId" value="{{ $lesson_details[0]['lesson_id'] }}">
                      <input type="hidden" name="lessonLink" value="public/public/vedios/{{$lesson_details[0]['lesson_vedio_link']}}">
                      <input type="submit" class="btn btn-primary mt-3" value="Generate Lesson Summery">
                    </form>
                      @if(Session()->get('decoded_summery'))
                        <div>
                          <textarea style="width: 100%" name="" id="loading" cols="30" rows="10" onclick="this.select()">{{ Session()->get('decoded_summery') }}</textarea>
                        </div>
                      @endif
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- feedback form begin -->

        <div class="d-flex justify-content-center mt-5 mb-100">
          <div class="row">
            <div class="col-md-6 col-sm-12">

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Comments</h4>
                  <h6 class="card-subtitle">Latest Comments section by users</h6>
                  <hr>
                </div>

                @foreach($all_comments as $each_comment)
                <div class="comment-widgets m-b-20">

                  <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="https://i.imgur.com/uIgDDDd.jpg" alt="user"
                          width="50"></span></div>
                    <div class="comment-text w-100" style="margin-top: -10px">
                      <span class="date">{{ $each_comment['created_at']->toDateString() }}</span>
                      <h5>{{ $each_comment['display_name'] }}</h5>
                      <div class="comment-footer" style="margin-top: -10px;">
                        <span>{{ $each_comment['email_address'] }}</span>
                      </div>
                      <p class="m-b-5 m-t-10">{{ $each_comment['message'] }}</p>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Post Comment</h4>
                  <h6 class="card-subtitle">Provide Your Name and Email and Message</h6>
                  <hr>
                  <form action="/post_comment" class="form-group">
                    <div class="row">
                      <div class="col-12">
                        <label for="name">Enter Display Name Here</label>
                        <input type="text" class="form-control" name="username" value="{{ Session()->get('teacherStatus') != null ? Session()->get('teacherStatus')['username'] : Session()->get('member')['username'] }}">
                      </div>
                      <div class="col-12">
                        <label for="name">Enter Email Here</label>
                        <input type="text" class="form-control" name="email" value="{{ Session()->get('teacherStatus') != null ? Session()->get('teacherStatus')['email'] : Session()->get('member')['email'] }}">
                      </div>
                      <div class="col-12">
                        <label for="name">Enter Your Message Here</label>
                        <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
                      </div>
                      <div class="col-12 mt-3">
                        <input type="hidden" name="lessonId" value="{{ $lesson_details[0]['lesson_id'] }}">
                        <input type="submit" class="btn btn-success" value="Post Comment" style="width: 100%;">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosphy</h3>
            <!-- <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p> -->
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Academics Principle</h3>
            <!-- <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                Dolore, amet reprehenderit.</p> -->
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Key of Success</h3>
            <!-- <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
                Dolore, amet reprehenderit.</p> -->
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
    <input type="hidden" id="userId" value="{{ $userId }}">

  </div>
  <!-- .site-wrap -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#51be78" />
    </svg></div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  
  <script>
    document.getElementById('video').addEventListener('ended',onCalculateViewCount,false);
    function onCalculateViewCount(e) {
      var d = window.location.pathname;
      var g = d.split("/")
      var lessonId = g[2];
      var userId = document.getElementById("userId").value;
      
      let url = "{{ route('test', ':id') }}";
      url = url.replace(':id', lessonId);
      document.location.href=url;
    }
  </script>
  <script>
    function setLoading() {
      document.getElementById("loading").value = "Loading...";
    }
  </script>
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('js/jquery-ui.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('js/aos.js')}}"></script>
  <script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('js/jquery.sticky.js')}}"></script>
  <script src="{{asset('js/jquery.mb.YTPlayer.min.js')}}"></script>




  <script src="{{asset('js/main.js')}}"></script>

</body>

</html>