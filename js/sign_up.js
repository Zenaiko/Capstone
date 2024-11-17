var sign_up_submit = document.getElementById('sign_up_submit');
var terms_conditions_radio = document.getElementById('terms_conditions_radio');

sign_up_submit.addEventListener('click' , (event) =>{
    var password_sign_up = document.getElementById('password_sign_up').value;
    var password_conform_sign_up = document.getElementById('password_conform_sign_up').value;
    if (password_conform_sign_up != password_sign_up) {
        event.preventDefault();
        Swal.fire({
            icon: "error",
            title: "Password does not match",
          });
    }
});

$('.bi-eye').on('click' , function(){
    const pass =  this.previousElementSibling;
    if(pass.type === "text"){
        pass.type = "password";
    }else if(pass.type === "password"){
        pass.type = "text"
    }
});

$("#sign_up_submit").click(function(event){
    if(!terms_conditions_radio.checked){
        event.preventDefault();
        Swal.fire({
            title: 'You must agree to the terms and conditions to proceed.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    }
});