<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        #dummy_section{
            width: 100%;
            display: flex;
            justify-content: center;
        }

        #dummy_container{
            width: 90%;
        }

        .req_img{
            width: 8rem;
            aspect-ratio: 1/1;
        }

        .container_one{
            display: flex;
            flex-direction: row;
        }

        .indiv_request_container{
            display: flex;
            justify-content: space-between;
        }

        .mrkt_name{
            align-self: flex-end;
        }
        .container_two{
            display: flex;
        }

        .accept_req{
            display: flex;
            align-self: center;
            height: fit-content;
        }

    </style>
</head>
<body>

    <?php require_once("../utilities/initialize.php"); 
        require_once("../db_api/db_get.php");
        $get_requests_db = $get_db->get_market_requests();
    ?>

    <section id="dummy_section">
        <div id="dummy_container">
            <?php foreach($get_requests_db as $markets_req){ ?>
                <div class="indiv_request_container">
                    <div class="container_one">
                        <img class="req_img" src="<?='../assets/tmp.png' ?>" alt="">
                        <p class="mrkt_name"><?=$markets_req['market_name']??'random' ?></p>
                    </div>
                    <div class="container_two">
                        <button class="accept_req" id="<?=$markets_req['market_request_id']?>">Accept</button>
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
            data: {req_id: id},
            success: function(){
            }
        })
        });

        
    </script>
</body>
</html>