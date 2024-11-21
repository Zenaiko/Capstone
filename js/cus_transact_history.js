var transaction_history_container = document.getElementById("transaction_history_container");

$(".transact_tab").click(function(){
    const history_status = $(this).data("tab-type");
    $.ajax({
        url: "../user_page/order_transaction_history.php",
        type: "POST",
        data: {history_status:history_status},
        success:(page)=>{
            transaction_history_container.innerHTML = page;
        },
    });
});
