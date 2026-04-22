<!DOCTYPE html>
<html lang="es-AR">
<head>
    <?php

        require_once APP_DIR_TEMPLATE . 'includes/head.php';

        if(isset($this->scripts) && is_array($this->scripts)) {
            foreach($this->scripts as $script) {
                echo '<script type="module" src="' . APP_URL . $script . '"></script>';
            }
        }


    ?>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php $isAuthenticationView = isset($this->view) && str_starts_with($this->view, 'authentication/'); ?>

    <?php if (!$isAuthenticationView): ?>
        <header>
            <?php

                require_once APP_DIR_TEMPLATE . 'includes/menu.php';

            ?>
        </header>
    <?php endif; ?>

    <main>
        
        <?php

            require_once APP_DIR_VIEWS . $this->view;

        ?>


    </main>

    <?php if (!$isAuthenticationView): ?>
        <footer class="bg-primary text-light py-3 mt-auto">
            <?php

                require_once APP_DIR_TEMPLATE . 'includes/footer.php';

            ?>
        </footer>
    <?php endif; ?>
    
</body>
</html>