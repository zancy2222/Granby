<?php
session_start();
include('dbcon.php');



?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Responsive Registration Form | CodingLab</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hidden {
            display: none;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }



        .step-forms-active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Registration</div>

        <div class="progressbar">
            <div class="progress" id="progress"></div>
            <div class="progress-step progress-step-active" data-title="Step 1"></div>
            <div class="progress-step" data-title="Step 2"></div>
            <div class="progress-step" data-title="Step 3"></div>
        </div>
        <span class="error-message" id="step1-error"></span>
        <span class="error-message" id="step2-error"></span>
        <span class="error-message" id="step3-error"></span>
        <div class="content">

            <form id="registrationForm" action="Sregister.php" method="post">
                <!-- Step 1 -->
                <div class="step-forms step-forms-active">
        <div class="user-details">
            <div class="input-box">
                <span class="details">Student ID<span style="color: red;">*</span></span>
                <input type="text" name="id_student" placeholder="Enter your Student ID" class="form-control" maxlength="6" required>
            </div>
            <div class="input-box">
                <span class="details">Password<span style="color: red;">*</span></span>
                <div class="password-container">
                    <input type="password" name="pass" placeholder="Enter your Password" class="form-control" maxlength="8" required>
                    <i class="fas fa-eye" id="toggle-password"></i> <!-- Eye icon -->
                </div>
            </div>
            <div class="input-box">
                <span class="details">Confirm Password<span style="color: red;">*</span></span>
                <div class="password-container">
                    <input type="password" name="Cpass" placeholder="Confirm your Password" class="form-control" maxlength="8" required>
                    <i class="fas fa-eye" id="toggle-cpass"></i> <!-- Eye icon -->
                </div>
            </div>
        </div>
        <div class="btns-group">
            <a href="Slogin.php" class="">Already have an account?</a>
            <a href="#" class="btn btn-next" onclick="validateStep1(event)">Next</a>
        </div>
    </div>

    <script>
        // Toggle password visibility for both fields
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.querySelector('input[name="pass"]');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggle-cpass').addEventListener('click', function() {
            const cpassField = document.querySelector('input[name="Cpass"]');
            const type = cpassField.type === 'password' ? 'text' : 'password';
            cpassField.type = type;
            this.classList.toggle('fa-eye-slash');
        });
    </script>

                <!-- Step 2 -->
                <div class="step-forms hidden">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Firstname<span style="color: red;">*</span></span>
                            <input type="text" name="Fname" placeholder="Enter your Firstname" class="form-control" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Middle Name<span style="color: red;"></span></span>
                            <input type="text" name="Mname" placeholder="Enter your Middle Name" class="form-control">
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name<span style="color: red;">*</span></span>
                            <input type="text" name="Lname" placeholder="Enter your Last Name" class="form-control" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Suffix</span>
                            <div class="custom-select">
                                <select id="suffix" name="Suffix" class="form-control">
                                    <option value="" disabled selected>Select your Suffix</option>

                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="btns-group">
                        <a href="#" class="btn btn-prev" onclick="prevStep(event)">Previous</a>
                        <a href="#" class="btn btn-next" onclick="validateStep2(event)">Next</a>
                    </div>
                </div>
               <!-- Step 3 -->
<div class="step-forms hidden">
    <div class="user-details">
        <div class="input-box">
            <span class="details">College<span style="color: red;">*</span></span>
            <div class="custom-select">
                <select id="branch" name="Branch" class="form-control" required>
                    <option value="" disabled selected>Select your College</option>
                    <option value="Granby College" <?php echo ($selectedBranch == 'Granby College') ? 'selected' : ''; ?>>Granby College</option>
                </select>
            </div>
        </div>
        <div class="input-box">
            <span class="details">Course<span style="color: red;">*</span></span>
            <div class="custom-select">
                <select id="course" name="Course" class="form-control" required>
                    <option value="" disabled selected>Select your Course</option>
                    <?php if ($selectedBranch && isset($branchesCourses[$selectedBranch])) : ?>
                        <?php foreach ($branchesCourses[$selectedBranch] as $course) : ?>
                            <option value="<?php echo htmlspecialchars($course); ?>"><?php echo htmlspecialchars($course); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="input-box" id="sectionInput">
            <span class="details">Section<span style="color: red;">*</span></span>
            <div class="custom-select">
                <select id="section" name="Section" class="form-control" required>
                    <option value="" disabled selected>Select your Section</option>
                </select>
            </div>
        </div>
    </div>
    <div class="btns-group">
        <a href="#" class="btn btn-prev" onclick="prevStep(event)">Previous</a>
        <input type="submit" value="Register" name="save_changes" class="btn">
    </div>
