<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/seller_nav.css">

<nav id="seller_nav">
    <div id="nav_container">
        <i class="bi bi-arrow-left"></i>
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
        </ul>
    </div>
</div>


    <!-- <style>
        body {
            overflow-x: hidden; /* Prevent horizontal scroll */
        }
        .sidebar {
            position: fixed;
            right: -250px; /* Hidden off-screen */
            top: 0;
            height: 100%;
            width: 250px;
            background: #f8f9fa; /* Light background for visibility */
            transition: right 0.3s ease;
            box-shadow: -2px 0 5px rgba(0,0,0,0.5);
        }
        .sidebar.show {
            right: 0; /* Slide in */
        }
    </style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<button class="btn btn-primary" id="toggleMenu">Toggle Menu</button>

<div class="sidebar" id="sidebarMenu">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Menu Item #1
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Content for item 1.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Menu Item #2
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Content for item 2.
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-secondary" id="closeMenu">Close Menu</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebarMenu');
    document.getElementById('toggleMenu').addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });
    document.getElementById('closeMenu').addEventListener('click', () => {
        sidebar.classList.remove('show');
    });
</script>
 -->
