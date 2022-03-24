<html>
<head>
    <title>Autopliusas</title>
    <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP . 'pub/css/style.css'; ?>">
</head>
<body>
<header class="header">
    <nav>
        <ul>
            <li>
                <a href="<?php echo $this->url(''); ?>">Home Page</a>
            </li>
            <li>
                <a href="<?php echo $this->url('catalog') ?>">All ads</a>

            </li>

            <?php if ($this->isUserLogged()): ?>
                <li>
                    <a href="<?php echo $this->url('catalog/add') ?>">Add New</a>
                </li>
                <li>
                    <a href="<?= $this->url('user/favorite') ?>">🌟</a>
                </li>
                <li>
                    <a href="<?php echo $this->url('user/logout') ?>">Logout</a>
                </li>
                <li>
                    <a href="<?php echo $this->url('user/edit') ?>">Edit</a>

                </li>


                <li>
                    <a href="<?php echo $this->url('message') ?>">Žinutes(<?= $this->data['new_messages'] ?>)</a>

                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo $this->url('user/login') ?>">Login</a>
                </li>
                <li>
                    <a href="<?php echo $this->url('user/register') ?>">Sign Up</a>
                </li>
            <?php endif; ?>
            <?php if($this->isUserAdmin()): ?>
                <li>
                    <a href="<?php echo $this->url('admin') ?>">Admin</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>


