<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMKN 65 Jakarta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h3>INI HOMEPAGE 65</h3>
    <ol>
        <li><a href="{{ url('/auth/siswa') }}">LOGIN SISWA</a></li>
        <li><a href="{{ url('/auth/guru') }}">LOGIN GURU</a></li>
    </ol>
    
</body>
</html>