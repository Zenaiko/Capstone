let img_showcase;
let img_files;
let reader = new FileReader();
var agreement_terms_conditions = document.getElementById("agreement_terms_conditions");

$(".seller_sign_img").change(function(event){
    const file = this.files[0];
    if (file && file.size > 2 * 1024 * 1024) { // 2 MB limit
        Swal.fire({
            title: 'Image exceeds 2mb',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
        this.value = ''; // Reset the input
    }else{
        prev_img = ($(this).attr("id")) + "_img_prev";
        const img_show = (document.getElementById(prev_img));
        img_files = event.target.files;
        Array.from(img_files).forEach(file => {
            reader.onload = function(e) {  
            img_show.src = e.target.result; 
        };
            reader.readAsDataURL(file);
        });
    }
});

$("#seller_sign_submit").click((event)=>{
    if(!agreement_terms_conditions.checked){
        event.preventDefault();
        Swal.fire({
            title: 'You must agree to the terms and conditions to proceed.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    }
})

$("#bs_info_back").click((event)=>{
    event.preventDefault();
    window.history.back();
})


