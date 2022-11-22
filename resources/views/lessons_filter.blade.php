<div class="row">
    @foreach($lessons as $lesson)
        <div class="col-md-3 mt-4" style="margin: -5px !important">
        <div class="card profile-card-5">
            <div class="card-img-block">
                <img class="card-img-top" src="{{asset('public/image/'.$lesson['lesson_thumbnail'])}}" alt="Card image cap">
            </div>
            <div class="card-body pt-0 text-center">
                <h4 class="card-title">{{ $lesson['name'] }}</h5>
                <h5 class="card-title">{{ $lesson['lesson_name'] }}</h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                
                <a href="/lesson/{{$lesson['id']}}" class="btn btn-primary btn-sm">Explore</a>
            </div>
            </div>
        </div>
    @endforeach
</div>