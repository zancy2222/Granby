<?php

session_start();
include('dbcon.php');
if (isset($_SESSION['id_student']) && isset($_SESSION['pass']));  /*
if(!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], "userpage.php") === false) {
    // Redirect to 404 page or display 404 error message
    header("location: 404.html");
   
    exit;
}
*/
// Get the total number of questions
$query = "SELECT COUNT(*) AS total FROM questions";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$total_questions = $row['total'];

// Number of questions per page
$questions_per_page = 10;

// Calculate the total number of pages
$total_pages = ceil($total_questions / $questions_per_page);

// Get the current page number
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting index for the current page
$start_index = ($current_page - 1) * $questions_per_page;

// Fetch the questions for the current page
$query = "SELECT * FROM questions LIMIT $start_index, $questions_per_page";
$result = mysqli_query($con, $query);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Teacher Evaluation Form</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        /* Styles for both mobile and desktop */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .form-group img {
            max-width: 100%;
            height: auto;
        }

        /* Desktop styles */
        @media screen and (min-width: 768px) {

            .profile h2 {
                font-size: 25px;
                margin-bottom: 10px;
                color: #333;
            }

            body {
                background-image: url(img/test.jpg);
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                margin-top: 20px;
            }

            .profile {
                max-width: 300px;
                margin-right: 20px;
                background-color: #f5f5f5;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .rating-section {
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                margin-bottom: 20px;
                margin: 20px;
            }

            .rating-section h2 {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .step-forms {
                margin-top: 20px;
            }

            .pagination {
                text-align: center;
                margin-top: 20px;
            }

            .pagination a {
                display: inline-block;
                padding: 8px 16px;
                text-decoration: none;
                color: #333;
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                transition: background-color 0.3s;
            }

            .pagination a.active {
                background-color: #4CAF50;
                color: #fff;
                border-color: #4CAF50;
            }

            .pagination a:hover:not(.active) {
                background-color: #ddd;
            }

            .small-label {
                display: inline-block;
                width: 15px;
                height: 15px;
                border-radius: 50%;
                border: 1px solid #ccc;
                text-align: center;
                line-height: 15px;
                cursor: pointer;
                position: relative;
            }

            .small-label input[type="radio"] {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .small-label span {
                position: absolute;
                top: 0;
                left: 0;
                height: 15px;
                width: 15px;
                border-radius: 50%;
                background-color: #fff;
            }

            .small-label input[type="radio"]:checked+span {
                background-color: #4CAF50;
            }

            .btns-group {
                margin: 0 auto;
            }




            form {
                background-color: #f5f5f5;
                padding: 20px;
                margin-top: 5%;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            th,
            td {
                padding: 5px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                font-size: 14px;
            }

            th {
                background-color: #f2f2f2;
                font-size: 16px;
            }
        }

        /* Mobile styles */
        @media screen and (max-width: 767px) {
            body {
                background-image: url(img/test.jpg);
                /* Add a mobile-specific background */
                background-size: cover;
                background-attachment: fixed;
            }

            .container {
                flex-direction: column;
                align-items: center;
                padding: 10px;

            }

            .profile {

                width: 100%;
                margin-bottom: 5%;

                background-color: rgba(255, 255, 255, 0.9);
                padding: 5px;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .profile h2 {
                font-size: 18px;
                margin-bottom: 10px;
                color: #333;
            }

            .profile .form-group {
                margin-bottom: 10px;
            }

            .profile .form-group label {
                font-size: 14px;
                margin-bottom: 1px;
                color: #555;
            }

            .profile .form-control {
                font-size: 14px;
                padding: 5px;
                height: auto;
                background-color: rgba(255, 255, 255, 0.7);
                border: 1px solid #ddd;
            }

            .profile .form-group img {
                max-width: 80px;
                max-height: 80px;
                width: auto;
                height: auto;
                display: block;
                margin: 0 auto;
                border-radius: 50%;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            #evaluationForm {
                width: 100%;
                padding: 15px;
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .rating-section {
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                margin: 20px;
            }

            .rating-section h2 {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .rating-buttons {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 5px;
            }

            .rating-buttons button {
                margin: 5px;
            }

            @media screen and (max-width: 600px) {
                .rating-section {
                    margin: 10px;
                }

                .rating-buttons {
                    gap: 5px;
                }

                .rating-buttons button {
                    margin: 3px;
                    font-size: 12px;
                    padding: 5px px
                }
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 4px;
            }

            tr {
                font-weight: 450;
            }

            .small-label {
                display: inline-block;
                width: 18px;
                /* Increased from 20px */
                height: 18px;
                /* Increased from 20px */
                border-radius: 50%;
                border: 2px solid #ccc;
                /* Increased border width for visibility */
                text-align: center;
                line-height: 30px;
                /* Increased to match new height */
                cursor: pointer;
                position: relative;
            }

            /* Hide the default radio button */
            .small-label input[type="radio"] {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            /* Create a custom radio button */
            .small-label span {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 20px;
                /* Size of the inner circle */
                height: 20px;
                /* Size of the inner circle */
                border-radius: 50%;
                background-color: grey;
                transition: background-color 0.2s ease;
            }

            /* Style for checked state */
            .small-label input[type="radio"]:checked+span {
                background-color: #007bff;
                /* You can change this to your preferred color */
            }


            .form-group label {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="profile" action="">
            <h2>Teacher Profile</h2>
            <div class="form-group">
                <label for="teacher_name">Name:</label>
                <input type="text" class="form-control" name="Tname" value="<?= htmlspecialchars($_GET['Tname']) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="teacher_subject">Subject:</label>
                <input type="text" class="form-control" name="Tsubject" value="<?= htmlspecialchars($_GET['Tsubject']) ?>" readonly>
            </div>
        </form>

        <form id="evaluationForm" action="dbcon.php" method="post">
            <div class="rating-section">
                <h2>Rating Scale</h2>
                <div class="rating-buttons">
                    <button type="button" class="btn btn-primary" onclick="rateCourse(5)">5 - Outstanding</button>
                    <button type="button" class="btn btn-success" onclick="rateCourse(4)">4 - Very Good</button>
                    <button type="button" class="btn btn-info" onclick="rateCourse(3)">3 - Good</button>
                    <button type="button" class="btn btn-warning" onclick="rateCourse(2)">2 - Fair</button>
                    <button type="button" class="btn btn-danger" onclick="rateCourse(1)">1 - Poor</button>
                </div>
            </div>

            <input type="hidden" name="save_evaluation" value="1">
            <input type="hidden" name="user_id" value="<?= $_SESSION['id_student'] ?>">
            <input type="hidden" name="teacher_id" value="<?= htmlspecialchars($_GET['teacher_id']) ?>">
            <input type="hidden" name="Tname" value="<?= htmlspecialchars($_GET['Tname']) ?>">
            <input type="hidden" name="Tsubject" value="<?= htmlspecialchars($_GET['Tsubject']) ?>">

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($questions as $index => $question) : ?>
                            <tr>
                                <td><?= htmlspecialchars($question['question_text']) ?></td>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <td>
                                        <label class="small-label">
                                            <input type="radio" name="Q<?= ($index + 1) ?>" value="<?= $i ?>">
                                            <span></span>
                                        </label>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="teacher_feedback">Comments for Teacher:</label>
                <textarea name="teacher_feedback" id="teacher_feedback" class="form-control" rows="4" placeholder="Provide your comments or suggestions for the teacher here..." maxlength="300" oninput="updateCharCount()"></textarea>
                <small id="charCount" class="form-text text-muted">300 characters remaining</small>
            </div>

            <script>
                function updateCharCount() {
                    var feedbackText = document.getElementById('teacher_feedback');
                    var charCount = document.getElementById('charCount');
                    var remainingChars = 300 - feedbackText.value.length;

                    // Update character count text
                    charCount.textContent = remainingChars + " characters remaining";

                    // Change the color of the character count if the limit is near or exceeded
                    if (remainingChars <= 30) {
                        charCount.style.color = "orange"; // Orange for near limit
                    } else {
                        charCount.style.color = "green"; // Green for safe distance
                    }

                    if (remainingChars <= 0) {
                        charCount.style.color = "red"; // Red when limit is exceeded
                        charCount.textContent = "Character limit reached!";
                    }
                }
            </script>



            <div class="pagination">
                <div class="btns-group">
                    <input type="submit" value="Submit" name="save_evaluation" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('form[action="dbcon.php"]').addEventListener('submit', function(e) {
            e.preventDefault();

            var unansweredQuestions = [];
            var questions = this.querySelectorAll('input[type="radio"]');
            var totalQuestions = questions.length / 5;

            for (var i = 0; i < totalQuestions; i++) {
                var questionAnswered = false;
                for (var j = 0; j < 5; j++) {
                    if (questions[i * 5 + j].checked) {
                        questionAnswered = true;
                        break;
                    }
                }
                if (!questionAnswered) {
                    unansweredQuestions.push(i + 1);
                }
            }

            if (unansweredQuestions.length > 0) {
                Swal.fire({
                    title: 'Incomplete Evaluation',
                    text: 'Please answer all questions before submitting. Unanswered questions: ' + unansweredQuestions.join(', '),
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            var formData = new FormData(this);

            fetch('dbcon.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your evaluation has been submitted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'test.php';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was a problem submitting your evaluation. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });

        function rateCourse(rating) {
            console.log('Rating:', rating);
            // You can add more functionality here if needed
        }
    </script>
</body>

</html>