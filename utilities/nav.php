<link rel="stylesheet" href="../css/nav.css">

<?php 
session_start();
if (!isset($_SESSION['user'])){
    $_SESSION['user'] = 'visitor';
}
?>

<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                </div>
                <div class="col-md-5 my-auto">
                    <form role="search" action="search.php">
                        <div class="input-group">
                            <input type="search" name="search" id="search" placeholder="Search your product" class="form-control" />
                         <?php if(isset($_GET["category"])){ ?>   <input type="hidden" name="category" id="category" value="<?php echo $_GET["category"] ?>" /> <?php } ?>
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="../user_page/home.php">
                                <i class="fa fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../user_page/cart.php">
                                <i class="fa fa-shopping-cart"></i> Cart 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php 
                            if($_SESSION['user'] == 'visitor'){
                                echo "../login.php";}elseif($_SESSION['user'] == 'customer'){
                                    echo"../user_page/cus_acc_page.php";
                                } ?>">
                                <i class="fa fa-user"></i> User
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
      
</script>
