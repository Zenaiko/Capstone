<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="flex justify-center items-center min-h-screen bg-gray-100 p-6">
        <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-6">Multi-Step Registration Form</h2>
            <form id="multi-step-form">

                <!-- Form 1: Personal Information -->
                <div class="step">
                    <h3 class="text-lg font-semibold mb-4">Form 1: Personal Information</h3>
                    <label class="block mb-2">First Name</label>
                    <input type="text" name="first_name" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Last Name</label>
                    <input type="text" name="last_name" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Email</label>
                    <input type="email" name="email" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Username</label>
                    <input type="text" name="username" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Password</label>
                    <input type="password" id="password" name="password" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Re-enter Password</label>
                    <input type="password" id="reenter-password" name="reenter_password" class="border rounded w-full px-3 py-2 mb-4" required>
                    <p id="password-error" class="text-red-500 hidden">Passwords do not match.</p><br>

                    <div class="flex justify-between">
                        <button type="button" class="hidden"></button>
                        <button type="button" id="next-button" class="bg-green-500 text-white py-2 px-4 rounded next" disabled>Next</button>
                    </div>
                </div>

                <!-- Form 2: Rider Info -->
                <div class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Form 2: Rider Info</h3>
                    <label class="block mb-2">NBI or Police Clearance</label>
                    <input type="file" name="nbi_clearance" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Brgy Clearance</label>
                    <input type="file" name="brgy_clearance" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Drug Test</label>
                    <input type="file" name="drug_test" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Rider's License</label>
                    <input type="file" name="riders_license" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Selfie</label>
                    <input type="file" name="selfie" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Electronic Signature</label>
                    <input type="file" name="electronic_signature" class="border rounded w-full px-3 py-2 mb-4" required>

                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded prev">Previous</button>
                        <button type="button" class="bg-green-500 text-white py-2 px-4 rounded next">Next</button>
                    </div>
                </div>

                <!-- Form 3: Vehicle Info -->
                <div class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Form 3: Vehicle Info</h3>
                    <label class="block mb-2">Vehicle Type</label>
                    <input type="text" name="vehicle_type" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Registration Photo</label>
                    <input type="file" name="registration_photo" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">OR or CR</label>
                    <input type="file" name="or_cr" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Vehicle Coding or Plate Number</label>
                    <input type="text" name="plate_number" class="border rounded w-full px-3 py-2 mb-4" required>

                    <label class="block mb-2">Dealer Certificate</label>
                    <input type="file" name="dealer_certificate" class="border rounded w-full px-3 py-2 mb-4" required>

                    <input type="checkbox" class="mr-2" id="is-owner" name="is_owner">
                    <label for="is-owner">Owner</label><br><br>

                    <!-- Supporting Documents Section -->
                    <div id="owner-documents" class="hidden mt-4">
                        <label class="block mb-2">Upload Supporting Documents</label>
                        <input type="file" name="supporting_documents" class="border rounded w-full px-3 py-2 mb-4" required>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded prev">Previous</button>
                        <button type="button" class="bg-green-500 text-white py-2 px-4 rounded next">Next</button>
                    </div>
                </div>

                <!-- Form 4: Health Documents -->
                <div class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Form 4: Health Documents</h3>
                    <input type="checkbox" class="mr-2" id="is-senior" name="is_senior">
                    <label for="is-senior">Senior</label>

                    <div id="senior-documents" class="hidden mt-4">
                        <label class="block mb-2">Certificate ID</label>
                        <input type="text" name="certificate_id" class="border rounded w-full px-3 py-2 mb-4" required>

                        <label class="block mb-2">Certificate Photo (Fit to Work)</label>
                        <input type="file" name="certificate_photo" class="border rounded w-full px-3 py-2 mb-4" required>
                    </div>

                    <div class="mt-6">
                        <label class="block mb-2 font-bold">Disability (If non leave blank)</label>
                        <input type="text" name="disability" class="border rounded w-full px-3 py-2 mb-4">
                    </div>

                    <label class="block mb-2">Medical Assurance</label>
                    <input type="file" name="medical_assurance" class="border rounded w-full px-3 py-2 mb-4" required>

                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded prev">Previous</button>
                        <input type="submit" class="bg-green-500 text-white py-2 px-4 rounded" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Handle the multi-step form navigation
        const form = document.getElementById('multi-step-form');
        const steps = document.querySelectorAll('.step');
        let currentStep = 0;

        function showStep(step) {
            steps.forEach((s, index) => {
                s.classList.toggle('hidden', index !== step);
            });
        }

        document.querySelectorAll('.next').forEach((button) => {
            button.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
        });

        document.querySelectorAll('.prev').forEach((button) => {
            button.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
        });

        // Password validation
        const passwordInput = document.getElementById('password');
        const rePasswordInput = document.getElementById('reenter-password');
        const nextButton = document.getElementById('next-button');
        const passwordError = document.getElementById('password-error');

        rePasswordInput.addEventListener('input', () => {
            if (passwordInput.value !== rePasswordInput.value) {
                passwordError.classList.remove('hidden');
                nextButton.disabled = true;
            } else {
                passwordError.classList.add('hidden');
                nextButton.disabled = false;
            }
        });

        // Show/Hide supporting documents section based on owner checkbox
        const ownerCheckbox = document.getElementById('is-owner');
        const ownerDocuments = document.getElementById('owner-documents');

        ownerCheckbox.addEventListener('change', () => {
            ownerDocuments.classList.toggle('hidden', !ownerCheckbox.checked);
        });

        // Show/Hide senior documents section based on senior checkbox
        const seniorCheckbox = document.getElementById('is-senior');
        const seniorDocuments = document.getElementById('senior-documents');

        seniorCheckbox.addEventListener('change', () => {
            seniorDocuments.classList.toggle('hidden', !seniorCheckbox.checked);
        });

        // Initialize the first step
        showStep(currentStep);
    </script>
</body>
</html>