</div>

<script>
// Store the course and section data
const branchesCourses = <?php echo json_encode($branchesCourses); ?>;
const branchesCoursesSection = <?php echo json_encode($branchesCoursesSection); ?>;

// Handle branch change
document.getElementById('branch').addEventListener('change', function() {
    const selectedBranch = this.value;
    const courseDropdown = document.getElementById('course');
    const sectionDropdown = document.getElementById('section');
    
    // Clear existing options
    courseDropdown.innerHTML = '<option value="" disabled selected>Select your Course</option>';
    sectionDropdown.innerHTML = '<option value="" disabled selected>Select your Section</option>';
    
    // Populate courses
    if (branchesCourses[selectedBranch]) {
        branchesCourses[selectedBranch].forEach(course => {
            const option = document.createElement('option');
            option.value = course;
            option.text = course;
            courseDropdown.appendChild(option);
        });
    }
});

// Handle course change
document.getElementById('course').addEventListener('change', function() {
    const selectedBranch = document.getElementById('branch').value;
    const selectedCourse = this.value;
    const sectionDropdown = document.getElementById('section');
    
    // Clear existing options
    sectionDropdown.innerHTML = '<option value="" disabled selected>Select your Section</option>';
    
    // Get the course prefix to filter sections
    let coursePrefix = '';
    if (selectedCourse.includes('Elementary Education')) {
        coursePrefix = 'BEED';
    } else if (selectedCourse.includes('Secondary Education')) {
        coursePrefix = 'BSED';
    } else if (selectedCourse.includes('Information Technology')) {
        coursePrefix = 'BSIT';
    } else if (selectedCourse.includes('Computer Science')) {
        coursePrefix = 'BSCS';
    } else if (selectedCourse.includes('Tourism Management')) {
        coursePrefix = 'BTM';
    } else if (selectedCourse.includes('Criminology')) {
        coursePrefix = 'BCRIM';
    }
    
    // Filter and populate sections based on course prefix
    if (branchesCoursesSection[selectedBranch]) {
        const filteredSections = branchesCoursesSection[selectedBranch].filter(section => 
            section.startsWith(coursePrefix));
        
        filteredSections.forEach(section => {
            const option = document.createElement('option');
            option.value = section;
            option.text = section;
            sectionDropdown.appendChild(option);
        });
        
        document.getElementById('sectionInput').style.display = 'block';
    }
});

// Initialize dropdowns on page load
document.addEventListener('DOMContentLoaded', function() {
    const selectedBranch = "<?php echo addslashes($selectedBranch); ?>";
    if (selectedBranch) {
        document.getElementById('branch').value = selectedBranch;
        document.getElementById('branch').dispatchEvent(new Event('change'));
    }
});

