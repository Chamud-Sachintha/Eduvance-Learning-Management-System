<!doctype html>
<html lang="en">

<head>
    <title>Contact Details</title>
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

    input[type="file"] {
        border: 1px solid black;
    }

    .select {
        border: 1px solid black;
    }

    .fl-l {
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
                <h2 class="mb-4">Add Documents For Lessons</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="/upload-documents" class="form-group" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="documentTitle">Type Document Title :</label>
                                            <input type="text" class="form-control" placeholder="Eg. Lesson 1" name="documentTitle">
                                        </div>

                                        <div class="col-6">
                                            <label for="selectedLesson">Select Class Here :</label>
                                            <select name="classGrade" id="grade" class="form-control grade select">
                                                <option value="0">-- Select Class Here --</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="selectedLesson">Select Subject Here :</label>
                                            <select name="classSubject" id="subject" class="form-control subject select">
                                                <option value="0">-- Select Subject Here --</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label for="selectedLesson">Select Lesson Here :</label>
                                            <select name="lessonName" id="lesson" class="form-control select lesson">
                                                <option value="0" selected>---Select Lesson---</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="uploadDocument">Upload Document Here :</label>
                                            <div class="row">
                                                <div class="col-8">
                                                    <input type="file" class="form-control" name="fileName">
                                                </div>
                                                <div class="col-2">
                                                    <input type="submit" class="btn btn-primary" value="Add Document">
                                                </div>
                                                <div class="col-2">
                                                    <input type="reset" class="btn btn-primary" value="Reset Feilds">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <th>Lesson Title</th>
                                            <th>Doc Type</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        @foreach ($documents as $document)
                                            <tr>
                                                <td>{{ $document['document_title'] }}</td>
                                                <td>{{ $document['lesson_name'] }}</td>
                                                @if($document['document_name'])
                                                    <?php
                                                        $path_parts = pathinfo( $document['document_name'], PATHINFO_EXTENSION);
                                                    ?>

                                                    <td>{{ $path_parts }}</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="/delete-document/{{ $document['id'] }}" class="btn btn-danger btn-sm">Delete Document</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script>
    $(document).ready(function(){
      $(document).on('change', '.grade',function(){
        var elname = document.getElementById("subject");
        var elnameLesson = document.getElementById("lesson");
        
        for (i=0; i<elname.length;  i++) {
          if (elname.options[i]) {
            console.log(elname.remove(i));
            console.log(elnameLesson.remove(i));
            elname.remove(i);
            elnameLesson.remove(i);
          }
          console.log(elname.remove(i));
          console.log(elnameLesson.remove(i));
        }

        var class_id = $(this).val();
        var div = $(this).parent();
        var op = " ";

        $.ajax({
          type:'GET',
          url: "{{ URL::to('findSubjectsForDocumentAdd') }}",
          data:{'id': class_id},
          dataType:'json',
          success:function(data){
            // for(var i=0; i<data.length; i++){
            //   console.log(data[i]);
            // }
            // console.log("ok");
            // op += '<option value="0" selected disabled>--Select Subject</option>';
            var option = document.createElement("option");
            option.text = "--- select Subject ---";
            elname.appendChild(option);

            for(var i=0; i<data.length; i++){
              // op += '<option value="e">'+"k"+'</option>';
              var option = document.createElement("option");
              option.value = data[i].id;
              option.text = data[i].name;
              option.id = "option";
              elname.appendChild(option);
            }

            // div.find('.subjectname').html(" ");
            // div.find('.subjectname').append(op);
          },
          error:function(err){
            console.log(err);
          }
        });
      });
    });

    $(document).ready(function(){
      $(document).on('change','.subject',function(){
        var elname = document.getElementById("lesson");

        for (i=0; i<elname.length;  i++) {
          if (elname.options[i]) {
            console.log(elname.remove(i));
            elname.remove(i);
          }
        }

        var sub_id = $(this).val();
        var div = $(this).parent();
        var op = " ";

        $.ajax({
          type:'GET',
          url: "{{ URL::to('findLessonsForDocumentAdd') }}",
          data:{'id': sub_id},
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
              option.text = data[i].lesson_name;
              option.id = "option";
              elname.appendChild(option);
            }

            // div.find('.subjectname').html(" ");
            // div.find('.subjectname').append(op);
          },
          error:function(err){
            console.log(err);
          }
        });
      });
    });
  </script>
     <!-- <script src="{{asset('admin/js/jquery.min.js')}}"></script> -->
  <script src="{{asset('admin/js/popper.js')}}"></script>
  <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/js/main.js')}}"></script>
</body>
</html>