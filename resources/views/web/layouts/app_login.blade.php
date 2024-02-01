<!DOCTYPE html>
<html lang="en">
<!-- head -->
<head>
    @include('web.includes.head')
    @yield('style')
</head>
<!-- /.head -->

<body>
    <!-- theme layout -->
    <div class="theme-layout">

        <!-- first section block -->
        <section> 
            <!-- left section -->
            @yield('content')
            <!-- /. left section -->
        </section>
        <!-- /.first section block -->

        <!-- footer -->
        @yield('footer')
        <!-- /. footer -->

    </div>
    <!-- /. theme-layout -->

    <!-- scripts -->
    @include('web.includes.scripts')
    @yield('script')
    <!-- /. script -->
</body>
</html>