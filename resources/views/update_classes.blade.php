<!doctype html>
<html lang="en">

<head>
    <title>All Subjects</title>
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

    .fl-l {
        float: left !important;
        color: black;
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
                <h2 class="mb-4">Update Class Details</h2>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form class="text-center border border-light p-5" action="/update_class" method="post">
                                    @csrf
                                    @if(Session()->get('status') != '')
                                    <div class="col-md-12 alert alert-success" role="alert">
                                      {{Session()->get('status')}}
                                    </div>
                                    @endif
                                    <p class="h4 mb-4">Update Class Details</p>
                  
                                    <!-- <p>Join our mailing list. We write rarely, but only the best content.</p> -->
                  
                                    <!-- <p>
                                      <a href="" target="_blank">See the last newsletter</a>
                                  </p> -->
                  
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <input type="hidden" value="{{ $selected_classDetails['id'] }}" name="classId">
                                        <input type="text" placeholder="Class Name" name="className" class="form-control" value="{{ $selected_classDetails[0]['name'] }}">
                                    </div>
                  
                                    <div class="mb-3">
                                      <select name="teacherId" id="" class="form-control select">
                                        @foreach ($all_teachers as $teacher)
                                            @if($selected_classDetails[0]['username'] == $teacher['username'])
                                                <option value="{{ $teacher['id'] }}" selected>{{ $teacher['username'] }}</option>
                                            @else
                                                <option value="{{ $teacher['id'] }}">{{ $teacher['username'] }}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                    </div>
                  
                                    <!-- Sign in button -->
                                    <button class="btn btn-info btn-block" type="submit">Update Class Details</button>
                                  </form>
                                <a href="/add_subject">
                                    <- Back to Subjects Tab</a>
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