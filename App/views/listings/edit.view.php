<?php
loadPartial('header');
?>

<section class="bg-white">
    <div class="container-vert">
        <h2>Edit Listing</h2>
        <?php loadPartial('errors', [
            'errors' => $errors ?? []
        ]); ?>
        <form method="POST" action="/listings/<?= $listing->id ?>" enctype="multipart/form-data">
            <div class="form">
                <input type="hidden" name="_method" value="PUT" />
                <input type="text" name="title" value="<?= $listing->title ?? '' ?>" placeholder="Title" />
                <textarea name="description" placeholder="Description"><?= $listing->description ?? '' ?></textarea>
                <input type="text" name="price" value="<?= $listing->price ?? '' ?>" placeholder="Price" />
                <input type="text" name="tags" value="<?= $listing->tags ?? '' ?>" placeholder="Tags" />
                <input type="text" name="postcode" value="<?= $listing->postcode ?? '' ?>" placeholder="Postcode" />
                <input type="text" name="phone" value="<?= $listing->phone ?? '' ?>" placeholder="Contact Phone Number" />
                <input type="email" name="email" value="<?= $listing->email ?? '' ?>" placeholder="Contact Email" />
                <label for="image">Change Photo (.jpg, .jpeg, .png)</label>
                <input type="file" name="image">
                <button class="green-btn">Save</button>
                <div>
                    <a class="self-center" href='/listings/<?= $listing->id ?>'>
                        <div class="yellow-btn w-100">Cancel</div>
                    </a>
                </div>

            </div>
        </form>

    </div>
</section>

<?php
loadPartial('footer');
?>