<?php
require_once 'config/database.php';
require_once 'includes/header.php';

// Alle Kategorien mit Produktanzahl abrufen
$stmt = $pdo->query("
    SELECT c.*, COUNT(pc.product_id) as product_count 
    FROM categories c 
    LEFT JOIN product_categories pc ON c.id = pc.category_id 
    GROUP BY c.id
");
$categories = $stmt->fetchAll();
?>

<h1>Kategorien</h1>

<div class="row">
    <?php foreach ($categories as $category): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($category['description']); ?></p>
                <p class="card-text">
                    <small class="text-muted"><?php echo $category['product_count']; ?> Produkte</small>
                </p>
                <a href="products.php?category=<?php echo $category['id']; ?>" class="btn btn-primary">Produkte anzeigen</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>