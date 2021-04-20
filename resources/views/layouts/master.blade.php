<!DOCTYPE html>
<html lang="tr_TR" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    {!! SEOMeta::generate() !!}
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">
    <!-- css -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendor/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="../vendor/photoswipe/default-skin/default-skin.css">
    <link rel="stylesheet" href="../vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- font - fontawesome -->
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css">
    <!-- font - stroyka -->
    <link rel="stylesheet" href="../fonts/stroyka/stroyka.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</head>

<body>
    <!-- site -->
    <div class="site">
        <!-- mobile site__header -->
        @include("layouts.partials.mobileheader")
        <!-- mobile site__header / end -->

        <!-- desktop site__header -->
        @include("layouts.partials.desktopheader")
        <!-- desktop site__header / end -->

        <!-- site__body -->
        @yield('content')
        <!-- site__body / end -->

        <!-- site__footer -->
        @include("layouts.partials.footer")
        <!-- site__footer / end -->
    </div>
    <!-- site / end -->

<!-- quickview-modal -->
<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content"></div>
    </div>
</div>
<!-- quickview-modal / end -->

<!-- mobilemenu -->
@include("layouts.partials.mobilemenu")
<!-- mobilemenu / end -->

<!-- photoswipe -->
@include("layouts.partials.photoswipe")
<!-- photoswipe / end -->

<!-- js -->
@include("layouts.partials.scripts")
<!-- js / end -->
{!! Toastr::message() !!}
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/59a532d0b6e907673de0a416/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
