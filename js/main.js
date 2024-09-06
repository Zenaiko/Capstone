const p_account_preference = document.getElementById('account_preference');
const a_main_form_changer =  document.getElementById('main_form_changer');
$(document).ready(function(){
    const location = window.location.href;
    if(location.includes('sign_up.php')){
        p_account_preference.innerHTML = "Already have an account?"
        a_main_form_changer.innerHTML = "Sign In";
        a_main_form_changer.href = "login.php";
    }
});
