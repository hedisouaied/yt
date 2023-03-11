<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('frontend.layouts.head')

</head>

<body >

    <div class="main-wrapper">



        @include('frontend.layouts.header')

        @yield('content')


        @include('frontend.layouts.footer')






@include('frontend.layouts.script')

</body>
</html>
