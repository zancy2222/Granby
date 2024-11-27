<?php

include('dbcon.php');
session_start();


// Assuming this is your login verification logic
if ($login_success) {
    $_SESSION['id'] = $user_id; // Set user id in session
    $_SESSION['username'] = $username; // Set username in session
    $_SESSION['password'] = $password; // Set password in session (or a hashed password/token for security)
    header('Location: Teacher.php'); // Redirect to a logged-in page after successful login
    exit();
}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Responsive Registration Form | CodingLab</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="title">Evaluation</div>

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
    <form action="dbcon.php" method="post">

    <input type="hidden" name="user_id" value="<?= $_SESSION['id_student'] ?>">
    <input type="hidden" name="teacher_id" value="<?= htmlspecialchars($_GET['teacher_id']) ?>">
    <input type="hidden" name="Tname" value="<?= htmlspecialchars($_GET['Tname']) ?>">
    <input type="hidden" name="Tsubject" value="<?= htmlspecialchars($_GET['Tsubject']) ?>">
    
            <div class="step-forms step-forms-active">
                <div class="question-container">
                    <div class="question">Question 1: How would you rate the instructor's engagement?</div>
                    <div class="options">
                        <label><input type="radio" name="Q1" value="5"> 5</label>
                        <label><input type="radio" name="Q1" value="4"> 4</label>
                        <label><input type="radio" name="Q1" value="3"> 3</label>
                        <label><input type="radio" name="Q1" value="2"> 2</label>
                        <label><input type="radio" name="Q1" value="1"> 1</label>
                    </div>
                </div>
                <div class="question-container">
                    <div class="question">Question 2: How would you rate the instructor's clarity?</div>
                    <div class="options">
                        <label><input type="radio" name="Q2" value="5"> 5</label>
                        <label><input type="radio" name="Q2" value="4"> 4</label>
                        <label><input type="radio" name="Q2" value="3"> 3</label>
                        <label><input type="radio" name="Q2" value="2"> 2</label>
                        <label><input type="radio" name="Q2" value="1"> 1</label>
                    </div>
                </div>
                <div class="question-container">
                    <div class="question">Question 3: How would you rate the instructor's knowledge?</div>
                    <div class="options">
                        <label><input type="radio" name="Q3" value="5"> 5</label>
                        <label><input type="radio" name="Q3" value="4"> 4</label>
                        <label><input type="radio" name="Q3" value="3"> 3</label>
                        <label><input type="radio" name="Q3" value="2"> 2</label>
                        <label><input type="radio" name="Q3" value="1"> 1</label>
                    </div>
                </div>
                <div class="question-container">
                    <div class="question">Question 4: How would you rate the instructor's punctuality?</div>
                    <div class="options">
                        <label><input type="radio" name="Q4" value="5"> 5</label>
                        <label><input type="radio" name="Q4" value="4"> 4</label>
                        <label><input type="radio" name="Q4" value="3"> 3</label>
                        <label><input type="radio" name="Q4" value="2"> 2</label>
                        <label><input type="radio" name="Q4" value="1"> 1</label>
                    </div>
                </div>
                <div class="btns-group">
                    <a href="#" class="btn btn-next" onclick="validateStep1(event)">Next</a>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-forms hidden">
                <div class="question-container">
                    <div class="question">Question 5: How would you rate the course material?</div>
                    <div class="options">
                        <label><input type="radio" name="Q5" value="5"> 5</label>
                        <label><input type="radio" name="Q5" value="4"> 4</label>
                        <label><input type="radio" name="Q5" value="3"> 3</label>
                        <label><input type="radio" name="Q5" value="2"> 2</label>
                        <label><input type="radio" name="Q5" value="1"> 1</label>
                    </div>
                </div>
                <div class="question-container">
                    <div class="question">Question 6: How would you rate the course's difficulty?</div>
                    <div class="options">
                        <label><input type="radio" name="Q6" value="5"> 5</label>
                        <label><input type="radio" name="Q6" value="4"> 4</label>
                        <label><input type="radio" name="Q6" value="3"> 3</label>
                        <label><input type="radio" name="Q6" value="2"> 2</label>
                        <label><input type="radio" name="Q6" value="1"> 1</label>
                    </div>
                </div>
                <div class="question-container">
                    <div class="question">Question 7: How would you rate the course's pacing?</div>
                    <div class="options">
                        <label><input type="radio" name="Q7" value="5"> 5</label>
                        <label><input type="radio" name="Q7" value="4"> 4</label>
                        <label><input type="radio" name="Q7" value="3"> 3</label>
                        <label><input type="radio" name="Q7" value="2"> 2</label>
                        <label><input type="radio" name="Q7" value="1"> 1</label>
                    </div>
                </div>
                <div class="question-container">
                    <div class="question">Question 8: How would you rate the overall learning experience?</div>
                    <div class="options">
                        <label><input type="radio" name="Q8" value="5"> 5</label>
                        <label><input type="radio" name="Q8" value="4"> 4</label>
                        <label><input type="radio" name="Q8" value="3"> 3</label>
                        <label><input type="radio" name="Q8" value="2"> 2</label>
                        <label><input type="radio" name="Q8" value="1"> 1</label>
                    </div>
                </div>
                <div class="btns-group">
                    <a href="#" class="btn btn-prev" onclick="prevStep(event)">Previous</a>
                    <a href="#" class="btn btn-next" onclick="validateStep2(event)">Next</a>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-forms hidden">
                
                <div class="question-container">
                    <div class="question">We kindly request that you share your feedback with respect and consideration; any disrespectful or inappropriate comments are not allowed.</div>
                    <textarea name="Q9" rows="4" cols="50"></textarea>
                </div>
                <div class="btns-group">
                    <a href="#" class="btn btn-prev" onclick="prevStep(event)">Previous</a>
                    <input type="submit" value="Submit" name="save_evaluation" class="btn">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const prevBtns = document.querySelectorAll(".btn-prev");
        const nextBtns = document.querySelectorAll(".btn-next");
        const progress = document.getElementById("progress");
        const formSteps = document.querySelectorAll(".step-forms");
        const progressSteps = document.querySelectorAll(".progress-step");

        let formStepsNum = 0;

        prevBtns.forEach(btn => {
            btn.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission behavior
                if (formStepsNum > 0) {
                    formSteps[formStepsNum].classList.remove("step-forms-active");
                    formStepsNum -= 1;
                    formSteps[formStepsNum].classList.add("step-forms-active");
                    updateProgress();
                    if (formStepsNum === 0) {
                        nextBtns[0].style.display = 'inline-block';
                    }
                }
            });
        });

        nextBtns.forEach(btn => {
            btn.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission behavior
                if (formStepsNum < formSteps.length - 1) {
                    formSteps[formStepsNum].classList.remove("step-forms-active");
                    formStepsNum += 1;
                    formSteps[formStepsNum].classList.add("step-forms-active");
                    updateProgress();
                    if (formStepsNum === 1) {
                        nextBtns[0].style.display = 'none';
                    }
                }
            });
        });

        function updateProgress() {
            const progressValue = (formStepsNum) * (100 / (formSteps.length - 1));
            progress.style.width = `${progressValue}%`;
            progressSteps.forEach((step, index) => {
                if (index <= formStepsNum) {
                    step.classList.add("progress-step-active");
                } else {
                    step.classList.remove("progress-step-active");
                }
            });
        }
    });
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
        background-image: url(img/test.jpg);
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


    .content form .question-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.question-container .question {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 10px;
}

.question-container .options {
    display: flex;
    justify-content: space-around;
}

.options input[type="radio"] {
    margin-right: 5px;
}

.options {
    display: flex;
    justify-content: space-around;
}

.options input[type="radio"] {
    margin-right: 5px;
}

.options label {
    font-size: 14px;
}

/* Responsive styling */
@media(max-width: 600px) {
    .question-container .question {
        font-size: 16px; /* Adjust font size */
    }

    .options label {
        font-size: 15px; /* Adjust font size */
    }

    .content {
        padding: 15px; /* Adjust padding */
    }

    .button {
        margin-top: 15px; /* Adjust margin */
    }
}
</style>

</html>