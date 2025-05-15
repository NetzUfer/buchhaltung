<?php
require_once 'config/database.php';
require_once 'includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: products.php');
    exit;
}

// Produkt mit Kategorien abrufen
$stmt = $pdo->prepare("
    SELECT p.*, GROUP_CONCAT(c.name) as categories
    FROM products p
    LEFT JOIN product_categories pc ON p.id = pc.product_id
    LEFT JOIN categories c ON pc.category_id = c.id
    WHERE p.id = ?
    GROUP BY p.id
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo '<div class="alert alert-danger">Produkt nicht gefunden.</div>';
    require_once 'includes/footer.php';
    exit;
}

// Ähnliche Produkte finden
$stmt = $pdo->prepare("
    SELECT DISTINCT p.*
    FROM products p
    JOIN product_categories pc1 ON p.id = pc1.product_id
    JOIN product_categories pc2 ON pc1.category_id = pc2.category_id
    WHERE pc2.product_id = ? AND p.id != ?
    LIMIT 3
");
$stmt->execute([$id, $id]);
$similar_products = $stmt->fetchAll();
?>

<div class="row">
    <div class="col-md-8">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        
        <div class="mb-4">
            <h5>Beschreibung:</h5>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        </div>

        <div class="mb-4">
            <h5>Kategorien:</h5>
            <p><?php echo htmlspecialchars($product['categories'] ?? 'Keine Kategorien'); ?></p>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">€<?php echo number_format($product['price'], 2); ?></h3>
                <p class="card-text">
                    Verfügbarkeit: 
                    <?php if ($product['stock'] > 0): ?>
                        <span class="text-success"><?php echo $product['stock']; ?> auf Lager</span>
                    <?php else: ?>
                        <span class="text-danger">Nicht verfügbar</span>
                    <?php endif; ?>
                </p>
                <?php if ($product['stock'] > 0): ?>
                    <a href="cart.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-success btn-lg">In den Warenkorb</a>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg" disabled>Nicht verfügbar</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($similar_products)): ?>
<div class="row">
    <div class="col-12">
        <h3>Ähnliche Produkte</h3>
    </div>
    <?php foreach ($similar_products as $similar): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($similar['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars(substr($similar['description'], 0, 100)) . '...'; ?></p>
                <p class="card-text"><strong>€<?php echo number_format($similar['price'], 2); ?></strong></p>
                <a href="product.php?id=<?php echo $similar['id']; ?>" class="btn btn-primary">Details</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>