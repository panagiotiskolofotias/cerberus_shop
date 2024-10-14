<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">CERBERUS SHOP</a>
        </div>
    </div>
    <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="lni lni-laptop"></i>
                <span>Κατηγορίες</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="Category.php" class="sidebar-link">Βασική Κατηγορία</a>
                </li>
                <li class="sidebar-item">
                    <a href="SecondCategory.php" class="sidebar-link">Δεύτερη κατηγορία</a>
                </li>
                <li class="sidebar-item">
                    <a href="ThirdCategory.php" class="sidebar-link">τρίτη κατηγορία</a>
                </li>                
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="users.php" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="Products.php" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="admin_orders.php" class="sidebar-link">
            <i class="lni lni-cart-full"></i>
                <span>orders</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="Admin_advertisements.php" class="sidebar-link">
            <i class="lni lni-bar-chart"></i>
                <span>Advertisements</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="../Index.php" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>