var sign_up_submit = document.getElementById('sign_up_submit');

sign_up_submit.addEventListener('click' , () =>{
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