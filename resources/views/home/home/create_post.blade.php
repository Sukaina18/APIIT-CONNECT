<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.home.css')
</head>
<body>

    @include('sweetalert::alert')
    @include('home.home.header')


    <div class="div_deg">
        <h1 class="title_deg">Add Blog Post</h1>

    <form action="{{ url('user_post') }}" method="POST" enctype="multipart/form-data" >

        @csrf


            <div class="field_deg">
                <label class="labeldeg">Blog Title:</label>
                <input type="text" name="title">
            </div>

            <div field_deg>
                <label class="labeldeg"> Description: </label>
                <textarea name="description"></textarea>
            </div>

            <div field_deg>
                <label class="labelimg">Add Image</label>
                <input type="file" name="image">
            </div>

            <div >
                <label class="labeldeg">Created On:  </label>
                <input type="date" name="date">
            </div>



            <div class="btndeg">
                <input type="submit" value="Add Post">
            </div>



        </form>
    </div>


    @include('home.home.footer')

</body>
</html>
