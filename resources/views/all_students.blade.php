<!doctype html>
<html lang="en">
  <head>
  	<title>All Students</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  </head>
  <style>
    ::placeholder{
      color: black !important;
    }

    input[type="text"]{
      border: 1px solid black;
    }

    input[type="email"]{
      border: 1px solid black;
    }

    input[type="password"]{
      border: 1px solid black;
    }

    .fl-l{
      float: left !important;
      color: black;
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
		<h2 class="mb-4">All Students</h2>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Student Email</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($all_students as $each_student)
                              <tr>
                                <td>{{ $each_student['id'] }}</td>
                                <td>{{ $each_student['username'] }}</td>
                                <td>{{ $each_student['email'] }}</td>

                                <td>
                                    <a href="/update_student/{{ $each_student['id'] }}" class="btn btn-sm btn-primary">Update Student</a>
                                    <a href="/delete_student/{{ $each_student['id'] }}" class="btn btn-sm btn-danger" style="margin-left: 10px">Delete Student</a>
                                </td>
                                </tr>
                            @endforeach
                        </table>

                        <a href="/admin_board"> <- Back to Registration Tab</a>
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