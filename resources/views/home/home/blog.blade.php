<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.home.css')
</head>

<body>
    @include('home.home.header')

    <div class="container-fluid productscontainer p-4">
        <div class="row productsheadrow p-4">
            <div class="col">
                <h1 class="blogposthead">Blog Posts</h1>
                <p class="blogposthead2">Discover Every Experience</p>
            </div>

            <div class="row productsfootrow">





                <div class="row">

                    @foreach ($post as $post)
                        <div class="col col-xs-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <div class="post_img1">
                                <img src="postimage/{{ $post->image }}" alt="">
                            </div>

                            <div class="post_title1"><b>{{ $post->title }}</b></div>

                            {{-- <div class="size">
                        <h6>{{ $post->description }}</h6>
                    </div> --}}

                            <div class="pt_date"> {{ $post->date }}</div>
                            <h6>Posted By: <b>{{ $post->creator }}</b> </h6>


                            <div class="btn_main">
                                <a href="{{ url('post_details', $post->id) }}" class="btn_read_more">Read More</a>
                            </div>

                        </div>
                    @endforeach

                    
                </div>

            </div>
        </div>

        @include('home.home.footer')
</body>

</html>
