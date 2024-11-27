<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet"
<?php
require 'dbcon.php';
include('includes/header.php');
include('includes/navbar.php');
include('message.php');
session_start();


// Assuming this is your login verification logic
if ($login_success) {
    $_SESSION['id'] = $user_id; // Set user id in session
    $_SESSION['username'] = $username; // Set username in session
    $_SESSION['password'] = $password; // Set password in session (or a hashed password/token for security)
    header('Location: Teacher.php'); // Redirect to a logged-in page after successful login
    exit();
}


$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$query = "SELECT * FROM questions";
$query_run = mysqli_query($con, $query);

if ($query_run) {
    $entriesPerPage = 6;
    $totalEntries = mysqli_num_rows($query_run);
    $totalPages = ceil($totalEntries / $entriesPerPage);
    $offset = ($currentPage - 1) * $entriesPerPage;

    $query = "SELECT * FROM questions LIMIT $offset, $entriesPerPage";
    $query_run = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
            
            .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
            padding: 5px;
            transition: color 0.3s;
        }

        .edit-btn {
            color: var(--secondary-color);
        }

       

        .delete-btn {
            color: #e74c3c;
        }

      
            
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f6f9;
            --text-color: #333;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        h2 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        .question-form {
            margin-bottom: 30px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        tbody tr {
            background-color: var(--card-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        tbody tr:hover {
            transform: translateY(-3px);
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn {
            background-color: var(--secondary-color);
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style-type: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 5px;
            transition: all 0.3s;
        }

        .pagination a:hover,
        .pagination .active a {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Manage Questions</h2>
        
        <form method="post" action="question.php" class="question-form">
            <textarea class="form-control" name="question_text" placeholder="Add your question here..." rows="3"></textarea>
            <input type="hidden" name="id" value="some_id_value">
            <input type="hidden" name="rate" value="some_rate_value">
            <button type="submit" class="btn btn-primary" name="save_question" style="margin-top: 10px;">Submit Question</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>5</th>
                    <th>4</th>
                    <th>3</th>
                    <th>2</th>
                    <th>1</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query_run as $question) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($question['id']); ?></td>
                        <td><?= htmlspecialchars($question['question_text']); ?></td>
                        <td><input type="radio" name="rate_<?= $question['id']; ?>" value="5"></td>
                        <td><input type="radio" name="rate_<?= $question['id']; ?>" value="4"></td>
                        <td><input type="radio" name="rate_<?= $question['id']; ?>" value="3"></td>
                        <td><input type="radio" name="rate_<?= $question['id']; ?>" value="2"></td>
                        <td><input type="radio" name="rate_<?= $question['id']; ?>" value="1"></td>
                    <td>
                            
                            <form action="dbcon.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($question['id']); ?>">
                                <button type="submit" name="delete_question" class="action-btn delete-btn" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <ul class="pagination">
            <li class="<?= $currentPage <= 1 ? 'disabled' : ''; ?>">
                <a href="?page=<?= $currentPage - 1; ?>">Previous</a>
            </li>
            <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                <li class="<?= $page == $currentPage ? 'active' : ''; ?>">
                    <a href="?page=<?= $page; ?>"><?= $page; ?></a>
                </li>
            <?php endfor; ?>
            <li class="<?= $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                <a href="?page=<?= $currentPage + 1; ?>">Next</a>
            </li>
        </ul>

      
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>

<?php
}
include('includes/footer.php');
?>