<?php
require_once "connection.php";

$project = "";
$project_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $input_project = trim($_POST["project"]);
    if (empty($input_project)) {
        $project_err = "Please enter a project name.";
    } elseif (!filter_var($input_project, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $project_err = "Please enter a valid project name.";
    } else {
        $project = $input_project;
    }

    if (empty($project_err)) {
        $sql = "UPDATE projects SET project=? WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_project, $param_id);

            $param_project = $project;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM projects WHERE id = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $project = $row["project"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        .wrapper {
            text-align: center;
            background-color: #d5def5;
            border: 2px solid #5f6caf;
            border-radius: 10px;
            width: 500px;
            margin: auto;
            margin-top: 15px;
            padding: 20px;
        }

        input {
            border-radius: 5px;
            border: 1px solid white;
            padding: 5px;
        }

        .btn {
            margin: 5px;
        }

        .btn:hover {
            border: 1px solid #5f6caf;

            font-weight: bold;
        }

        .add {
            background: #5f6caf;
            color: white;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            padding-top: 20px;
        }

        #footer {
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Projects Management System</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="projects.php">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employees.php">Employees</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <h2>Update project</h2>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="form-group">
                <label>Project's name:</label>
                <input type="text" name="project" class="form-control <?php echo (!empty($project_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $project; ?>">
                <span class="invalid-feedback"><?php echo $project_err; ?></span>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="submit" class="btn add" value="Submit">
            <a href="projects.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
    <footer class="bg-light">
        <p id='footer'> Copyright © <script>
                document.write(new Date().getFullYear())
            </script> Giedre Bielske</p>
    </footer>
</body>

</html>