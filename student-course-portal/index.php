<?php
require ('nusoap/lib/nusoap.php');

$client = new nusoap_client('http://localhost:8080/new/student-course-portal/server/soap_service.php?wsdl');

$error = '';
$courses = '';

if (isset($_POST['student_name'])) {
    $studentName = $_POST['student_name'];
    $result = $client->call('getCoursesByStudentName', array('studentName' => $studentName));

    if ($client->fault) {
        $error = "Error: " . (is_array($result) ? $result['faultstring'] : print_r($result, true));
    } else {        $error = $client->getError();
        if ($error) {
            $error = "Error: <br>" . $error;
        } else {
            $courses = explode(', ', $result);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="display-6 my-2">STUDENT COURSE PORTAL 3T 2024-2025</h1>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="mb-4">
                            <div class="mb-3">
                                <label for="student_name" class="form-label fw-bold">Enter Student Name:</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" required placeholder="e.g., John Doe">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Get Courses</button>
                            </div>
                        </form>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($courses): ?>
                            <div class="card border-primary mt-4">
                                <div class="card-header bg-primary text-white">
                                    <h2 class="h5 mb-0">Courses for <?php echo htmlspecialchars($studentName); ?>:</h2>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($courses as $course): ?>
                                            <li class="list-group-item"><?php echo htmlspecialchars($course); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>                            
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>