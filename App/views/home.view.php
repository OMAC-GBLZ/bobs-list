<?php
loadPartial('header');
loadPartial('search');
?>

<section id="home">
    <div class="home-content">
        <h2 class="self-center">Recent Listings</h2>
        <div class="home-listings">
            <?php foreach ($listings as $listing) : ?>
                <div class="card">
                    <div>
                        <h3><?= $listing->title ?></h3>
                        <p>
                            <?= $listing->description ?>
                        </p>
                        <ul>
                            <li><strong>Price:</strong> <?= $listing->price ?></li>
                            <li> <strong>Location:</strong> <?= $listing->postcode ?></li>
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
        </div>
        <div class="self-center">
            <button href="/listings">All Listings</button>
        </div>

    </div>
</section>

<?php
loadPartial('footer');
