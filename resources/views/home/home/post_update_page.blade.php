<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.home.css')
</head>
<body>
    @include('home.home.header')

<div class="divdegupdate">

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{ session()->get('message') }}
    </div>
    @endif

    
    <h1 class="titdegupdate">Update Post</h1>
    <form action="{{ url('post_update_page_data', $data->id) }}" method="POST" enctype="multipart/form-data" >

        @csrf

        <div class="updatepostinput">
            <label class="updatepostlabel" >Title</label>
            <input type="text" name="title" value="{{ $data->title }}">
        </div>

        <div class="updatepostinput">
            <label class="updatepostlabel">Description</label>
            <textarea name="description" value="{{ $data->description }}"></textarea>
        </div>

        <div class="updatepostinput">
            <label class="updatepostlabel"> Current Image</label>
            <img class="postupdate-img" src="/postimage/{{ $data->image }}">
        </div>

        <div class="updatepostinput">
            <label class="updatepostlabel">Change Current Image</label>
            <input type="file" name="image">
        </div class="updatepostinput">

        <div class="updatepostinput">
            <label class="updatepostlabel">Date</label>
            <input type="date" name="date">
        </div class="updatepostinput">
        <input class="btn-updatepost" type="submit" class="btn btn-outline-primary">

    </form>
</div>


    @include('home.home.footer')

</body>
</html>
