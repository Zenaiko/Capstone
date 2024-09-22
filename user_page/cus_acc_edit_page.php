<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/cus_acc_edit.css">
</head>
<body>
    <?php require_once('../utilities/initialize.php');
        require_once('../db_api/db_edit_cus.php');
     ?>
    <section id="cus_acc_edit_section">
        <div id="cus_acc_edit_wrapper">

            <form action="../db_api/db_edit_cus.php" id="cus_acc_edit_form" method="post" enctype="multipart/form-data">
                <header id="cus_acc_edit_header">
                    <div id="cus_edit_header_contents">
                        <div id="cus_img_edit">
                            <img src="<?php if(!is_null($cus_info->get_img())){ echo $cus_info->get_img();}
                            else{ echo '../assets/tmp.png';} ?>" alt="" id="cus_image_edit" class="rounded-circle">
                            <i class="bi bi-pencil"></i>
                        </div>
                    </div>
                    <p class="text-center" id="profile_photo_title">Profile Photo</p>
                </header>
                
                <div id="cus_edit_form_wrapper">
                    <div id="cus_edit_form_container">
                        <div id="cus_edit_contents">
                            <div class="cus_edit_field">
                                <label for="cus_username_edit">Username</label>
                                <input type="text" name="cus_username_edit" value="<?=$cus_info->get_username()??null ?>">
                            </div>
                            <div class="cus_edit_field">
                                <label for="cus_contact_edit">Phone</label>
                                <input type="text" name="cus_contact_edit" value="<?=$cus_info->get_contact()?>" readonly>
                            </div>
                            <div class="cus_edit_field">
                                <label for="cus_email_edit">Email</label>
                                <input type="text" name="cus_email_edit" value="<?=$cus_info->get_email()??null ?>">
                            </div>

                            <p class="fw-bold m-0" id="person_info_title">Personal information</p>

                            <div class="cus_edit_field">
                                <label for="cus_f_name_edit">First Name</label>
                                <input type="text" name="cus_f_name_edit" value="<?=$cus_info->get_f_name()??null ?>">
                            </div>
                            <div class="cus_edit_field">
                                <label for="cus_m_name_edit">Middle Name (*Optional*)</label>
                                <input type="text" name="cus_m_name_edit" value="<?=$cus_info->get_m_name()??null ?>">
                            </div>
                            <div class="cus_edit_field">
                                <label for="cus_l_name_edit">Last Name</label>
                                <input type="text" name="cus_l_name_edit" value="<?=$cus_info->get_l_name()??null ?>">
                            </div>
                            <div id="other_info_form">
                                <div id="cus_edit_bday_container">
                                    <label for="cus_edit_bday">Birthdate</label>
                                    <input type="date" name="cus_edit_bday" id="cus_edit_bday" value="<?=$cus_info->get_bday()??null ?>">
                                </div>
                                <div id="cus_edit_sex_container">
                                    <label for="cus_edit_sex">Sex</label>
                                    <select name="" id="cus_edit_sex">
                                        <option value="">Male</option>
                                        <option value="">Female</option>
                                        <option value="">Other</option>
                                        <option value="">Rather not say</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="edit_save_container">
                    <input type="submit" id="edit_save" name="edit_save" value="Save">
                </div>
            </form>
        </div>
    </section>
</body>
</html>