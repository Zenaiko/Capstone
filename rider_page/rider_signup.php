<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Sign Up</title>
    <link rel="icon" type="icon" href="../assets/cab_mart_logo.png">
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
        <form action="../db_api/db_sign_up_rider.php" method="POST" enctype="multipart/form-data" id="multiStepForm">
            <!-- Form 1: Personal Information -->
            <div class="form-step form-step-active">
            <h4 class="form-title">Sign Up</h4>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="firstName" >
                </div>
                <div class="mb-3">
                    <label for="middleName" class="form-label">Middle Name (*Optional*)</label>
                    <input type="text" name="middle_name" class="form-control" id="middleName">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="lastName" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" >
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" >
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" >
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Re-enter Password</label>
                    <input type="password" class="form-control" id="confirmPassword" >
                </div>
                <div class="error hidden" id="passwordError">Passwords do not match.</div>
                <div class="button-group">
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
                <div class="footer">
            <p>Already have an account? <a href="rider_login.php">Sign In</a></p>
        </div>
            </div>

            <!-- Form 2: Rider Info -->
            <div class="form-step">
            <h4 class="form-title">Rider Information</h4>
                <div class="mb-3">
                    <label for="nbiClearance" class="form-label" >NBI or Police Clearance</label>
                    <input type="file" name="nbi_police" class="form-control" id="nbiClearance" >
                </div>
                <div class="mb-3">
                    <label for="brgyClearance" class="form-label">Barangay Clearance</label>
                    <input type="file" name="brngy_clearance" class="form-control" id="brgyClearance" >
                </div>
                <div class="mb-3">
                    <label for="drugTest" class="form-label">Drug Test</label>
                    <input type="file" name="drug_test" class="form-control" id="drugTest" >
                </div>
                <div class="mb-3">
                    <label for="ridersLicenseNumber" class="form-label">Driver's License Number</label>
                    <input type="text" name="license_number" class="form-control" id="ridersLicenseNumber" >
                </div>
                <div class="mb-3">
                    <label for="ridersLicense" class="form-label">Driver's License Photo</label>
                    <input type="file" name="license_photo" class="form-control" id="ridersLicense" >
                </div>
                <div class="mb-3">
                    <label for="selfie" class="form-label">Selfie</label>
                    <input type="file" name="selfie" class="form-control" id="selfie" >
                </div>
                <div class="mb-3">
                    <label for="eSignature" class="form-label">Electronic Signature</label>
                    <input type="file" name="signature" class="form-control" id="eSignature" >
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
                    <label for="vehicleType" class="form-label">Vehicle Type</label>
                    <input type="text" name="vehicle_type" class="form-control" id="vehicleType" >
                </div>
                <div class="mb-3">
                    <label for="registrationPhoto" class="form-label">Vehicle Registration Photo</label>
                    <input type="file" name="vehicle_registration" class="form-control" id="registrationPhoto" >
                </div>
                <div class="mb-3">
                    <label for="orCr" class="form-label">Vehicle Officaial Receipt(OR) or Certificate of Registration(CR)</label>
                    <input type="file" name="or_cr" class="form-control" id="orCr" >
                </div>
                <div class="mb-3">
                    <label for="vehiclePlate" class="form-label">Vehicle Coding or Plate Number</label>
                    <input type="text" name="coding_number" class="form-control" id="vehiclePlate" >
                </div>
                <div class="mb-3">
                    <label for="dealerCert" class="form-label">Dealer Certificate</label>
                    <input type="file" name="dealer_certificate" class="form-control" id="dealerCert" >
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="is_owner" class="form-check-input" id="isOwner">
                    <label class="form-check-label" for="isOwner">I am the owner of the vehicle</label>
                </div>
                <div id="supportingDocs" class="hidden">
                    <div class="mb-3">
                        <label for="supportingDocuments" class="form-label">Upload Supporting Documents</label>
                        <input type="file" class="form-control" name="supporting_documents" id="supportingDocuments">
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
                        <label for="certID" class="form-label">Medical Certificate ID (Fit to Work)</label>
                        <input type="text" name="medical_certificate_id" class="form-control" id="certID">
                    </div>
                    <div class="mb-3">
                        <label for="fitToWork" class="form-label">Medical Certificate Photo</label>
                        <input type="file" name="medical_certificate" class="form-control" id="fitToWork">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="disabilityInfo" class="form-label">Disability or Comorbidity (Leave as blank if none)</label>
                    <input type="text" name="disability_comorbidity" class="form-control" id="disabilityInfo">
                </div>
                <div class="mb-3">
                    <label for="medicalAssurance" class="form-label">Medical Assurance (Don't upload if none)</label>
                    <input type="file" name="medical_assurance" class="form-control" id="medicalAssurance">
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
