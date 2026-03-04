<!DOCTYPE html>
<html lang="es-AR">
<head>
    <?php

        require_once APP_DIR_TEMPLATE . 'includes/head.php';

        if(isset($this->scripts) && is_array($this->scripts)) {
            foreach($this->scripts as $script) {
                echo '<script src="' . APP_URL . $script . '"></script>';
            }
        }


    ?>
</head>
<body class="d-flex flex-column min-vh-100">

    <header>
        <?php

            require_once APP_DIR_TEMPLATE . 'includes/menu.php';

        ?>
    </header>

    <main>
        
        <?php

            require_once APP_DIR_VIEWS . $this->view;

        ?>


    </main>

    <footer class="bg-primary text-light py-3 mt-auto">
        <?php

            require_once APP_DIR_TEMPLATE . 'includes/footer.php';

        ?>
    </footer>
    
</body>
</html>