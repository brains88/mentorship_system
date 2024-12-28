<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Signup Tab Content -->
        <div class="account-content">
            <div class="account-box">
                <div class="login-right">
                    <div class="login-header">
                        <h3>Login</h3>
                    </div>
                    <form id="login-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="form-control pass-input" id="password"
                                    placeholder="Password" required>
                                <span class="fas fa-eye toggle-password" id="toggle-password"></span>
                            </div>
                        </div>
                        <!-- Displaying Form Messages -->
                        <div id="form-messages" style="margin-bottom: 20px;"></div>
                        <!-- Displaying Form messages -->
                        <button id="login-btn" class="btn btn-primary login-btn" type="submit">
                            Login
                            <span id="spinner" class="spinner-border spinner-border-sm" role="status"
                                style="display: none;"></span>
                        </button>
                        <div class="text-center dont-have">Not Registered yet? <a href="{{route('register')}}">Sign
                                Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Signup Tab Content -->

    </div>

    <!-- Add the custom styles for the background and form centering -->
    <style>
    body.account-page {
        background: url('assets/img/improve-skill.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .main-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .account-content {
        background: rgba(255, 255, 255, 0.9);
        /* Lighter background for readability */
        border-radius: 8px;
        padding: 30px;
        width: 100%;
        max-width: 400px;
        /* Limit form width */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .login-header h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #555;
    }

    .form-control {
        border-radius: 4px;
        margin-bottom: 15px;
        padding: 10px;
        font-size: 16px;
        width: 100%;
    }

    .btn-primary {
        background-color: #4CAF50;
        /* Calming green color */
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #45a049;
        /* Darker shade of green for hover effect */
    }

    .dont-have {
        margin-top: 10px;
    }

    .dont-have a {
        color: #4CAF50;
        text-decoration: none;
        font-weight: bold;
    }

    .dont-have a:hover {
        text-decoration: underline;
    }

    .pass-group {
        position: relative;
    }

    .pass-input {
        padding-right: 40px;
        /* Space for the eye icon */
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #aaa;
    }

    .toggle-password:hover {
        color: #333;
    }
    </style>


    <script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this;

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const form = this;
        const formData = new FormData(form);
        const formMessages = document.getElementById('form-messages');
        const signupBtn = document.getElementById('login-btn');
        const spinner = document.getElementById('spinner');

        // Clear previous messages
        formMessages.textContent = '';
        formMessages.innerHTML = '';
        console.clear();

        // Show spinner
        spinner.style.display = 'inline-block';
        signupBtn.disabled = true;

        fetch("{{ route('login') }}", {
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
                        ${data.message || 'Login successful...'}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                    window.location.href = data.redirect_url;
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
                        Login Failed. Please try again.
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
`
