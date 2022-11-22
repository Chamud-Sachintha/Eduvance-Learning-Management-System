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
		<h2 class="mb-4">All Subjects</h2>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Class Grade</th>
                                <th>Assigned Teacher</th>
                                <th>Actions</th>
                            </tr>
                           
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject['id'] }}</td>
                                    <td>{{ $subject['name'] }}</td>
                                    <td>{{ $subject['class_id'] }}</td>
                                    <td>{{ $subject['username'] }}</td>
                                    
                                    <td>
                                        <a href="/update_subject/{{$subject['id']}}" class="btn btn-primary btn-sm">Update</a>
                                        <!-- <a href="/delete_subject/{{$subject['id']}}" class="btn btn-danger btn-sm">Delete</a> -->

                                        <a href = "delete_subject/{{ $subject['id'] }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <a href="/add_subject"> <- Back to Subjects Tab</a>
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