<?php
loadPartial('header');

?>



<section>
    <div>
        <div>
            <?php if (isset($keywords)) : ?>
                Search results for: <?= htmlspecialchars($keywords) ?><?= htmlspecialchars((' , ' . $postcode)) ?>
            <?php else : ?>
                All Listings
            <?php endif; ?>
        </div>
        <?= loadPartial('message') ?>
        <div>
            <?php foreach ($listings as $listing) : ?>
                <div>
                    <div>
                        <h2><?= $listing->title ?></h2>
                        <p>
                            <?= $listing->description ?>
                        </p>
                        <ul>
                            <li><strong>Price:</strong> <?= $listing->price ?></li>
                            <li>
                                <strong>Location:</strong> <?= $listing->postcode ?>
                            </li>
                            <?php if (!empty($listing->tags)) : ?>
                                <li>
                                    <strong>Tags:</strong> <span><?= $listing->tags ?></span>,
                                </li>
                            <?php endif; ?>
                        </ul>
                        <a href="/listings/<?= $listing->id ?>">
                            Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
</section>

<?php
loadPartial('footer');
?>