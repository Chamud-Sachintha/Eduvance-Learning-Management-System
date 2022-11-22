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

    input[type="file"]{
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
        <h2 class="mb-4">Update Lesson</h2>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!-- Default form subscription -->
                        <form class="text-center border border-light p-5" action="/set_update_lesson" method="post">
                        @csrf
                        @if(Session()->get('status') != '')
                            <div class="col-md-12 alert alert-success" role="alert">
                            {{Session()->get('status')}}
                            </div>
                        @endif
                        <p class="h4 mb-4">Update Lesson</p>
            
                        <p>Join our mailing list. We write rarely, but only the best content.</p>
            
                        <p>
                            <a href="" target="_blank">See the last newsletter</a>
                        </p>
                            
                        <div class="mb-3">
                              <label for="classGrade" style="float: left; color: black;">Select Grade</label>
                              <select name="classGrade" id="grade" class="form-control grade" style="border: 1px solid black;">
                                  <option value="{{ $selected_lesson[0]['class_id'] }}">{{ $selected_lesson[0]['name'] }}</option>
                                  @foreach($all_classes as $eachClass)
                                      @if($eachClass['id'] === $selected_lesson[0]['class_id'])
                                        @continue
                                      @else
                                        <option value="{{ $eachClass['id'] }}">{{ $eachClass['name'] }}</option>
                                      @endif
                                  @endforeach
                              </select>
                            </div>

                            <div class="mb-3">
                                <label for="subjectName" style="float: left; color: black;">Select Subject</label>
                                <select name="subjectName" id="subname" class="form-control subjectname" style="border: 1px solid black;">
                                  <option value="{{ $selected_lesson[0]['sub_id'] }}">{{ $selected_lesson[0]['sub_name'] }}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input type="text" value="{{ $selected_lesson[0]['lesson_name'] }}" placeholder="Lesson Name" class="form-control" name="lessonName">
                            </div>

                            <div class="mb-3">
                                <label for="" style="float: left; color: black;">Choose Thumbnail For Vedio</label>
                                <input type="hidden" name="currentImage" value="{{$selected_lesson[0]['lesson_thumbnail']}}">
                                <input type="file" class="form-control" name="lessonThumbnail">
                            </div>

                            <div class="mb-3">
                                <input type="hidden" name="lesson_id" value="{{$selected_lesson[0]['id']}}">
                                <input type="hidden" name="checkStatusV" value="{{$selected_lesson[0]['lesson_vedio_link']}}">
                                <input type="hidden" name="checkStatusL" value="{{$selected_lesson[0]['platform_link']}}">
                                @if($selected_lesson[0]['lesson_vedio_link'] === "N")
                                  <input type="text" value="{{ $selected_lesson[0]['platform_link'] }}" placeholder="Enter Vedio Link Here" name="platform_link" class="form-control">
                                @else
                                  <input type="file" value="{{ $selected_lesson[0]['lesson_vedio_link'] }}" placeholder="Enter Vedio Link Here" name="lessonLink" class="form-control">
                                @endif
                            </div>
                
                            <!-- Sign in button -->
                            <button class="btn btn-info btn-block" type="submit">Update Lesson</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script>
    $(document).ready(function(){
      $(document).on('change', '.grade',function(){
        var elname = document.getElementById("subname");
        
        for (i=0; i<elname.length;  i++) {
          if (elname.options[i]) {
            elname.remove(i);
          }
        }

        var class_id = $(this).val();
        var div = $(this).parent();
        var op = " ";

        $.ajax({
          type:'GET',
          url: "{{ URL::to('findSubjects') }}",
          data:{'id': class_id},
          dataType:'json',
          success:function(data){
            // for(var i=0; i<data.length; i++){
            //   console.log(data[i]);
            // }
            // console.log("ok");
            // op += '<option value="0" selected disabled>--Select Subject</option>';

            for(var i=0; i<data.length; i++){
              // op += '<option value="e">'+"k"+'</option>';

              var option = document.createElement("option");
              option.value = data[i].id;
              option.text = data[i].name;
              option.id = "option";
              elname.appendChild(option);
            }

            //div.find('.subjectname').html(" ");
            // div.find('.subjectname').append(op);
          },
          error:function(){
            console.log("not");
          }
        });
      });
    });
  </script>

  <script src="{{asset('admin/js/popper.js')}}"></script>
  <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/js/main.js')}}"></script>
  </body>
</html>