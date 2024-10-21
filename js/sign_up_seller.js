let img_showcase;
let img_files;
let reader = new FileReader();
$(".seller_sign_img").change(function(event){
    prev_img = ($(this).attr("id")) + "_img_prev";
    const img_show = (document.getElementById(prev_img));
    img_files = event.target.files;
    Array.from(img_files).forEach(file => {
        reader.onload = function(e) {  
        img_show.src = e.target.result; 
    };
        reader.readAsDataURL(file);
    });
});