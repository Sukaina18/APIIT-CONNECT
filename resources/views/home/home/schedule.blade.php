<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.home.css')
</head>
<body>
    @include('home.home.header')


    <form action="{{ URL('/schedule') }}" method="POST">
        @csrf
        <label for='title'>{{ __('title') }}</label>
        <input type='text' class='form-control' id='title' name='title'>

        <label for="start">{{__('Start')}}</label>
        <input type='date' class='form-control' id='start' name='start' required value='{{ now()->toDateString() }}'>

        <label for="end">{{__('End')}}</label>
        <input type='date' class='form-control' id='end' name='end' required value='{{ now()->toDateString() }}'>


        <label for="description">{{__('Description')}}</label>
        <textarea id="description" name="description"></textarea>

        <label for="color">{{__('Color')}}</label>
        <input type="color" id="color" name="color" />

        <input type="submit" value="Save" class="btn btn-success" />
    </form>


    @include('home.home.footer')

</body>
</html>
