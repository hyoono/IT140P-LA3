<?php
require (__DIR__ . '/../nusoap/lib/nusoap.php');
require (__DIR__ . '/dataset.php');

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

$server = new nusoap_server();
$server->configureWSDL('student-course-portal', 'urn:student-course-portal');

$server->register('getCoursesByStudentName', 
    array('studentName' => 'xsd:string'), 
    array('return' => 'xsd:string'),
    'urn:student-course-portal',
    'urn:student-course-portal#getCoursesByStudentName'
);

function getCoursesByStudentName($studentName) {
    global $students_courses;

    if (isset($students_courses[$studentName])) {
        return implode(', ', $students_courses[$studentName]);
    } else {
        return new soap_fault('Client', '', "Record not found for: $studentName", "The student name '$studentName' was not found in our database.");
    }
}

$server->service(file_get_contents("php://input"));