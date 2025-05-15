<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onlineshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dropdown-menu {
            border-radius: 0;
        }
        .navbar-nav .nav-link:hover {
            color: #fff !important;
        }
        .navbar {
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .cart-icon {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 0.25em 0.6em;
            font-size: 0.75rem;
        }
        .search-form {
            max-width: 300px;
        }
        @media (max-width: 991.98px) {
            .search-form {
                max-width: 100%;
                margin: 10px 0;
            }
        }
    </style></head>
<body>
    <!-- Top Bar -->
    <div class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <small>
                        <i class="fas fa-phone me-2"></i> +49 123 456789
                        <i class="fas fa-envelope ms-3 me-2"></i> info@example.com
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <small>
                        <a href="shipping.php" class="text-white text-decoration-none me-3">Versand</a>
                        <a href="contact.php" class="text-white text-decoration-none me-3">Kontakt</a>
                        <a href="about.php" class="text-white text-decoration-none">Über uns</a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-store me-2"></i>Onlineshop
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main Navigation Items -->
            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Search Form -->
                <form class="d-flex search-form mx-auto" action="products.php" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Produkt suchen..." name="search">
                        <button class="btn btn-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Navigation Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home me-1"></i>Startseite
                        </a>
                    </li>
                    
                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-box me-1"></i>Produkte
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products.php">Alle Produkte</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php
                            // Kategorien aus der Datenbank abrufen
                            try {
                                $stmt = $pdo->query("SELECT * FROM categories LIMIT 5");
                                while ($category = $stmt->fetch()) {
                                    echo '<li><a class="dropdown-item" href="products.php?category=' . 
                                         $category['id'] . '">' . htmlspecialchars($category['name']) . '</a></li>';
                                }
                            } catch (PDOException $e) {
                                // Fehler still behandeln
                            }
                            ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="categories.php">Alle Kategorien</a></li>
                        </ul>
                    </li>
                    <!-- Special Offers -->                    <li class="nav-item">
                        <a class="nav-link" href="special_offers.php">
                            <i class="fas fa-tag me-1"></i>Angebote
                        </a>
                    </li>
                </ul>

                <!-- Right Navigation Items -->
                <ul class="navbar-nav">
                    <!-- Cart -->
                    <li class="nav-item me-2">
                        <a class="nav-link cart-icon" href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <?php
                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                echo '<span class="cart-count">' . array_sum($_SESSION['cart']) . '</span>';
                            }
                            ?>
                        </a>
                    </li>

                    <!-- User Account -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i>Mein Konto
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                                <li><a class="dropdown-item" href="orders.php">Bestellungen</a></li>
                                <li><a class="dropdown-item" href="wishlist.php">Wunschliste</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Abmelden</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-sign-in-alt me-1"></i>Anmelden
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">
                                <i class="fas fa-user-plus me-1"></i>Registrieren
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Secondary Navigation (Categories) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav mx-auto">
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM categories LIMIT 8");
                    while ($category = $stmt->fetch()) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="products.php?category=' . $category['id'] . '">' . 
                             htmlspecialchars($category['name']) . '</a>';
                        echo '</li>';
                    }
                } catch (PDOException $e) {
                    // Fehler still behandeln
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Alle Kategorien</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container my-4">
        <?php if(isset($error_message)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <?php if(isset($success_message)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
            </div>
        <?php endif; ?>