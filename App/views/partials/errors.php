<?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div><?= $error ?></div>
    <?php endforeach; ?>
<?php endif; ?>