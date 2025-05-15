<?php
require_once 'config/database.php';
require_once 'includes/header.php';

// Hole die neuesten Produkte
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 6");
$latest_products = $stmt->fetchAll();

// Hole die Kategorien
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<div class="row">
    <div class="col-md-12">
        <div class="jumbotron bg-light p-5 rounded">
            <h1>Willkommen in unserem Shop</h1>
            <p class="lead">Entdecken Sie unsere neuesten Produkte und Angebote.</p>
        </div>
    </div>
</div>

<h2 class="mt-5">Neueste Produkte</h2>
<div class="row">
    <?php foreach ($latest_products as $product): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="card-text"><strong>Preis: €<?php echo number_format($product['price'], 2); ?></strong></p>
                <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Details</a>
                <a href="cart.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-success">In den Warenkorb</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<h2 class="mt-5">Kategorien</h2>
<div class="row">
    <?php foreach ($categories as $category): ?>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($category['description']); ?></p>
                <a href="category.php?id=<?php echo $category['id']; ?>" class="btn btn-primary">Produkte anzeigen</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>