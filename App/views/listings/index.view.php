<?php
loadPartial('header');

?>



<section id="results" class="bg-white">
    <div>
        <div class="page-title">
            <?php if (isset($keywords)) : ?>
                <h2>Search results for: <?= htmlspecialchars($keywords) ?><?= htmlspecialchars((' , ' . $postcode)) ?></h2>
            <?php else : ?>
                <h1>All Listings </h1>
            <?php endif; ?>
        </div>
        <?= loadPartial('message') ?>
        <div class="results">
            <?php foreach ($listings as $listing) : ?>
                <div class="card-large">
                    <div class="card-inner">
                        <div class="card-left">
                            <h2><?= $listing->title ?></h2>
                            <div class="img-med">
                                <?php if ($listing->image_location !== 'NULL') : ?>
                                    <a href="<?= $listing->image_location ?>">
                                        <img class="img-med" src="<?= $listing->image_location ?>" alt="<?= $listing->title ?>">
                                    </a>
                                <?php else : ?>
                                    <a href="/images/nophoto.jpg">
                                        <img class="img-med" src="/images/nophoto.jpg" alt="no photo provided">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-right">
                            <ul>
                                <li><strong>Price:</strong> £<?= $listing->price ?></li>
                                <li>
                                    <strong>Location:</strong> <?= $listing->postcode ?>
                                </li>
                                <?php if (!empty($listing->tags)) : ?>
                                    <li>
                                        <strong>Tags:</strong> <span><?= $listing->tags ?></span>,
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <p>
                        <?= $listing->description ?>
                    </p>


                    <a href="/listings/<?= $listing->id ?>">
                        <div class="yellow-btn">Details</div>
                    </a>

                </div>
            <?php endforeach; ?>
</section>

<?php
loadPartial('footer');
?>