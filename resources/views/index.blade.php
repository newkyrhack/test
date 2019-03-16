<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="web-token" content="{{ env('APP_KEY') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" />
    <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet" /> 
    <title>Macasoft</title>
</head>
<body>
    <div id="app">
        <index/>
    </div>
</body>
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/filestyle/filestyle.min.js')}}"> </script>
</html>