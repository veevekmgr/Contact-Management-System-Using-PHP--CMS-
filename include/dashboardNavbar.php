<section class="header">
    <div class="logo">
        <i class="ri-menu-line icon icon-0 menu"></i>
        <h2>CMS</h2>
    </div>
    <div class="profile">
        <?php
        echo '<img src="upload/profile/' . $row['image'] . '" alt="Profile" class="img-user">';
        ?>
    </div>
    <h3 class="user_name"><?php echo $row['fullname']; ?></h3>
    </div>
</section>