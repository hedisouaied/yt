<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.layouts.head')
</head>
<body>
@include('backend.layouts.sidebar')
@include('backend.layouts.nav')
@yield('content')
@include('backend.layouts.footer')
</body>
</html>
