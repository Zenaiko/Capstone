

let item_subtotal = 0;
function num_extact(text) {
    const num_text = $(text).text();
    const num = num_text.match(/[\d]+(\.\d+)?/); 
    return num ? parseFloat(num[0]) : null;
}

$('.item-price').each(function() {
    const item_price = num_extact($(this));
    item_subtotal += parseFloat(parseFloat(item_price)) || 0;
});

$("#order_subtotal").text("₱" + item_subtotal.toFixed(2));

const shipping_fee = num_extact("#shipping_fee");
const total_pay = (parseFloat(shipping_fee) + parseFloat(item_subtotal));

$("#total_payement").text("₱" + total_pay.toFixed(2));

$("#order_rqst_form").on("submit", function(event){
    const pickup_id = document.getElementById("pickup_id");
    if (!pickup_id) {
        event.preventDefault();
        Swal.fire({
            title: 'No Address Provided',
            text: 'Please provide a pickup address location',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    }
});
//Off Canvas
document.getElementById('address_form').addEventListener('submit', function(event) {
    event.preventDefault();

    let selectedAddress = document.querySelector('input[name="address"]:checked');

    if (selectedAddress) {
       
        const pickupName = selectedAddress.getAttribute('data-pickup');
        const recipientName = selectedAddress.getAttribute('data-recipient');
        const contact = selectedAddress.getAttribute('data-contact');
        const address = selectedAddress.getAttribute('data-address');
        
        document.getElementById('pickup-name').innerText = pickupName;
        document.getElementById('recipient-name').innerText = recipientName;
        document.getElementById('contact').innerText = `(${contact})`;
        document.getElementById('shipping-address').innerText = address;

        const offcanvas = new bootstrap.Offcanvas(document.getElementById('addressOffCanvas'));
        offcanvas.hide();
    } else {
        alert("Please select an address.");
    }
});

function goBack() {
    window.history.back();
}