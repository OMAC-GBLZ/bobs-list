<?php
loadPartial('header');
?>

<section class="bg-white">
    <div>
        <div><?= $status ?></div>
        <p>
            <?= $message ?>
        </p>
    </div>
</section>

<?php
loadPartial('footer');
?>