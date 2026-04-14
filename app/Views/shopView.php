<?= $this->extend('layouts/main') ?>

<?= $this->section('page_styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/shop.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="shop-main">

        <aside class="filters">
            <div class="facet">
                <h4>Categories</h4>
                <?php foreach ($categories as $category): ?>
                    <label>
                        <input type="checkbox" value="<?= esc($category['slug']) ?>">
                        <?= esc($category['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <div class="facet">
                <h4>Sort By</h4>
                <select class="form-select" id="sort">
                    <option value="popular">Most popular</option>
                    <option value="new">Newest Arrivals</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                </select>
            </div>
        </aside>

        <section>
            <div class="controls">
                <div class="text-muted">Showing <?= count($products) ?> products</div>
            </div>

            <div class="catalog-grid">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $item): ?>
                        <article class="catalog-card">
                            <a class="media" href="#">
                                <img src="<?= base_url('assets/images/' . esc($item['image_path'])) ?>" alt="<?= esc($item['name']) ?>" />
                            </a>
                            <div class="meta">
                                <form action="<?= base_url('cart/add') ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="product_id" value="<?= esc($item['id']) ?>">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="quick-btn">Add to Cart</button>
                                </form>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No products found in the catalog.</div>
                <?php endif; ?>
            </div>
        </section>

    </div>
</div>

<?= $this->endSection() ?>