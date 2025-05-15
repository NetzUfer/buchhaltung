<?php
require_once 'config/database.php';
require_once 'includes/header.php';

// Suchfunktion
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// SQL-Query vorbereiten
$sql = "SELECT DISTINCT p.* FROM products p";
if ($category_id > 0) {
    $sql .= " JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = :category_id";
    if ($search) {
        $sql .= " AND (p.name LIKE :search OR p.description LIKE :search)";
    }
} elseif ($search) {
    $sql .= " WHERE p.name LIKE :search OR p.description LIKE :search";
}

// Kategorien für Filter holen
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Produkte abrufen
$stmt = $pdo->prepare($sql);
if ($category_id > 0) {
    $stmt->bindValue(':category_id', $category_id);
}
if ($search) {
    $stmt->bindValue(':search', "%$search%");
}
$stmt->execute();
$products = $stmt->fetchAll();
?>

<div class="row mb-4">
    <div class="col-md-8">
        <form class="d-flex" action="" method="GET">
            <input type="text" name="search" class="form-control me-2" placeholder="Produkt suchen..." value="<?php echo htmlspecialchars($search); ?>">
            <select name="category" class="form-select me-2">
                <option value="0">Alle Kategorien</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo $category_id == $category['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Suchen</button>
        </form>
    </div>
</div>

<div class="row">
    <?php if (empty($products)): ?>
    <div class="col-12">
        <div class="alert alert-info">Keine Produkte gefunden.</div>
    </div>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                    <p class="card-text">
                        <strong>Preis: €<?php echo number_format($product['price'], 2); ?></strong><br>
                        <small>Verfügbar: <?php echo $product['stock']; ?> Stück</small>
                    </p>
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Details</a>
                    <?php if ($product['stock'] > 0): ?>
                    <a href="cart.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-success">In den Warenkorb</a>
                    <?php else: ?>
                    <button class="btn btn-secondary" disabled>Nicht verfügbar</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>