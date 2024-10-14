<?php
  require_once("ApiClass/MainMenu.php");
?>  
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
            <a href="#" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Profile</span>
            </a>
        </li>
          <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="lni lni-protection"></i>
                <span>Auth</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="Login.php" class="sidebar-link">Login</a>
                </li>
                <li class="sidebar-item">
                    <a href="register.php" class="sidebar-link">Register</a>
                </li>
                <li class="sidebar-item">
                    <a href="Admin" class="sidebar-link">Admin</a>
                </li>                
            </ul>
        </li>
        <?php  echo MainMenu::GetMainMenu();?>

    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
