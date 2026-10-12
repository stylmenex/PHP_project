<?php
if (isset($_SESSION['user_id'])):
?>

<div class="menu">

    <a href="index.php">
        Forum
    </a>

    |

    <a href="create_post.php">
        Νέο Post
    </a>

    |

    <a href="profile.php">
        Profile
    </a>

    |

    <?php if ($_SESSION['role'] == "admin"): ?>

    <a href="admin_panel.php">
        Admin Panel
    </a>

    |

    <?php endif; ?>

    <a href="logout.php">
        Logout
    </a>

</div>

<hr>

<?php else: ?>

<div class="menu">

    <a href="index.php">
        Forum
    </a>

    |

    <a href="login.php">
        Login
    </a>

    |

    <a href="register.php">
        Register
    </a>

</div>

<hr>

<?php endif; ?>