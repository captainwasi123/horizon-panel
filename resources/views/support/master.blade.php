<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') | Horizon</title>
    <meta name="description" content="" />

    <!-- Style Panel -->
      @include('support.style')
    <!-- /Style Panel -->
    @yield('addStyle')
</head>

<body>
    <!-- Preloader 
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    --><!-- /Preloader -->
  
  <!-- HK Wrapper -->
  <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        @include('support.topnav')
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        @include('support.sidebar')
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        @include('support.setting')
        <!-- /Setting Panel -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
          @yield('content')
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- Script Panel -->
      @include('support.script')

      @yield('addScript')

    @if (session()->has('error'))
        <script type="text/javascript">
            $.toast({
                text: "<i class='jq-toast-icon glyphicon glyphicon-ok'></i><p><strong>Alert.! </strong> &nbsp;{{session()->get('error')}}</p>",
                position: 'top-center',
                loaderBg:'#7a5449',
                class: 'jq-has-icon jq-toast-danger',
                hideAfter: 3500, 
                stack: 6,
                showHideTransition: 'fade'
            });
        </script>
    @endif
    <!-- /Script Panel -->
  
</body>
</html>