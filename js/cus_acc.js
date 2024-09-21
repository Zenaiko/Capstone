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
            fetch('../db_api/db_get.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({action: 'get_is_seller'}) // Sending the variable
                }).then(is_seller => is_seller.json())
                // Check if customer is a seller
                .then(seller_info => {
                    if(seller_info.is_seller !== false){
                        redirect = 'seller_item_page.php';
                    }else{
                        redirect = 'sign_up_seller.php';
                    }
                    window.location.assign(redirect);
                    })
            return;
        default:
            redirect = '';
    }
    window.location.assign(redirect);

});

