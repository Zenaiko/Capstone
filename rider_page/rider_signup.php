<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
            background-color: #f8f9fa; /* Optional background color */
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            width: 100%; /* Full width */
            max-width: 600px; /* Maximum width for the form */
            padding: 20px; /* Padding around the form */
            background: white; /* Background color of the form */
            border-radius: 8px; /* Rounded corners */
        }
        .hidden { display: none; }
        .form-step { display: none; }
        .form-step-active { display: block; }
        .error { color: red; font-size: 0.9em; }
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .next-btn, .prev-btn, .submit-btn {
            width: 150px;
        }
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px; 
        }
        /* Adjusting input field width */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%; /* Full width of the container */
            padding: 10px; /* Padding inside the input fields */
            margin-bottom: 10px; /* Space between input fields */
            border-radius: 4px; /* Rounded corners for inputs */
            border: 1px solid #ced4da; /* Border style */
        }
        /* Optional: Adding hover effect on buttons */
        .btn {
            cursor: pointer; /* Change cursor on hover */
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php require_once("../utilities/initialize.php");?>
    <div class="container mt-5">
        <form id="multiStepForm">
            <!-- Form 1: Personal Information -->
            <div class="form-step form-step-active">
            <h4 class="form-title">Sign Up</h4>
                <div class="mb-3">
                    <label for="firstName" class="form-label" required>First Name</label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Middle Name (*Optional*)</label>
                    <input type="text" class="form-control" name="middle_name" id="middleName">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" required>Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label" required>Username</label>
                    <input type="text" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label" required>Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label" required>Re-enter Password</label>
                    <input type="password" class="form-control" id="confirmPassword" required>
                </div>
                <div class="error hidden" id="passwordError">Passwords do not match.</div>
                <div class="button-group">
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
                <div class="footer">
            <p>Already have an account? <a href=" ">Sign In</a></p>
        </div>
            </div>

            <!-- Form 2: Rider Info -->
            <div class="form-step">
            <h4 class="form-title">Rider Information</h4>
                <div class="mb-3">
                    <label for="nbiClearance" class="form-label" required>NBI or Police Clearance</label>
                    <input type="file" class="form-control" id="nbiClearance" required>
                </div>
                <div class="mb-3">
                    <label for="brgyClearance" class="form-label" required>Barangay Clearance</label>
                    <input type="file" class="form-control" id="brgyClearance" required>
                </div>
                <div class="mb-3">
                    <label for="drugTest" class="form-label" required>Drug Test</label>
                    <input type="file" class="form-control" id="drugTest" required>
                </div>
                <div class="mb-3">
                    <label for="ridersLicense" class="form-label" required>Rider's License</label>
                    <input type="file" class="form-control" id="ridersLicense" required>
                </div>
                <div class="mb-3">
                    <label for="selfie" class="form-label" required>Selfie</label>
                    <input type="file" class="form-control" id="selfie" required>
                </div>
                <div class="mb-3">
                    <label for="eSignature" class="form-label" required>Electronic Signature</label>
                    <input type="file" class="form-control" id="eSignature" required>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Form 3: Vehicle Info -->
            <div class="form-step">
            <h4 class="form-title">Vehicle Information</h4>
                <div class="mb-3">
                    <label for="vehicleType" class="form-label" required>Vehicle Type</label>
                    <input type="text" class="form-control" id="vehicleType" required>
                </div>
                <div class="mb-3">
                    <label for="registrationPhoto" class="form-label" required>Registration Photo</label>
                    <input type="file" class="form-control" id="registrationPhoto" required>
                </div>
                <div class="mb-3">
                    <label for="orCr" class="form-label">OR or CR</label>
                    <input type="file" class="form-control" name="or_cr" id="or_cr" required>
                </div>
                <div class="mb-3">
                    <label for="vehiclePlate" class="form-label">Vehicle Coding or Plate Number</label>
                    <input type="text" class="form-control" id="vehiclePlate" required>
                </div>
                <div class="mb-3">
                    <label for="dealerCert" class="form-label">Dealer Certificate</label>
                    <input type="file" class="form-control" id="dealerCert" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="isOwner">
                    <label class="form-check-label" for="isOwner">I am the owner of the vehicle</label>
                </div>
                <div id="supportingDocs" class="hidden">
                    <div class="mb-3">
                        <label for="supportingDocuments" class="form-label">Upload Supporting Documents</label>
                        <input type="file" class="form-control"name="supporting_documents" id="supportingDocuments">
                    </div>
                </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Form 4: Health Documents -->
            <div class="form-step">
            <h4 class="form-title">Health Documents</h4>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="isSenior">
                    <label class="form-check-label" for="isSenior">I am a senior</label>
                </div>
                <div id="seniorDocs" class="hidden">
                    <div class="mb-3">
                        <label for="certID" class="form-label">Certificate ID</label>
                        <input type="text" class="form-control" name="medical_certificate" id="certID">
                    </div>
                    <div class="mb-3">
                        <label for="fitToWork" class="form-label">Certificate Photo (Fit to Work)</label>
                        <input type="file" class="form-control" name="medical_image" id="fitToWork">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="disabilityInfo" class="form-label">Disability (Optional)</label>
                    <input type="text" class="form-control" id="disabilityInfo">
                </div>
                <div class="mb-3">
                    <label for="medicalAssurance" class="form-label">Medical Assurance</label>
                    <input type="file" class="form-control" name="assurance_image" id="medicalAssurance">
                </div>
                <div class="mb-3">
                    <input type="radio" class="form-control" name="terms_conditions_radio" id="">
                    <label for="terms_conditions_radio" class="form-label">Accept Terms and Conditions</label>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <input type="submit" class="btn btn-success submit-btn">
                </div>
            </div>
        </form>
    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nextButtons = document.querySelectorAll('.next-btn');
            const prevButtons = document.querySelectorAll('.prev-btn');
            const steps = document.querySelectorAll('.form-step');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const passwordError = document.getElementById('passwordError');
            const isOwner = document.getElementById('isOwner');
            const supportingDocs = document.getElementById('supportingDocs');
            const isSenior = document.getElementById('isSenior');
            const seniorDocs = document.getElementById('seniorDocs');

            let currentStep = 0;

            nextButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    steps[currentStep].classList.remove('form-step-active');
                    currentStep++;
                    steps[currentStep].classList.add('form-step-active');
                });
            });

            prevButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    steps[currentStep].classList.remove('form-step-active');
                    currentStep--;
                    steps[currentStep].classList.add('form-step-active');
                });
            });

            password.addEventListener('input', validatePasswords);
            confirmPassword.addEventListener('input', validatePasswords);

            isOwner.addEventListener('change', function () {
                supportingDocs.classList.toggle('hidden', !isOwner.checked);
            });

            isSenior.addEventListener('change', function () {
                seniorDocs.classList.toggle('hidden', !isSenior.checked);
            });

            function validatePasswords() {
                const isMatch = password.value === confirmPassword.value;
                passwordError.classList.toggle('hidden', isMatch);
                nextButtons[0].disabled = !isMatch;
            }
        });
    </script>

</body>
</html>
