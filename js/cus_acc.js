let redirect = '';
$('.cus_acc_body_content').click(function(){
    var id = (this.id).toLowerCase();

    switch(id){
        case 'account':
            redirect = 'cus_acc_edit_page.php';
            break;
        case 'address':
            redirect = '';
            break;
        case 'liked':
            redirect = '';
            break;
        case 'followed':
            redirect = '';
            break;
        case 'help':
            redirect = '';
            break;
        case 'store':
            redirect = 'sign_up_seller.php';
            break;
        default:
            redirect = '';
    }
    window.location.assign(redirect);

});

