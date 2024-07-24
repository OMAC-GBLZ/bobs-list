<?php
loadPartial('header');
?>
<section>
    <div class="container-vert">
        <h2>Create Listing</h2>
        <form method="POST" action="/listings" enctype="multipart/form-data">
            <?= loadPartial('errors', [
                'errors' => $errors ?? []
            ]) ?>
            <div class="form">
                <input type="text" name="title" value="<?= $listing['title'] ?? '' ?>" placeholder="Title" />
                <textarea name="description" placeholder="Description"><?= $listing['description'] ?? '' ?></textarea>
                <input type="text" name="price" value="<?= $listing['price'] ?? '' ?>" placeholder="Price" />
                <input type="text" name="tags" value="<?= $listing['tags'] ?? '' ?>" placeholder="Tags" />
                <input type="text" name="postcode" value="<?= $listing['postcode'] ?? '' ?>" placeholder="Postcode" />
                <input type="text" name="phone" value="<?= $listing['phone'] ?? '' ?>" placeholder="Contact Phone Number" />
                <input type="email" name="email" value="<?= $listing['email'] ?? '' ?>" placeholder="Contact Email" />
                <label for="image">Add a Picture</label>
                <input type="file" name="image">
                <button class="green-btn">Save</button>
                <div class="yellow-btn">
                    <a href="/">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</section>

<?php
loadPartial('footer');
?>