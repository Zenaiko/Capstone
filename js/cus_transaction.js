$(".recieve_button").click(function(){
  const transaction_id = $(this).data('transaction_id');
  Swal.fire({
    title: 'Confirm Receipt',
    text: "Are you sure you want to confirm your order?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, confirm it!',
    cancelButtonText: 'No, cancel it!'
    }).then((result) => {
      if(result.isConfirmed){
        $.ajax({
          url: "../db_api/db_cus_transaction.php",
          type: "POST",
          data: {transaction_id:transaction_id, action:"recieve"},
          success:function(res){
            console.log(res);
            Swal.fire(
            'Confirmed!',
            'The order has been confirmed.',
            'success'
          ).then(()=>{
            location.reload();
          })
          }
        });
      }
    });
});

  
//   function requestRefund(orderId) {
//   Swal.fire({
//   title: 'Request Refund',
//   text: "Please provide a reason for the refund:",
//   input: 'textarea',
//   inputPlaceholder: 'Enter your reason here...',
//   showCancelButton: true,
//   confirmButtonColor: '#dc3545',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Submit Refund Request',
//   preConfirm: (reason) => {
//   if (!reason) {
//   Swal.showValidationMessage('Please enter a reason for the refund.');
//   } else {
//   return reason;
//   }
//   }
//   }).then((result) => {
//   if (result.isConfirmed) {
//   Swal.fire(
//   'Requested!',
//   'Your refund request has been submitted with the reason: ' + result.value,
//   'success'
//   );
//   document.querySelector(`button[onclick="requestRefund(${orderId})"]`).style.display = 'none';
//   }
//   });
//   }