# STUDENT COURSE PORTAL 3T 2024-2025

## Overview
The Student Course Portal is a SOAP-based web application that allows users to retrieve the courses taken by students for the academic year 2024-2025. This application utilizes the Nusoap library to implement the SOAP service and provides a user-friendly interface for interaction.

## Project Structure
```
student-course-portal
├── server
│   ├── soap_service.php      # Implements the SOAP server
│   └── dataset.php           # Contains the dataset of students and their courses
├── client
│   └── interface.php         # Client interface for the SOAP service
├── lib
│   └── nusoap.php            # Nusoap library for SOAP functionality
├── css
│   └── style.css             # Styles for the client interface
├── index.php                 # Entry point for the application
└── README.md                 # Documentation for the project
```

## Setup Instructions
1. **Download the Nusoap Library**: Ensure that the `nusoap.php` file is placed in the `lib` directory.
2. **Configure the Dataset**: Modify the `dataset.php` file in the `server` directory to include the necessary student data.
3. **Run the Application**: Access `index.php` through a web server that supports PHP to interact with the SOAP service.

## Usage
- Open the application in a web browser.
- Enter the complete name of the student in the provided form.
- Submit the form to retrieve the courses for the specified student.
- If the student is not found, a fault message will be displayed indicating "Record not found for: [Student Name]".

## Fault Handling
The application is designed to handle cases where a student's information is not found. In such cases, the SOAP service will return a fault with a clear message indicating the absence of the record.

## License
This project is open-source and can be modified and distributed under the terms of the MIT License.