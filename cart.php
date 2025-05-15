<?php
session_start();
require_once 'config/database.php';
require_once 'includes/header.php';

// Warenkorb initialisieren
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Aktionen verarbeiten
$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($action === 'add' && $id > 0) {
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 0;
    }
    $_SESSION['cart'][$id]++;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} elseif ($action === 'remove' && $id > 0) {
    unset($_SESSION['cart'][$id]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} elseif ($action === 'update' && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id] = (int)$quantity;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Warenkorbinhalte abrufen
$cart_items = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $placeholders = str_repeat('?,', count($ids) - 1) . '?';
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $cart_items[] = [
            'product' => $product,
            'quantity' => $quantity,
            'subtotal' => $product['price'] * $quantity
        ];
        $total += $product['price'] * $quantity;
    }
}
?>

<h1>Warenkorb</h1>

<?php if (empty($cart_items)): ?>
    <div class="alert alert-info">Ihr Warenkorb ist leer.</div>
    <a href="products.php" class="btn btn-primary">Weiter einkaufen</a>
<?php else: ?>
    <form method="post" action="cart.php?action=update">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Preis</th>
                        <th>Menge</th>
                        <th>Summe</th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td>
                            <a href="product.php?id=<?php echo $item['product']['id']; ?>">
                                <?php echo htmlspecialchars($item['product']['name']); ?>
                            </a>
                        </td>
                        <td>€<?php echo number_format($item['product']['price'], 2); ?></td>
                        <td>
                            <input type="number" name="quantity[<?php echo $item['product']['id']; ?>]" 
                                value="<?php echo $item['quantity']; ?>" 
                                min="0" max="<?php echo $item['product']['stock']; ?>" 
                                class="form-control" style="width: 80px">
                        </td>
                        <td>€<?php echo number_format($item['subtotal'], 2); ?></td>
                        <td>
                            <a href="cart.php?action=remove&id=<?php echo $item['product']['id']; ?>" 
                               class="btn btn-danger btn-sm">Entfernen</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Gesamtsumme:</strong></td>
                        <td><strong>€<?php echo number_format($total, 2); ?></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <a href="products.php" class="btn btn-secondary">Weiter einkaufen</a>
            </div>
            <div class="col-md-6 text-end">
                <button type="submit" class="btn btn-primary">Warenkorb aktualisieren</button>
                <a href="checkout.php" class="btn btn-success">Zur Kasse</a>
            </div>
        </div>
    </form>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>