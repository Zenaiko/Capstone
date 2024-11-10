<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php require_once("../utilities/initialize.php"); 
        require_once("../db_api/db_get.php");
        $rider_req = $get_db->get_rider_request();
?>


<section id="dummy_section">
    <div id="dummy_container">
        <?php foreach($rider_req as $rider){ ?>
            <div class="indiv_request_container">
                <div class="container_one">
                    <p><?=$rider["username"]?></p>
                </div>
                <div class="container_two">
                    <button class="accept_req" id="<?=$rider['employee_registration_id']?>">Accept</button>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>
</section>

<script>
    $(".accept_req").on('click' , function(){
    const id = $(this).attr('id');
    $.ajax({
        url: '../db_api/db_get_ajax.php',
        type: 'POST',
        data: {rider_id: id},
        success: function(r){
            console.log(r);
        }
    })
    });
</script>

</body>
</html>