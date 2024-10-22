<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <style>
        .hidden { display: none; }
        .form-step { display: none; }
        .form-step-active { display: block; }
        .error { color: red; font-size: 0.9em; }
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }.button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px; 
        }
        .mb-3 { 
            margin-bottom: 1.5rem; 
        }

        .next-btn, .prev-btn, .submit-btn {
            width: 150px;
        }
        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px; 
        }   
    </style>
</head>
<body>
<?php require_once("../utilities/initialize.php");?>
    <div class="container mt-5">
        <form id="multiStepForm">
            <!-- Form 1: Personal Information -->
            <div class="form-step form-step-active">
                <h4 class="mb-4">Personal Information</h4>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Re-enter Password</label>
                    <input type="password" class="form-control" id="confirmPassword" required>
                </div>
                <div class="error hidden" id="passwordError">Passwords do not match.</div>
                <div class="button-group">
                    <button type="button" class="btn btn-primary next-btn" disabled>Next</button>
                </div>
            </div>

            <!-- Form 2: Rider Info -->
            <div class="form-step">
                <h4 class="mb-4">Rider Info</h4>
                <div class="mb-3">
                    <label for="nbiClearance" class="form-label">NBI or Police Clearance</label>
                    <input type="file" class="form-control" id="nbiClearance" required>
                </div>
                <div class="mb-3">
                    <label for="brgyClearance" class="form-label">Brgy Clearance</label>
                    <input type="file" class="form-control" id="brgyClearance" required>
                </div>
                <div class="mb-3">
                    <label for="drugTest" class="form-label">Drug Test</label>
                    <input type="file" class="form-control" id="drugTest" required>
                </div>
                <div class="mb-3">
                    <label for="ridersLicense" class="form-label">Rider's License</label>
                    <input type="file" class="form-control" id="ridersLicense" required>
                </div>
                <div class="mb-3">
                    <label for="selfie" class="form-label">Selfie</label>
                    <input type="file" class="form-control" id="selfie" required>
                </div>
                <div class="mb-3">
                    <label for="eSignature" class="form-label">Electronic Signature</label>
                    <input type="file" class="form-control" id="eSignature" required>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Form 3: Vehicle Info -->
            <div class="form-step">
                <h4 class="mb-4">Vehicle Info</h4>
                <div class="mb-3">
                    <label for="vehicleType" class="form-label">Vehicle Type</label>
                    <select class="form-control" id="vehicleType" required>
                        <option value="motorcycle">Motorcycle</option>
                        <option value="bicycle">Car</option>
                      </select>
                </div>
                <div class="mb-3">
                    <label for="registrationPhoto" class="form-label">Registration Photo</label>
                    <input type="file" class="form-control" id="registrationPhoto" required>
                </div>
                <div class="mb-3">
                    <label for="orCr" class="form-label">OR or CR</label>
                    <input type="file" class="form-control" id="orCr" required>
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
                    <input type="file" class="form-control" id="supportingDocuments">
                </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Form 4: Health Documents -->
            <div class="form-step">
                <h4 class="mb-4">Health Documents</h4>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="isSenior">
                    <label class="form-check-label" for="isSenior">I am a senior</label>
                </div>
                <div id="seniorDocs" class="hidden">
                    <div class="mb-3">
                        <label for="certID" class="form-label">Certificate ID</label>
                        <input type="text" class="form-control" id="certID">
                    </div>
                    <div class="mb-3">
                        <label for="fitToWork" class="form-label">Certificate Photo (Fit to Work)</label>
                        <input type="file" class="form-control" id="fitToWork">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="disabilityInfo" class="form-label">Disability (Optional)</label>
                    <input type="text" class="form-control" id="disabilityInfo">
                </div>
                <div class="mb-3">
                    <label for="medicalAssurance" class="form-label">Medical Assurance</label>
                    <input type="file" class="form-control" id="medicalAssurance">
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
