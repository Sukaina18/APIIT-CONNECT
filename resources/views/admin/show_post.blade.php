<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>

@include('admin.sidebar')
@include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            </div>
        @endif

        <h2 class="font_sizesp adminheading2">Posts</h2>
        <div>
            <form action="{{ url('search') }}" method="get">
                @csrf
                <input type="text" class="icolor" name="search" placeholder="Search Post">
                <input type="submit" value="Search" class="btn btn-outline-primary">
            </form>
        </div>
        <table class="centersp">
            <tr class="th_colorsp table-header2">
                <th class="header__item">Title</th>
                <th class="header__item">Description</th>
                 <th class="header__item">Post by</th>
                <th class="header__item">Date</th>
                <th class="header__item">Usertype</th>
                <th class="header__item">Image</th>
                <th class="header__item">Post Status</th>
                <th class="header__item">Delete</th>
                <th class="header__item">Edit</th>



            </tr>

            @foreach ($post as $post)
                <tr class="table-header">
                    <td class="table-data">{{ $post->title }}</td>
                    <td class="table-data">{{ $post->description }}</td>
                    <td class="table-data">{{ $post->name }}</td>
                    <td class="table-data">{{ $post->date }}</td>
                    <td class="table-data">{{ $post->usertype }}</td>
                    <td class="table-data">
                        <img class="img_sizesp" src="/postimage/{{ $post->image }}" alt="">
                    </td>
                    <td class="table-data">Active</td>
                    <td class="table-data">
                        <a class="btn btn-danger" onclick="return confirm('Confirm To Delete This Record!')" href="{{ url('delete_post', $post->id) }}">Delete</a>
                    </td>
                    <td class="table-data">
                        <a class="btn btn-success" onclick="return confirm('Confirm To Edit This Record!')" href="{{ url('edit_post', $post->id) }}">Edit</a>
                    </td>

                </tr>
            @endforeach

        </table>
    </div>
</div>
@include('admin.script')
</body>
</html>
