<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Formulario de registro</h1>

    <form id="form-city" method="POST" action="{{ route('forms.store') }}" enctype="multipart/form-data">
        @csrf

        <select name="city_id">
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>

        <input type="text" name="latitude" placeholder="Latitud">
        <input type="text" name="length" placeholder="Length">
        <input type="file" name="image">

        <button type="submit">Guardar</button>
    </form>

    @vite(['resources/js/forms/main.js'])
</body>
</html>