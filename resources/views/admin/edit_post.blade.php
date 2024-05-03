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
               {{  session()->get('message') }}}
                <button type="button" class="close" data-dismiss="alert
                " aria-hidden="true"></button>
            </div>

            @endif

            <div class="div_centerp">
                <h1 class="font_sizep adminheading ">Edit Post</h1>

            <form action="{{ url('update_post',$post->id)  }}" method="POST" enctype="multipart/form-data" >

                @csrf

                <div class="conto">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelp'>Post Title :</label>
                        </div>
                        <div class="col">
                            <input class="text_colorp admininput" type="text" name="title" value="{{ $post->title }}" required="">
                        </div>
                    </div>
                    </div>
                <div class="conto">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelp'>Description :</label>
                        </div>
                        <div class="col">
                            <input class="text_colorp admininput" type="text" name="description" value="{{ $post->description }}" required="">
                        </div>
                    </div>
                </div>
                <div class="conto">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelp'>Date :</label>
                        </div>
                        <div class="col">
                            <input class="text_colorp admininput" type="date" name="date" value="{{ $post->date }}"  required="">
                        </div>
                    </div>
                </div>

             <div class="conto">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelp'>Post By :</label>
                        </div>
                        <div class="col">
                            <input class="text_colorp admininput" type="text" name="creator" value="{{ $post->creator }}" required="">
                        </div>
                    </div>
                </div>

                {{-- <div class="conto">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelp'>Category :</label>
                        </div>
                        <div class="col">
                            <select class="text_colorp admininput" name="category" required="">
                                <option value="" selected="">Select Category</option>

                                @foreach ($category as $category )

                                <option value="{{$category->category_name }}">{{$category->category_name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}
                <div class="contep">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelep'>Current Post Image :</label>
                        </div>
                        <div class="col">
                            <img style="margin: auto; float: left;" height="100" width="100" src="/postimage/{{ $post->image }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="conto">
                    <div class="row">
                        <div class="col">
                            <label class='adminlabel labelp'>Change Product Image :</label>
                        </div>
                        <div class="col">
                            <div class="div admininput">
                                <input  classs='admininput' type="file" name="image" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="conto">
                    <input type="submit" value="Edit Post" class="btn btn-primary btnaddproduct">
                </div>
            </form>
            </div>
        </div>
    </div>
    @include('admin.script')
  </body>
</html>
