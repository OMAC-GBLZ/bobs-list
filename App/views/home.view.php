<?php
loadPartial('header');
loadPartial('search');
?>

<section id="home" class="bg-white">

    <div class="home-content">
        <h2 class="self-center">Recent Listings</h2>
        <div class="home-listings">
            <?php foreach ($listings as $listing) : ?>
                <div class="card">
                    <div class="card-top">
                        <h3><?= $listing->title ?></h3>
                        <div class="img-small">
                            <?php if ($listing->image_location !== 'NULL') : ?>
                                <a href="<?= $listing->image_location ?>">
                                    <img class="img-small" src="<?= $listing->image_location ?>" alt="<?= $listing->title ?>">
                                </a>
                            <?php else : ?>
                                <a href="/images/nophoto.jpg">
                                    <img class="img-small" src="/images/nophoto.jpg" alt="no photo provided">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-desc">
                            <p>
                                <?= getExcerpt($listing->description) ?>
                            </p>
                        </div>

                    </div>

                    <div class="card-bottom">
                        <ul>
                            <li><strong>Price:</strong> £<?= $listing->price ?></li>
                            <li> <strong>Location:</strong> <?= $listing->postcode ?></li>
                            <?php if (!empty($listing->tags)) : ?>
                                <li>
                                    <strong>Tags:</strong> <span><?= $listing->tags ?></span>,
                                </li>
                            <?php endif; ?>
                        </ul>
                        <p><?= $listing->created_at ?></p>
                        <a href="/listings/<?= $listing->id ?>">
                            <div class="blue-btn">Details</div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="self-center w-40">
            <a href="/listings">
                <div class="yellow-btn">All Listings</div>
            </a>

        </div>
    </div>
</section>

<?php
loadPartial('footer');
