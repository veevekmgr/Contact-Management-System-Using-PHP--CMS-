<div class="cards">
    <div class="card card-1">
        <div class="card--data">
            <div class="card--content">
                <h5 class="card--title">Total<br> Users</h5>
                <?php
                $username = $_SESSION['NAME'];
                $sql = "SELECT * FROM user";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $row_countUser = $stmt->rowCount(); ?>
                <h1><?php echo $row_countUser; ?></h1>
            </div>
            <i class="ri-user-line card--icon--lg"></i>
        </div>
    </div>
</div>