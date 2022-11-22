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
        <h2 class="mb-4">Update Subject</h2>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!-- Default form subscription -->
                        <form class="text-center border border-light p-5" action="/set_update_sub" method="post">
                        @csrf
                        @if(Session()->get('status') != '')
                            <div class="col-md-12 alert alert-success" role="alert">
                            {{Session()->get('status')}}
                            </div>
                        @endif
                        <p class="h4 mb-4">Update Subject Details</p>
            
                        <p>Join our mailing list. We write rarely, but only the best content.</p>
            
                        <p>
                            <a href="" target="_blank">See the last newsletter</a>
                        </p>

                        <div class="mb-3">
                            <label for="teacher_id" class="fl-l">Select Teacher ID -</label>
                            <select name="teacher_id" id="" class="form-control" style="border: 1px solid black;">
                            <option value="{{ $selectedSubject[0]['teacher_id'] }}">{{ $selectedSubject[0]['teacher_id'] }}</option>
                            @foreach($allTeachers as $each_teacher)
                                @if($each_teacher['id'] == $selectedSubject[0]['teacher_id'])
                                  @continue
                                @else
                                  <option value="{{ $each_teacher['id'] }}">{{ $each_teacher['id'] }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="fl-l">Select Grade -</label>
                            <select name="class_id" id="" class="form-control" style="border: 1px solid black;">
                            <option value="{{ $selectedSubject[0]['class_id'] }}">{{ $selectedSubject[0]['class_id'] }}</option>
                            @foreach($allClasses as $each_class)
                                @if($each_class['id'] == $selectedSubject[0]['class_id'])
                                  @continue
                                @else
                                  <option value="{{ $each_class['id'] }}">{{ $each_class['id'] }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="subject_Id" value="{{$selectedSubject[0]['id']}}">
                            <input type="text" placeholder="Subject Name" name="subjectName" class="form-control" value="{{$selectedSubject[0]['name']}}">
                        </div>
            
                        <!-- Sign in button -->
                        <button class="btn btn-info btn-block" type="submit">Update Subject</button>
                        </form>
                        <!-- Default form subscription -->

                        <a href="/show_all_subjects">Back to The All Subjects -></a>
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