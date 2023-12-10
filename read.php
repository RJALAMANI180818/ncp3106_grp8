<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";  //tatawagin

    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Retrieve individual field value
                $studNum = $row['stud_Num'];
                $last_name = $row['surname'];
                $first_name = $row['first_name'];
                $middle_name = $row['middle_name'];
                $contact_number = $row['contact_number'];
                $email_address = $row['email_address'];
                $birthday = $row['birthday'];
                $year_level = $row['year_level'];
                $program = $row['program'];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Student Number</label>
                        <p><b><?php echo $row["stud_Num"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Surname</label>
                        <p><b><?php echo $row["surname"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <p><b><?php echo $row["first_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <p><b><?php echo $row["middle_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <p><b><?php echo $row["contact_number"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <p><b><?php echo $row["email_address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <p><b><?php echo $row["birthday"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Year Level</label>
                        <p><b><?php echo $row["year_level"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Program</label>
                        <p><b><?php echo $row["program"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>