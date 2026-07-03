<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/forms/main.js'])
</head>
<body>
    <div class="container-fluid">
        <div class="list-form">
        <h1>{{ __('forms.forms.title') }}</h1>

        <form id="form-city" method="POST" action="{{ route('forms.store') }}" enctype="multipart/form-data">
            @csrf
            <select name="city_id">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ __('forms.forms.select-city') }}</option>
                @endforeach
            </select>
            <input type="text" name="latitude" placeholder="{{ __('forms.forms.latitude') }}">
            <input type="text" name="length" placeholder="{{ __('forms.forms.length') }}">
            <input type="file" name="image">
            <button type="submit">{{ __('global.buttons.save') }}</button>
        </form>
        </div>
    </div> 
</body>
</html>