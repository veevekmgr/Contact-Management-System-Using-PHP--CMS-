<div id="pagination">
    <?php for ($page = 1; $page <= $total_pages; $page++) : ?>

        <a href='<?php echo "?page=$page"; ?>'>
            <?php echo $page; ?>
        </a>

    <?php endfor; ?>
</div>