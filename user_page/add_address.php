<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once("../utilities/initialize.php") ?>

    <section id="add_adr_section">
        <div id="add_adr_container">
            <form action="">
                <div class="adr_field"><label for="">Address Name</label><input type="text"></div>
                <div class="adr_field"><label for="">Recipient Name</label><input type="text"></div>

                <p>Address</p>
                <button>Use Current Location<i class="bi bi-geo-alt"></i></button>

                <div class="adr_field"><label for="">Street</label><input type="text"></div>
                <div class="adr_field"><label for="">Barangay</label><input type="text"></div>
                <div class="adr_field"><label for="">House/Unit Number</label><input type="text"></div>
                
                <div><input type="text" name="" id=""><label for="">Set as Default Address</label></div>

            </form>
        </div>
    </section>

    <div>
        <button>Save</button>
    </div>
</body>
</html>