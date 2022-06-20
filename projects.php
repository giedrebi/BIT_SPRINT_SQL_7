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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border: 2px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #d5def5;
        }

        table tr:hover {
            background-color: #d5def5;
            font-weight: bold;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background: #5f6caf;
            color: white;
        }

        .id,
        .project_name {
            text-align: center;
        }

        .actions {
            text-align: center;
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

        .delete {
            background: #ff8364;
        }

        .update {
            background: #ffb677;
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

    $sql =  "SELECT Projects.id, Projects.project, GROUP_CONCAT(Employees.fullname SEPARATOR ', ') AS fullname 
            FROM Projects
            LEFT JOIN Employees ON Projects.project = Employees.project
            GROUP BY Projects.id;";
    $result = $conn->query($sql);

    // LENTELES ATVAIZDAVIMAS
    if (mysqli_num_rows($result) > 0) {
        print("<table>");
        print("<thead>");
        print("<tr><th >ID</th><th>PROJECT</th><th>EMPLOYEES</th><th>ACTIONS</th></tr>");
        print("</thead>");
        print("<tbody>");
        while ($row = mysqli_fetch_assoc($result)) {
            print('<tr>'
                . '<td class="id">' . $row['id'] . '</td>'
                . '<td class="project_name">' . $row['project'] . '</td>'
                . '<td>' . $row['fullname'] . '</td>'
                . '<td class="actions">'
                . '<a href="?action=delete&id='  . $row['id'] . '"><button class="btn delete">DELETE</button></a>'
                . '<a href="updateproject.php?id='  . $row['id'] . '"><button class="btn update">UPDATE</button></a>'
                . '</td>'
                . '</tr>');
        }
        print("</tbody>");
        print("</table>");
    } else {
        echo "0 results";
    }

    // DELETE LOGIKA
    if (isset($_GET['action']) and $_GET['action'] == 'delete') {
        $sql = 'DELETE FROM Projects WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['id']);
        $res = $stmt->execute();
        $stmt->close();
        mysqli_close($conn);
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        die();
    }

    $conn->close();
    ?>
    <a href="createproject.php"><button class="btn add">ADD NEW PROJECT</button></a>
    <footer class="bg-light">
        <p id='footer'> Copyright © <script>
                document.write(new Date().getFullYear())
            </script> Giedre Bielske</p>
    </footer>
</body>

</html>