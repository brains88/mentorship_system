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

                                <div class="form-group form-focus" style="margin-bottom: 30px; position: relative;">
                                <select name="interests[]" id="interests" class="form-control select2" multiple required>
                                <option value="Web Development">Web Development</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Artificial Intelligence">Artificial Intelligence</option>
                                <option value="Machine Learning">Machine Learning</option>
                                <option value="Cybersecurity">Cybersecurity</option>
                                <option value="Cloud Computing">Cloud Computing</option>
                                <option value="UI/UX Design">UI/UX Design</option>
                                <option value="Digital Marketing">Digital Marketing</option>
                                <option value="Entrepreneurship">Entrepreneurship</option>
                                </select>
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
<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* Main container styling */
.form-focus {
    position: relative;
    margin-bottom: 1.5rem;
}

/* Select2 input box styling */
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da;
    border-radius: 4px;
    min-height: 45px;
    padding: 5px 10px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

/* Selected tags styling - INSIDE the input */
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    display: flex;
    flex-wrap: wrap;
    padding: 0;
    margin: -2px;
    line-height: 1.5;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e9f7ef;
    border: 1px solid #c8e6d9;
    border-radius: 3px;
    color: #28a745;
    padding: 2px 8px;
    margin: 2px;
    font-size: 13px;
    display: flex;
    align-items: center;
}

/* Remove button styling */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #28a745;
    opacity: 0.7;
    margin-right: 5px;
    border: none;
    background: transparent;
    padding: 0;
    font-size: 14px;
}

/* Focus state */
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #28a745;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}


.select2-container--open ~ .focus-label,
.select2-container--focus ~ .focus-label,
.has-selection ~ .focus-label {
    opacity: 1;
    top: -8px;
}

/* Placeholder text */
.select2-search--inline .select2-search__field {
    margin-top: 6px !important;
    padding-left: 3px !important;
    height: 26px !important;
    color: #6c757d !important;
}

/* Make sure the input expands */
.select2-container {
    width: 100% !important;
}
</style>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select 1-3 areas...",
        allowClear: true,
        width: '100%',
        maximumSelectionLength: 3,
        closeOnSelect: false
    });

    // Handle selection changes
    $('#interests').on('change', function() {
        var $container = $(this).closest('.form-focus');
        var hasSelection = $(this).val() && $(this).val().length > 0;
        $container.toggleClass('has-selection', hasSelection);
    });

    // Prevent selecting more than 3 options
    $('#interests').on('select2:selecting', function(e) {
        if ($(this).val() && $(this).val().length >= 3) {
            alert('Maximum 3 areas can be selected');
            e.preventDefault();
        }
    });

    // Validate minimum selection on form submission
    $('form').on('submit', function(e) {
        if (!$('#interests').val() || $('#interests').val().length < 1) {
            alert('Please select at least 1 area of interest');
            e.preventDefault();
        }
    });

    // Initialize label state if there are pre-selected values
    if ($('#interests').val() && $('#interests').val().length > 0) {
        $('#interests').closest('.form-focus').addClass('has-selection');
    }
});
</script>
</script>
    <!-- Custom Script -->
    <script>
document.getElementById('toggle-role').addEventListener('click', function(event) {
    event.preventDefault();
    
    const formTitle = document.getElementById('form-title');
    const toggleText = this;
    const interestsLabel = document.querySelector('#interests').closest('.form-group').querySelector('.focus-label');
    const roleInput = document.getElementById('role');
    
    if (formTitle.textContent.trim() === 'Mentee Register') {
        formTitle.textContent = 'Mentor Register';
        interestsLabel.textContent = "What's your program or Area of specialty";
        toggleText.textContent = "I'm not a Mentor";
        roleInput.value = "mentor";
    } else {
        formTitle.textContent = 'Mentee Register';
        interestsLabel.textContent = "Area of Interest (Select 1-3)";
        toggleText.textContent = "I'm not a Mentee";
        roleInput.value = "mentee";
    }
});

    document.getElementById('registration-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const formMessages = document.getElementById('form-messages');
    const signupBtn = document.getElementById('signup-btn');
    const spinner = document.getElementById('spinner');
    
    // Clear previous messages
    formMessages.innerHTML = '';
    
    // Validate interests selection
    const interests = Array.from(document.querySelectorAll('#interests option:checked'));
    if (interests.length < 1 || interests.length > 3) {
        formMessages.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Please select 1-3 areas of interest.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        return;
    }
    
    // Show spinner
    spinner.style.display = 'inline-block';
    signupBtn.disabled = true;
    
    try {
        const response = await fetch("{{ route('register') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            formMessages.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ${data.message || 'Registration successful!'}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            
            // Redirect after a short delay
            setTimeout(() => {
                window.location.href = data.redirect_url || "{{ route('login') }}";
            }, 1500);
        } else {
            // Handle validation errors
            let errorMessage = 'An error occurred. Please try again.';
            if (data.errors) {
                errorMessage = Object.values(data.errors).flat().join('<br>');
            } else if (data.message) {
                errorMessage = data.message;
            }
            
            formMessages.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${errorMessage}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        }
    } catch (error) {
        formMessages.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Network error. Please check your connection and try again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
    } finally {
        spinner.style.display = 'none';
        signupBtn.disabled = false;
    }
});
    </script>
</body>

</html>
