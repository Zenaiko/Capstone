<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #20263e;
        }
        h1 {
            color: #508D4E;
        }
        .accordion-button:not(.collapsed) {
            background-color: #40A578;
            color: #fff;
        }
        .btn-link {
            color: #508D4E;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php require_once('../utilities/back_button.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Help Center</h1>
    <!-- Accordion for Help Center Sections -->
    <div class="accordion" id="helpCenterAccordion">

        <!-- Help Section -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="help">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#helpcent" aria-expanded="false" aria-controls="helpcent">
                    Frequently Asked questions
                </button>
            </h2>
            <div id="helpcent" class="accordion-collapse collapse" aria-labelledby="help" data-bs-parent="#helpCenterAccordion">
                <div class="accordion-body">
                    <p><strong>How to become a seller? </strong> Navigate to user below the search and there you can see My Store click it to open and then fill the needed documents and wait for verification.</p>
                    <p><strong>How to cancel an order? </strong>  Navigate to user below the search and click requesting there you can see cancel order click it and wait for confirmation of the seller/rider</p>
                    <p><strong>How to delete an account? </strong> Contact us in the information below so we can assist you in every step needed to cancel/close you account</p>
                    <p><strong>How to report a seller or a rider?</strong> If you have any complain regarding a driver/seller please contact us and we will resolve the issue</p>
                    <p><strong>What would I do if am not available for the order pick up? </strong> Please contact the rider if the pickup will be unavailable and to cancel the order or reschedule</p>
                    <p><strong>How to check the estimated time of the delivery? </strong> By looking at the receipt that is generated the information will be shown including the rider contact details and the estimated time of arival</p>
                    <p><strong>Can I cancel my order? </strong> You can cancel the order anytime you want by going to the requesting and clicking cancel</p>
                </div>
            </div>
        </div>

        <!-- Payment and Billing Section -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="paymentBillingHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paymentBilling" aria-expanded="false" aria-controls="paymentBilling">
                    Payment and Billing
                </button>
            </h2>
            <div id="paymentBilling" class="accordion-collapse collapse" aria-labelledby="paymentBillingHeader" data-bs-parent="#helpCenterAccordion">
                <div class="accordion-body">
                    <p><strong>Payment Methods:</strong> The available option to pay is via COD</p>
                    <p><strong>Billing FAQs:</strong> Find answers to questions about charges and transaction security.</p>
                </div>
            </div>
        </div>

        <!-- Returns, Refunds, and Exchanges Section -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="returnsRefundsHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#returnsRefunds" aria-expanded="false" aria-controls="returnsRefunds">
                    Returns, Refunds, and Exchanges
                </button>
            </h2>
            <div id="returnsRefunds" class="accordion-collapse collapse" aria-labelledby="returnsRefundsHeader" data-bs-parent="#helpCenterAccordion">
                <div class="accordion-body">
                    <p><strong>Return Policy:</strong> Review eligibility and return windows for each item.</p>
                </div>
            </div>
        </div>

        <!-- Account Management Section -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="accountManagementHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accountManagement" aria-expanded="false" aria-controls="accountManagement">
                    Account Management
                </button>
            </h2>
            <div id="accountManagement" class="accordion-collapse collapse" aria-labelledby="accountManagementHeader" data-bs-parent="#helpCenterAccordion">
                <div class="accordion-body">
                    <p><strong>Create an Account:</strong> Sign up <a href="#" class="btn-link">here</a> to enjoy exclusive features.</p>
                    <p><strong>Account Settings:</strong> Update your contact info, password, or saved addresses in <a href="#" class="btn-link">Account Settings</a>.</p>
                </div>
            </div>
        </div>

        <!-- Product Information Section -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="productInfoHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#productInfo" aria-expanded="false" aria-controls="productInfo">
                    Product Information
                </button>
            </h2>
            <div id="productInfo" class="accordion-collapse collapse" aria-labelledby="productInfoHeader" data-bs-parent="#helpCenterAccordion">
                <div class="accordion-body">
                    <p><strong>Product FAQs:</strong> Details on sizing, materials, and care instructions.</p>
                    <p><strong>Product Availability:</strong> Check stock status and restock notifications.</p>
                </div>
            </div>
        </div>

        <!-- Contact Us Section -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="contactUsHeader">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactUs" aria-expanded="false" aria-controls="contactUs">
                    Contact Us
                </button>
            </h2>
            <div id="contactUs" class="accordion-collapse collapse" aria-labelledby="contactUsHeader" data-bs-parent="#helpCenterAccordion">
                <div class="accordion-body">
                    <p><strong>Email:</strong> Reach out at <a href="hotdogseller@gmail.com" class="btn-link">hotdogseller@gmail.com</a>.</p>
                    <p><strong>Phone:</strong> Call us at (+63) 999-999-9999, Mon-Fri, 9 am - 6 pm.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
