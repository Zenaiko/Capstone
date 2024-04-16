<?php 
    require_once("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px; 
        }

        .newsfeed {
            padding: 20px;
            max-width: 700px; 
            margin: 0 auto; 
        }

        .post {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .post-account {
            display: flex;
            align-items: center;
        }

        .profile-icon {
            width: 50px; 
            height: 50px; 
            border-radius: 50%;
            margin-right: 15px; 
        }

        .account-details {
            display: flex;
            flex-direction: column;
        }

        .account-name {
            font-weight: bold;
            color: #333;
            text-decoration: none;
            margin-bottom: 4px;
            font-size: 18px; 
        }

        .edit-profile {
            font-size: 16px;
            color: #555;
            text-decoration: none;
        }

        .post-time {
            color: #777;
            font-size: 14px;
        }

        .post-content {
            margin-bottom: 20px; 
        }

        .post-image {
            width: 100%;
            border-radius: 8px;
        }

        .post-caption {
            color: #333;
            margin: 0;
            font-size: 16px; 
        }

        .post-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .actions-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .actions-list li {
            display: inline;
            margin-right: 20px;
        }

        .actions-list li:last-child {
            margin-right: 0;
        }

        .actions-list li a {
            color: #555;
            text-decoration: none;
            font-size: 24px; 
        }

        .heart i {
            color: red; 
        }

        .slider {
            background-color: #ddd;
            padding: 5px 10px;
            border-radius: 20px;
            color: #555;
            cursor: pointer;
            font-size: 18px; 
        }

        .slider:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="newsfeed">
        <div class="post">
            <div class="post-header">
                <div class="post-account">
                    <img class="profile-icon" src="/pages/images/Megumi2.png" alt="">
                    <div class="account-details">
                        <a href="#" class="account-name">Account Name</a>
                        <a href="#" class="edit-profile">Edit</a>
                    </div>
                </div>
                <div class="post-time">8m ago</div>
            </div>
            <div class="post-content">
                <img class="post-image" src="https://via.placeholder.com/300" alt="">
                <br>
                <br>
                <p class="post-caption">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vel nunc nec mattis.</p>
            </div>
            <div class="post-actions">
                <ul class="actions-list">
                    <li><a href="#"><i class="far fa-comment"></i></a></li>
                    <li><a href="#" class="heart"><i class="far fa-heart"></i></a></li>
                </ul>
                <span class="slider">Slider</span>
            </div>
        </div>
    </div>
    <script>
        const heartIcons = document.querySelectorAll('.heart');

        heartIcons.forEach(icon => {
            icon.addEventListener('click', function(event) {
                event.preventDefault(); 
                this.querySelector('i').classList.toggle('far');
                this.querySelector('i').classList.toggle('fas');
            });
        });
    </script>
</body>
</html>
