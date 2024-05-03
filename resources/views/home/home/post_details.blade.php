<!DOCTYPE html>
<html lang="en">
<head>

    <base href="/public">
    @include('home.home.css')
</head>
<body>
    @include('home.home.header')

    <div class="col-md-12">
        <div class="ptby"> Posted By: <b>{{ $post->creator }}</b> </div>

        <div class="img-container">
            <img style=" ;" src="postimage/{{ $post->image }}" alt="">
        </div>
    <div class="post_date">On {{ $post->date }}</div>
        <div class="post_title2"> <b>{{ $post->title }}</b></div>

        <div  class="post-desc">
            <p>{{ $post->description }}</p>
        </div>


    </div>

    <livewire:comments :model="$post"/>
    
    @include('home.home.footer')
</body>
</html>

