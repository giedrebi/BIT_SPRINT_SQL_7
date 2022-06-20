<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        section {
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

        #project {
            margin: auto;
            margin-bottom: 20px;
            width: 50%;
        }

        .btn {
            margin: 5px;
        }

        .btn:hover {
            border: 1px solid #5f6caf;
            color: #5f6caf;
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
    <?php
    require_once "connection.php";

    if (isset($_POST['create_empl'])) {
        $stmt = $conn->prepare("INSERT INTO Employees (fullname , project) VALUES (?, ?)");
        $stmt->bind_param("ss", $fullname, $project);
        $fullname = $_POST['fullname'];
        $project = $_POST['project'];
        $stmt->execute();
        $stmt->close();
        header("location: employees.php");
        die;
    }

    $sql_project = "SELECT * FROM projects";
    $all_projects = mysqli_query($conn, $sql_project);
    $conn->close();

    print('
    <section>
    <h2>Add New Employee</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="fullname">Name and surname:</label><br>
            <input type="text" id="fullname" name="fullname" value="John Doe"><br><br>
        </div>
        <div class="form-group">
            <label for="project">Project:</label>
            <select class="form-control" id="project" name="project">');

    // OPTION TO ASSIGN PROJECT FROM EXISTING LIST IN DB (PROJECTS TABLE)
    while ($projects = mysqli_fetch_array($all_projects, MYSQLI_ASSOC)) : {
            print('<option>');
            echo $projects["project"];
            print('</option>');
        }
    endwhile;

    print('</select>
            </div>
            <input class="btn add" type="submit" name="create_empl" value="Submit">
        </form>
        </section>');
    ?>
    <footer class="bg-light">
        <p id='footer'> Copyright © <script>
                document.write(new Date().getFullYear())
            </script> Giedre Bielske</p>
    </footer>
</body>

</html>