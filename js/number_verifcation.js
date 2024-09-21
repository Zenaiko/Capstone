var otp_send_code = document.getElementById('otp_send_code');

otp_send_code.addEventListener('click' , function(){
    event.preventDefault();
    const opt_phone = document.getElementById('opt_phone').value;
    fetch('db_api/db_get.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ otp_number: opt_phone }) // Sending the variable
    }).then(contact_json => contact_json.json())
    .then(contact_info => {
        if (contact_info.exists !== true){
            window.location.assign("otp.php");
        }
        else if (contact_info.exists !== false){
            Swal.fire({
                icon: "error",
                title: "Number exists",
                text: "The number that you have provided is already in the system"
              });
        }
    })
})