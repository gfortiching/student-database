<?php

include_once("Connections/connection.php");
$con = connection();
$search = $_GET['search'];

$sql = "SELECT * FROM student_info WHERE First_Name LIKE '%$search%' || Last_Name LIKE '%$search%' ORDER BY id DESC";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="user-accounts">
        <ul>
            <li>Student Database</li>
            <li>
                <a class="home" href="home.php">Home</a>
            </li>
            <li class="greetings">
                <?php if (!isset($_SESSION)) {
                    session_start();
                }

                if (isset($_SESSION["UserLogin"])) {
                    echo "Welcome, " . $_SESSION['UserLogin'] . "!";
                } else {
                    echo "Welcome Guest";
                } ?>
            </li>
            <li class="login-logout">
                <?php if (isset($_SESSION['UserLogin'])) { ?>
                    <a href=" logout.php">Logout</a>
                <?php } else { ?>

                    <a href="login.php">Login</a>
                <?php } ?>
            </li>
        </ul>
    </nav>

    <main class="table-section">
        <div class="insert">
            <a href="insert.php">Insert New Student Info</a>
        </div>
        <form class="search" action="result.php" method="get">
            <input type="text" name="search" id="search" />
            <button class="search-button" type="submit">Search</button>
        </form>
        <table>
            <caption class="caption-top">List of Students</caption>
            <thead>
                <tr>
                    <th>View</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birth Date</th>
                </tr>
            </thead>
            <tbody>
                <?php do { ?>
                    <?php if ($row == null) { ?>
                        <h2 style=" color: red;">Student Information Not Found</h2>
                    <?php } else { ?>
                        <tr>
                            <td class="view">
                                <a href="details.php?ID=<?php echo $row['ID']; ?>">view info</a>
                            </td>
                            <td>
                                <?php echo $row['ID']; ?>
                            </td>
                            <td>
                                <?php echo $row['First_Name']; ?>
                            </td>
                            <td>
                                <?php echo $row['Last_Name']; ?>
                            </td>
                            <td>
                                <?php echo $row['Gender']; ?>
                            </td>
                            <td>
                                <?php echo $row['Birth_Date']; ?>
                            </td>
                        </tr>
                    <?php } ?>

                <?php } while ($row = $students->fetch_assoc()) ?>
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>