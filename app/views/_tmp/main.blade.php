<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="stylesheet" href="{{ assets('css/spectre-exp.min.css') }}">
    <link rel="stylesheet" href="{{ assets('css/spectre-icons.min.css') }}">
    <link rel="stylesheet" href="{{ assets('css/spectre.min.css') }}">
    <link rel="stylesheet" href="{{ assets('css/custom.css') }}">

    <title>@yield('title')</title>
  </head>
  <body>

    @yield('content')

  
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ assets('js/custom.js') }}"></script>
  </body>
</html>