function removePlaceholder(selectElement) {
    const placeholderOption = selectElement.querySelector('option[value=""]');
    if (placeholderOption) {
        placeholderOption.remove();
    }
}
</script>

                <script>
                    function removePlaceholder(selectElement) {
                        var placeholderOption = selectElement.querySelector('option[value=""]');
                        if (placeholderOption) {
                            placeholderOption.remove();
                        }
                    }
                </script>
                <script>
                    const prevBtns = document.querySelectorAll(".btn-prev");
                    const nextBtns = document.querySelectorAll(".btn-next");
                    const progress = document.getElementById("progress");
                    const formSteps = document.querySelectorAll(".step-forms");
                    const progressSteps = document.querySelectorAll(".progress-step");

                    let formStepsNum = 0;

                    function updateFormSteps() {
                        formSteps.forEach((formStep) => {
                            formStep.classList.contains("step-forms-active") &&
                                formStep.classList.remove("step-forms-active");
                        });
                        formSteps[formStepsNum].classList.add("step-forms-active");
                    }

                    function updateProgressbar() {
                        progressSteps.forEach((progressStep, idx) => {
                            if (idx <= formStepsNum) {
                                progressStep.classList.add("progress-step-active");
                            } else {
                                progressStep.classList.remove("progress-step-active");
                            }
                        });

                        const progressActive = document.querySelectorAll(".progress-step-active");
                        progress.style.width = ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
                    }

                    function validateStep1(event) {
    event.preventDefault();
    const id_student = document.querySelector('input[name="id_student"]').value;
    const pass = document.querySelector('input[name="pass"]').value;
    const cpass = document.querySelector('input[name="Cpass"]').value;
    const error = document.getElementById('step1-error');

    // Check if fields are empty
    if (!id_student || !pass || !cpass) {
        error.textContent = 'Please fill out all fields!';
        return;
    }

    // Validate student ID
    if (isNaN(id_student)) {
        error.textContent = 'Student ID must contain only numbers';
        return;
    }

    if (id_student.length < 6) {
        error.textContent = 'Student ID must be at least 6 characters long';
        return;
    }

    // Validate password length
    if (pass.length !== 8) {
        error.textContent = 'Password must be exactly 8 characters long';
        return;
    }

    // Check if passwords match
    if (pass !== cpass) {
        error.textContent = 'Passwords do not match!';
        return;
    }

    // If all validations pass
    error.textContent = '';
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
}


                    function removeBranchParam() {
                        const url = new URL(window.location.href);
                        url.searchParams.delete('branch');
                        window.history.replaceState({}, document.title, url); // Update the URL without reloading the page
                    }

                    // Call the function when the page loads
                    window.onload = removeBranchParam;


                    function validateStep2(event) {
                        event.preventDefault();
                        const fname = document.querySelector('input[name="Fname"]').value.trim();
                        const mname = document.querySelector('input[name="Mname"]').value.trim();
                        const lname = document.querySelector('input[name="Lname"]').value.trim();
                        const error = document.getElementById('step2-error');

                        if (!fname || !lname) {
                            error.textContent = 'Please fill out all required fields (First name and Last name)!';
                        } else if (!/^[a-zA-Z\s]+$/.test(fname) || (mname && !/^[a-zA-Z\s]+$/.test(mname)) || !/^[a-zA-Z\s]+$/.test(lname)) {
                            error.textContent = 'Names must contain only letters and spaces!';
                        } else {
                            formStepsNum++;
                            updateFormSteps();
                            updateProgressbar();
                            error.textContent = '';
                        }
                    }


                    function prevStep(event) {
                        event.preventDefault();
                        formStepsNum--;
                        updateFormSteps();
                        updateProgressbar();
                    }
                </script>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    .custom-select {
        position: relative;
        width: 100%;
    }

    .custom-select select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: transparent;
        cursor: pointer;
    }

    .custom-select::before {

        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        pointer-events: none;
        color: #aaa;
        transition: all 0.3s;
    }

    .custom-select select:focus+::before,
    .custom-select select:not(:placeholder-shown)+::before {
        top: -15px;
        font-size: 12px;
        color: #245580;
    }


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background-image: url(img/background1.jpg);
    }

    .container {
        max-width: 700px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .container .title {
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        border-radius: 5px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .content form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box {
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .user-details .input-box input {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid {
        border-color: #B8860B;
    }

    form .button {
        height: 45px;
        margin: 35px 0
    }

    form .button input {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    form .button input:hover {
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
    }

    @media(max-width: 584px) {
        .container {
            max-width: 100%;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: 100%;
        }

        .content form .user-details {
            max-height: 300px;
            overflow-y: scroll;
        }

        .user-details::-webkit-scrollbar {
            width: 5px;
        }
    }

    @media(max-width: 459px) {
        .container .content .category {
            flex-direction: column;
        }
    }

    .progressbar {
        position: relative;
        display: flex;
        justify-content: space-between;
        counter-reset: step;
        margin: 2rem 0 4rem;
    }

    .progressbar::before,
    .progress {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #dcdcdc;
        z-index: 1;
    }

    .progress {
        background-color: #B8860B;
        width: 0%;
        transition: 0.3s;
    }

    .progress-step {
        width: 2.1875rem;
        height: 2.1875rem;
        background-color: #dcdcdc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .progress-step::before {
        counter-increment: step;
        content: counter(step);
    }

    .progress-step::after {
        content: attr(data-title);
        position: absolute;
        top: calc(100% + 0.5rem);
        font-size: 0.85rem;
        color: #666;
    }

    .progress-step-active {
        background-color: #245580;
        color: #f3f3f3;
    }

    .step-forms {
        display: none;
    }

    .step-forms-active {
        display: block;
    }

    .btns-group {
        display: flex;
        justify-content: space-between;
    }

    .btn {
        padding: 0.75rem;
        text-decoration: none;
        background-color: #245580;
        color: #fff;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px #9b59b6;
    }

    .input-box {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        width: max-content;
        /* Adjust width */
        overflow-y: auto;
        max-height: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
    .password-container {
            position: relative;
            width: 100%;
        }
        .password-container input {
            width: 100%;
            padding-right: 30px; /* Space for the eye icon */
        }
        .password-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
</style>

</html>