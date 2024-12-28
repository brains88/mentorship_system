<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keyword" content="Ramom  Home Page">
    <meta name="description" content="Ramom - School Management ERP System With CMS">
    <!-- Favicon -->
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
    <!-- Preloader -->
    <div class="loader-container">
        <div class="lds-dual-ring"></div>
    </div>

    <!-- Header Starts -->
    <!-- Header Starts -->
    <header class="main-header">
        <!-- Nested Container Starts -->
        <!-- Navbar Starts -->
        <div class="stricky" id="strickyMenu" style="background-color: #fff;">
            <div class="container-md px-md-0">
                <nav id="nav" class="navbar navbar-expand-lg" role="navigation">
                    <div class="container-md px-md-0">
                        <!-- Logo Starts -->
                        <a href="{{route('home')}}" class="navbar-brand">
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

    <div class="latest--news" style="background-color:#4CAF50; color:white;">
        <div class="container">
            <div class="d-lg-flex align-items-center">
                <div class="current-date text-nowrap text-white">
                    <span class="date-now"><i class="fa-regular fa-clock"></i> <span id="currentDate"></span></span>
                </div>
            </div>
        </div>
    </div>


    <!-- Main Slider Section Starts -->
    <section class="main-slider">
        <div class="container-fluid">
            <ul class="main-slider-carousel owl-carousel owl-theme slide-nav">
                <!-- Slide 1 -->
                <li class="slider-wrapper">
                    <div class="image" style="background-image: url('assets/img/mentorship/mentorship1.jpeg')"></div>
                    <div class="slider-caption c-left">
                        <div class="container">
                            <div class="wrap-caption">
                                <h1>Welcome to <span>Our University Mentorship System</span></h1>
                                <div class="text center">Connect with experienced mentors to guide you on your academic
                                    and career journey.</div>
                                <div class="link-btn">
                                    <a href="{{route('register')}}" class="btn">Choose A Mentor</a>
                                    <a href="{{route('login')}}" class="btn btn1">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-overlay"></div>
                </li>

                <!-- Slide 2 -->
                <li class="slider-wrapper">
                    <div class="image" style="background-image: url('assets/img/mentorship/mentorship2.jpg')"></div>
                    <div class="slider-caption c-left">
                        <div class="container">
                            <div class="wrap-caption">
                                <h1><span>Find Your Ideal Mentor</span> Today</h1>
                                <div class="text center">Learn from experts in your field and achieve your goals with
                                    personalized guidance.</div>
                                <div class="link-btn">
                                    <a href="{{route('register')}}" class="btn">Choose A Mentor</a>
                                    <a href="{{route('login')}}" class="btn btn1">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-overlay"></div>
                </li>

                <!-- Slide 3 -->
                <li class="slider-wrapper">
                    <div class="image" style="background-image: url('assets/img/mentorship/mentorship3.jpg')"></div>
                    <div class="slider-caption c-left">
                        <div class="container">
                            <div class="wrap-caption">
                                <h1><span>Join a Supportive</span> Mentorship Community</h1>
                                <div class="text center">Collaborate with mentors and peers to enhance your academic
                                    success.</div>
                                <div class="link-btn">
                                    <a href="{{route('register')}}" class="btn">Choose A Mentor</a>
                                    <a href="{{route('login')}}" class="btn btn1">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-overlay"></div>
                </li>

                <!-- Slide 4 -->
                <li class="slider-wrapper">
                    <div class="image" style="background-image: url('assets/img/mentorship/mentorship4.jpg')"></div>
                    <div class="slider-caption c-left">
                        <div class="container">
                            <div class="wrap-caption">
                                <h1><span>Enhance Your Skills</span> with Expert Advice</h1>
                                <div class="text center">Develop skills for academic and professional excellence through
                                    mentorship.</div>
                                <div class="link-btn">
                                    <a href="{{route('register')}}" class="btn">Choose A Mentor</a>
                                    <a href="{{route('login')}}" class="btn btn1">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-overlay"></div>
                </li>

                <!-- Slide 5 -->
                <li class="slider-wrapper">
                    <div class="image" style="background-image: url('assets/img/mentorship/mentorship5.jpg')"></div>
                    <div class="slider-caption c-left">
                        <div class="container">
                            <div class="wrap-caption">
                                <h1><span>Shape Your Future</span> with Us</h1>
                                <div class="text center">Take the first step towards achieving your dreams with
                                    dedicated mentorship.</div>
                                <div class="link-btn">
                                    <a href="{{route('register')}}" class="btn">Choose A Mentor</a>
                                    <a href="{{route('login')}}" class="btn btn1">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide-overlay"></div>
                </li>
            </ul>

        </div>
    </section>
    <div class="container px-md-0 main-container">
        <!-- Features Section Starts -->
        <div class="notification-boxes row">
            <!-- Feature 1 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="box hover-border-outer hover-border">
                    <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h4>Personalized Mentorship</h4>
                    <p>Get one-on-one guidance from experienced mentors to excel academically and professionally.</p>
                </div>
            </div>
            <!-- Feature 2 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="box hover-border-outer hover-border">
                    <div class="icon"><i class="fas fa-user-friends"></i></div>
                    <h4>Community Support</h4>
                    <p>Join a vibrant community of mentors and mentees, sharing knowledge and opportunities.</p>
                </div>
            </div>
            <!-- Feature 3 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="box hover-border-outer hover-border">
                    <div class="icon"><i class="fas fa-laptop-code"></i></div>
                    <h4>Skill Development</h4>
                    <p>Access resources and training to build skills for academic and career advancement.</p>
                </div>
            </div>
            <!-- Feature 4 -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="box hover-border-outer hover-border">
                    <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                    <h4>Career Advancement</h4>
                    <p>Work with mentors to explore career paths and achieve your professional goals.</p>
                </div>
            </div>
        </div>

        <!-- Welcome Section Starts -->
        <section class="welcome-area">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h2 class="main-heading1 lite" style="color: #000">Welcome to the Mentorship Hub</h2>
                    <div class="sec-title style-two mb-tt">
                        <h2 class="main-heading2">Empowering Your Future</h2>
                        <span class="decor"><span class="inner"></span></span>
                    </div>
                    Our mentorship program is designed to connect students with experienced professionals who are
                    passionate about guiding the next generation. Through personalized advice and structured guidance,
                    we help you achieve your academic and career aspirations.<br>
                    <br>
                    With access to a diverse network of mentors, you can explore opportunities, develop new skills, and
                    gain the confidence to tackle challenges. Join us today and take the first step towards a brighter
                    future.<br>
                    <br>
                    Discover the power of mentorship and unlock your potential through collaborative learning and shared
                    experiences. Let us help you shape the path to your success.
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="wel-img">
                        <img src="assets/img/mentorship/mentorship1.jpeg" alt="image" class="img-fluid w-100"
                            style="object-fit:cover">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        const now = new Date();
        document.getElementById("currentDate").textContent = now.toLocaleDateString('en-US', options).replace(
            / /g, '.');
    });
    </script>
    <a href="#" class="back-to-top"><i class="far fa-arrow-alt-circle-up"></i></a>
    <!-- JS Files -->
    <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/assets/frontend/js/bootstrap.min.js"></script>
    <script src="assets/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <script src="assets/assets/frontend/js/owl.carousel.min.js"></script>
    <script src="assets/assets/frontend/plugins/shuffle/jquery.shuffle.modernizr.min.js"></script>
    <script src="assets/assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="assets/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="assets/assets/frontend/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/assets/frontend/js/jquery.marquee.min.js"></script>
    <script src="assets/assets/frontend/js/custom.js"></script>

</body>

</html>
