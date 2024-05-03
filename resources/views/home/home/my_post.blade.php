

<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.home.css')
</head>
<body>
    @include('home.home.header')

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ session()->get('message') }}
    </div>
    @endif



    @foreach ($data as $data )


    <div class="post_deg1">

        <img class="img_deg1" src="/postimage/{{ $data->image }}">
        <h4 class="post_tit"> {{ $data->title }}</h4>
        <p class="post_desc">{{ $data->description }}</p>
        <div class="mypost_date">On {{ $data->date }}</div>



        <a onclick="return confirm('Are you to delete this post?')" href="{{ url('my_post_delete',$data->id) }}" class="btn btn-danger">Delete</a>

        <a href="{{ url('post_update_page', $data->id ) }}" class="btn btn-primary"> Update</a>
    </div>

    @endforeach



    @include('home.home.footer')

</body>
</html>
