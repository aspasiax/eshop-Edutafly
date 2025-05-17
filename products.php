<?php
include 'db.php';

$products_per_page = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $products_per_page;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

switch ($sort) {
    case 'name_desc':
        $order_by = "ORDER BY name DESC";
        break;
    case 'price_asc':
        $order_by = "ORDER BY price ASC";
        break;
    case 'price_desc':
        $order_by = "ORDER BY price DESC";
        break;
    default:
        $order_by = "ORDER BY name ASC";
        break;
}

$conditions = [];
$params = [];
$types = "";

if ($search !== '') {
    $conditions[] = "name LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}
if ($category !== 'all') {
    $conditions[] = "LOWER(category) = ?";
    $params[] = strtolower($category);
    $types .= "s";
}

$where_clause = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : "";

$sql = "SELECT * FROM products $where_clause $order_by LIMIT ?, ?";
$params[] = $offset;
$params[] = $products_per_page;
$types .= "ii";

$stmt = $conn->prepare($sql);
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$sql_total = "SELECT COUNT(*) FROM products $where_clause";
$stmt_total = $conn->prepare($sql_total);
$total_types = substr($types, 0, -2);
$total_params = array_slice($params, 0, -2);
if (!empty($total_types)) {
    $stmt_total->bind_param($total_types, ...$total_params);
}
$stmt_total->execute();
$total_result = $stmt_total->get_result();
$total_products = $total_result->fetch_row()[0];
$total_pages = ceil($total_products / $products_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edutafly - Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-5 pt-4">
  <form method="get" class="row g-3 align-items-center">
    <div class="col-sm-12 col-md-5">
      <input type="search" name="search" class="form-control" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>" />
    </div>
    <div class="col-sm-6 col-md-3">
      <select name="sort" class="form-select">
        <option value="name_asc" <?php if ($sort == 'name_asc') echo 'selected'; ?>>Name: A–Z</option>
        <option value="name_desc" <?php if ($sort == 'name_desc') echo 'selected'; ?>>Name: Z–A</option>
        <option value="price_asc" <?php if ($sort == 'price_asc') echo 'selected'; ?>>Price: Low to High</option>
        <option value="price_desc" <?php if ($sort == 'price_desc') echo 'selected'; ?>>Price: High to Low</option>
      </select>
    </div>
    <div class="col-sm-6 col-md-3">
      <select name="category" class="form-select">
        <option value="all" <?php if ($category == 'all') echo 'selected'; ?>>All Categories</option>
        <?php
        $cat_result = $conn->query("SELECT DISTINCT category FROM products");
        while ($cat = $cat_result->fetch_assoc()):
          $cat_value = strtolower($cat['category']);
        ?>
          <option value="<?php echo htmlspecialchars($cat_value); ?>" <?php if ($category == $cat_value) echo 'selected'; ?>>
            <?php echo htmlspecialchars($cat['category']); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-sm-12 col-md-1 d-grid">
      <button type="submit" class="btn btn-primary">Go</button>
    </div>
  </form>

  <h2 class="my-4 text-primary fw-bold">Our Products</h2>

  <div class="row products-container">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-4 product-card">
        <div class="card h-100 shadow-sm">
          <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
            <p class="card-text category mb-1"><?php echo htmlspecialchars($row['category']); ?></p>
            <p class="price mb-3">€<?php echo number_format($row['price'], 2); ?></p>
            <div class="mt-auto d-flex gap-2">
              <a href="infoproduct.php?id=<?php echo $row['id']; ?>" class="btn btn-info flex-fill btn-sm">Details</a>
              <button onclick="addToCart(<?php echo $row['id']; ?>, '<?php echo addslashes($row['name']); ?>', <?php echo $row['price']; ?>)" class="btn btn-primary flex-fill btn-sm">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <nav aria-label="Product pagination">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $page == 1 ? 'disabled' : ''; ?>">
        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&category=<?php echo urlencode($category); ?>">Previous</a>
      </li>
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&category=<?php echo urlencode($category); ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?php echo $page == $total_pages ? 'disabled' : ''; ?>">
        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo urlencode($sort); ?>&category=<?php echo urlencode($category); ?>">Next</a>
      </li>
    </ul>
  </nav>
</div>

<?php include 'footer.php'; ?>

<script src="cart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function addToCart(id, name, price) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  const existing = cart.find(item => item.id === id);
  if (existing) {
    existing.quantity += 1;
  } else {
    cart.push({ id, name, price, quantity: 1 });
  }
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartIcon();
}

function updateCartIcon() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  let totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
  document.getElementById('cart-count').textContent = totalQuantity;
}

window.onload = function () {
  updateCartIcon();
};
</script>

</body>
</html>
