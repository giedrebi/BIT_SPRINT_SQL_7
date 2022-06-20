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
    <div style="text-align:center; margin: 30px;">
        <h1>Welcome to Project Management System!</h1>
        <p>Here you can add, update, delete projects and employees.</p>
    </div>
    <footer class="bg-light">
        <p id='footer'> Copyright © <script>
                document.write(new Date().getFullYear())
            </script> Giedre Bielske</p>
    </footer>
</body>

</html>