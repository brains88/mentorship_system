@include('layout.navbar')
<style>
.form-focus {
    position: relative;
}

.form-focus .focus-label {
    position: absolute;
    top: 40%;
    left: 10px;
    transform: translateY(-50%);
    transition: all 0.2s ease-in-out;
    pointer-events: none;
}

.form-focus input:focus+.focus-label,
.form-focus input:not(:placeholder-shown)+.focus-label {
    top: -10px;
    font-size: 12px;
    color: #4CAF50;
}
</style>

<body style="background-color:#ebf4fa">
    <!-- Main Wrapper -->
    <div class="main-wrapper main-wrapper-three">
        <!-- Home Banner -->
        <section class="section" style="padding: 60px 0;">
            <div class="container" style=" background-color: #f9f9f9;">
                <div class="row align-items-center" style="row-gap: 30px;">
                    <!-- Slider Section with Bootstrap Carousel -->
                    <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                        <div id="mentorshipCarousel" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#mentorshipCarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true"></button>
                                <button type="button" data-bs-target="#mentorshipCarousel"
                                    data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#mentorshipCarousel"
                                    data-bs-slide-to="2"></button>
                                <button type="button" data-bs-target="#mentorshipCarousel"
                                    data-bs-slide-to="3"></button>
                                <button type="button" data-bs-target="#mentorshipCarousel"
                                    data-bs-slide-to="4"></button>
                            </div>
                            <!-- Carousel Items -->
                            <div class="carousel-inner">
                                <div class="carousel-item active"
                                    style="background: url('assets/img/mentorship/mentorship1.jpeg') no-repeat center center/cover; min-height: 400px;">
                                    <!-- Overlay -->
                                    <div class="carousel-caption text-start"
                                        style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                                        <h1 style="font-size: 24px; font-weight: bold; color: #fff;">Empowering
                                            Students
                                            Through Mentorship</h1>
                                        <p style="font-size: 16px; color: #fff;">Join a network of mentors dedicated
                                            to
                                            guiding Nigerian university students toward success.</p>
                                    </div>
                                </div>
                                <div class="carousel-item"
                                    style="background: url('assets/img/mentorship/mentorship2.jpg') no-repeat center center/cover; min-height: 400px;">
                                    <div class="carousel-caption text-start"
                                        style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                                        <h1 style="font-size: 24px; font-weight: bold; color: #fff;">Bridging the
                                            Gap
                                            Between Learning and Practice</h1>
                                        <p style="font-size: 16px; color: #fff;">Experience real-world insights from
                                            experienced professionals and educators.</p>
                                    </div>
                                </div>
                                <div class="carousel-item"
                                    style="background: url('assets/img/mentorship/mentorship3.jpg') no-repeat center center/cover; min-height: 400px;">
                                    <div class="carousel-caption text-start"
                                        style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                                        <h1 style="font-size: 24px; font-weight: bold; color: #fff;">Fostering
                                            Innovation and Leadership</h1>
                                        <p style="font-size: 16px; color: #fff;">Shape the leaders of tomorrow with
                                            tailored mentorship programs.</p>
                                    </div>
                                </div>
                                <div class="carousel-item"
                                    style="background: url('assets/img/mentorship/mentorship4.jpg') no-repeat center center/cover; min-height: 400px;">
                                    <div class="carousel-caption text-start"
                                        style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                                        <h1 style="font-size: 24px; font-weight: bold; color: #fff;">Unlock
                                            Opportunities with Guidance</h1>
                                        <p style="font-size: 16px; color: #fff;">Discover pathways to success with
                                            dedicated mentors who care.</p>
                                    </div>
                                </div>
                                <div class="carousel-item"
                                    style="background: url('assets/img/mentorship/mentorship5.jpg') no-repeat center center/cover; min-height: 400px;">
                                    <div class="carousel-caption text-start"
                                        style="background: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                                        <h1 style="font-size: 24px; font-weight: bold; color: #fff;">Your Journey to
                                            Excellence Starts Here</h1>
                                        <p style="font-size: 16px; color: #fff;">Join our mentorship program and
                                            take
                                            the first step toward a brighter future.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signup Form Section -->
                    <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                        <div class="account-content p-4 rounded w-100"
                            style="background: linear-gradient(135deg, #ffffff, #f3f3f3); box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); border-radius: 10px; min-height: 400px;">
                            <div class="login-header d-flex justify-content-between">
                                <h3 style="color: #333;" id="form-title">Mentee Register</h3>
                                <a href="#" id="toggle-role"
                                    style="color:#4CAF50 !important; text-decoration: none;">I'm not a Mentee</a>
                            </div>
                            <form id="registration-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role" id="role" value="mentee">

                                <div class="form-group form-focus" style="margin-bottom: 20px;">
                                    <input type="text" name="name" class="form-control" placeholder=" " required>
                                    <label class="focus-label">Name</label>
                                </div>

                                <div class="form-group form-focus" style="margin-bottom: 20px;">
                                    <input type="email" name="email" class="form-control" placeholder=" " required>
                                    <label class="focus-label">Email</label>
                                </div>

                                <div class="form-group form-focus" style="margin-bottom: 20px;">
                                    <input type="tel" name="mobile" class="form-control" placeholder=" " required>
                                    <label class="focus-label">Mobile Number</label>
                                </div>

                                <div class="form-group form-focus" style="margin-bottom: 20px;">
                                    <input type="text" name="special_field" class="form-control" placeholder=" "
                                        required>
                                    <label class="focus-label">Area of Interest</label>
                                </div>

                                <div class="form-group form-focus" style="margin-bottom: 20px;">
                                    <input type="password" name="password" class="form-control" placeholder=" "
                                        required>
                                    <label class="focus-label">Create Password</label>
                                </div>

                                <div class="form-group form-focus" style="margin-bottom: 20px;">
                                    <input type="file" name="profile_image" class="form-control" required>
                                    <label class="focus-label">Profile Image</label>
                                </div>
                                <!-- Displaying Form Messages -->
                                <div id="form-messages" style="margin-bottom: 20px;"></div>
                                <!-- Displaying Form messages  -->
                                <button id="signup-btn" type="submit" class="btn login-btn w-100"
                                    style="background-color:#4CAF50; color:white;">
                                    Signup
                                    <span id="spinner" class="spinner-border spinner-border-sm" role="status"
                                        style="display: none;"></span>
                                </button>
                                <div class="text-center mt-2 mb-2">Already has an Account? <a
                                        href="{{route('login')}}">Sign In</a></div>
                            </form>



                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Home Banner -->
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
    <script>
    document.getElementById('toggle-role').addEventListener('click', function(event) {
        event.preventDefault();

        const formTitle = document.getElementById('form-title'); // Form title element
        const toggleText = this; // The toggle button
        const specialInput = document.querySelector(
            'input[name="special_field"]'); // Target the input field
        const specialLabel = specialInput.closest('.form-group').querySelector(
            '.focus-label'); // Get the associated label
        const roleInput = document.getElementById('role'); // Hidden input for the role

        if (formTitle.textContent === 'Mentee Register') {
            formTitle.textContent = 'Mentor Register';
            specialLabel.textContent = "What's your program or Area of specialty";
            toggleText.textContent = "I'm not a Mentor";
            roleInput.value = "mentor"; // Set role to mentor
        } else {
            formTitle.textContent = 'Mentee Register';
            specialLabel.textContent = "Area of Interest";
            toggleText.textContent = "I'm not a Mentee";
            roleInput.value = "mentee"; // Set role to mentee
        }
    });


    document.getElementById('registration-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const form = this;
        const formData = new FormData(form);
        const formMessages = document.getElementById('form-messages');
        const signupBtn = document.getElementById('signup-btn');
        const spinner = document.getElementById('spinner');

        // Clear previous messages
        formMessages.textContent = '';
        formMessages.innerHTML = '';
        console.clear();

        // Show spinner
        spinner.style.display = 'inline-block';
        signupBtn.disabled = true;

        fetch("{{ route('register') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json', // Ensures Laravel returns JSON
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response:', data); // Log response to console

                // Handle success
                if (data.success) {
                    formMessages.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message || 'Registration successful!'}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                    window.location.href = data.redirect_url || "{{ route('login') }}";
                }
                // Handle validation errors
                else if (data.errors) {
                    let errorList = '<ul>';
                    for (const [field, messages] of Object.entries(data.errors)) {
                        messages.forEach(message => {
                            errorList += `<li>${message}</li>`;
                        });
                    }
                    errorList += '</ul>';
                    formMessages.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>There were some issues with your input</strong>${errorList}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                // Handle unexpected errors
                else {
                    formMessages.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        An unexpected error occurred. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formMessages.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    A network error occurred. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            })
            .finally(() => {
                // Hide spinner and re-enable button
                spinner.style.display = 'none';
                signupBtn.disabled = false;
            });
    });
    </script>
</body>

</html>
