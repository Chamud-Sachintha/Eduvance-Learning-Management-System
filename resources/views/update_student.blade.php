<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 03</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
</head>
<style>
    ::placeholder {
        color: black !important;
    }

    input[type="text"] {
        border: 1px solid black;
    }

    input[type="email"] {
        border: 1px solid black;
    }

    input[type="password"] {
        border: 1px solid black;
    }

    .select {
        border: 1px solid black;
    }
</style>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            {{View::make('admin_header')}}
            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5 pt-5">
                <h2 class="mb-4">Update Student</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Default form subscription -->
                                <form class="text-center border border-light p-5" action="/set_update_student" method="post">
                                    @csrf
                                    @if(Session()->get('status') != '')
                                    <div class="col-md-12 alert alert-success" role="alert">
                                        {{Session()->get('status')}}
                                    </div>
                                    @endif
                                    <p class="h4 mb-4">Update Student Details</p>

                                    <!-- <p>Join our mailing list. We write rarely, but only the best content.</p> -->

                                    <!-- <p>
                  <a href="" target="_blank">See the last newsletter</a>
              </p> -->

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <input type="text" placeholder="Username" name="username" class="form-control" value="{{ $selected_student[0]['username'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" placeholder="email" name="email" class="form-control" value="{{ $selected_student[0]['email'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="curPassword" value="{{ $selected_student[0]['password'] }}">
                                        <input type="password" placeholder="Password" name="pswd" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" placeholder="Confirm Password" name="con_pswd"
                                            class="form-control">
                                    </div>

                                    <!-- Sign in button -->
                                    <input type="hidden" name="studentId" value="{{ $selected_student[0]['id'] }}">
                                    <button class="btn btn-info btn-block" type="submit">Update Student</button>
                                </form>
                                <!-- Default form subscription -->
                                <a href="/show-all-students">Show All Registred Students -></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="{{asset('admin/js/jquery.min.js')}}"></script>
            <script src="{{asset('admin/js/popper.js')}}"></script>
            <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('admin/js/main.js')}}"></script>
</body>

</html>