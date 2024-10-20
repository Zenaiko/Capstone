<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/seller_nav.css">

<nav id="seller_nav">
    <div id="nav_container">
        <i class="bi bi-arrow-left" id="back_arrow"></i>
        <p>Shop</p>
        <div id="nav_icons">
            <i class="bi bi-chat-dots"></i>
            <i class="bi bi-list"  data-bs-toggle="collapse" data-bs-target="#nav_menu" aria-expanded="false" aria-controls="nav_menu"></i>
        </div>
    </div>
</nav>

<div class="collapse collapse-horizontal" id="nav_menu">
    <div class="card card-body" id="menu_container">
        <ul id="menu_list">
            <li><a href="../user_page/seller_dashboard.php"><span class="material-symbols-outlined">dashboard</span> Dashboard</a></li>
            <hr>
            <li><a href="../user_page/seller_item_page.php"><span class="material-symbols-outlined">inventory_2</span> Inventory</a></li>
            <hr>
            <li><a href=""><span class="material-symbols-outlined">storefront</span> Profile</a></li>
            <hr>
            <li><a href="../user_page/seller_transaction.php"><span class="material-symbols-outlined">receipt</span> Transaction</a></li>
            <hr>
            <li><a href=""><span class="material-symbols-outlined">redeem</span> Voucher</a></li>
            <hr>
            <li><a href=""><span class="material-symbols-outlined">payments</span>Payment</a></li>
        </ul>
    </div>
</div>

<script src="../js/seller_nav.js"></script>