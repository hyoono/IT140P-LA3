<?php
require_once('../nusoap/lib/nusoap.php');

$client = new nusoap_client('http://localhost:8080/student-course-portal/server/soap_service.php?wsdl', true);

$error = '';
$courses = '';

if ($_POST) {
    $studentName = $_POST['student_name'];
    $result = $client->call('getCoursesByStudentName', array('name' => $studentName));

    if ($client->fault) {
        $error = "Error: " . $result;
    } else {
        $error = $client->getError();
        if ($error) {
            $error = "Error: " . $error;
        } else {
            $courses = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT COURSE PORTAL 3T 2024-2025</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome to the STUDENT COURSE PORTAL 3T 2024-2025</h1>
    <form method="post" action="">
        <label for="student_name">Enter Student Name:</label>
        <input type="text" id="student_name" name="student_name" required>
        <input type="submit" value="Get Courses">
    </form>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($courses): ?>
        <div class="result">
            <h2>Courses for <?php echo htmlspecialchars($studentName); ?>:</h2>
            <ul>
                <?php foreach ($courses as $course): ?>
                    <li><?php echo htmlspecialchars($course); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>