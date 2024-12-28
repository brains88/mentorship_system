<!-- Include Header -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keyword" content="Ramom  Home Page">
    <meta name="description" content="Mentorship - Student Mentorship System">
    <title>Home - Student Mentorship System</title>
    <!-- Bootstrap -->
    <link href="assets/assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template CSS Files  -->
    <link rel="stylesheet" href="assets/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/assets/frontend/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/assets/frontend/css/responsive.css">
    <link rel="stylesheet" href="assets/assets/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/assets/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/assets/vendor/sweetalert/sweetalert-custom.css">
    <link rel="stylesheet" href="assets/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.css">
    <link rel="stylesheet" href="assets/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="assets/assets/frontend/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/assets/frontend/css/style.css">
    <script src="assets/assets/vendor/jquery/jquery.min.js"></script>
    <!-- If user have enabled CSRF proctection this function will take care of the ajax requests and append custom header for CSRF -->


    <!-- Web Application Manifest -->
    <link rel="manifest" href="manifest.json">
    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#6e8fd4">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Ramom School">
    <link rel="icon" sizes="512x512" href="assets/assets/uploads/appIcons/icon-512x512.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Ramom School">
    <link rel="apple-touch-icon" href="assets/assets/uploads/appIcons/icon-512x512.png">

    <script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '/'
        }).then(function(registration) {
            // Registration was successful
        }, function(err) {
            // registration failed :(
            console.log('Service Worker registration failed: ', err);
        });
    }
    </script>

    <!-- Theme Color Options -->
    <script type="text/javascript">
    document.documentElement.style.setProperty('--thm-primary', '#4CAF50');
    document.documentElement.style.setProperty('--thm-hover', '#f04133');
    document.documentElement.style.setProperty('--thm-text', '#232323');
    document.documentElement.style.setProperty('--thm-secondary-text', '#383838');
    document.documentElement.style.setProperty('--thm-footer-text', '#8d8d8d');
    document.documentElement.style.setProperty('--thm-radius', '0');
    </script>
</head>

<body>

    <!-- Header Starts -->
    <header class="main-header">
        <!-- Nested Container Starts -->
        <!-- Navbar Starts -->
        <div class="stricky" id="strickyMenu" style="background-color: #fff;">
            <div class="container-md px-md-0">
                <nav id="nav" class="navbar navbar-expand-lg" role="navigation">
                    <div class="container-md px-md-0">
                        <!-- Logo Starts -->
                        <a href="{{route('home')}}" class="navbar-brand mt-3">
                            <h4>Mentorship<h4>
                        </a>
                        <!-- Logo Ends -->
                        <!-- Collapse Button Starts -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fa fa-bars"></span>
                        </button>
                        <!-- Collapse Button Ends -->
                        <!-- Navbar Collapse Starts -->
                        <div id="mainNav" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav ml-auto navbar-style3">
                                <li class="nav-item">
                                    <a href="{{route('home')}}" class="nav-link">Home </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('register')}}" class="nav-link">Register </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="nav-link">Login </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Navbar Collapse Ends -->
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar Ends -->
    </header>
