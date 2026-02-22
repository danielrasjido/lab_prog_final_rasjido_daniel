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
<body>

    <header>
        <?php

            require_once APP_DIR_TEMPLATE . 'includes/header.php';

        ?>
    </header>

    <body>
        
        <?php

            require_once APP_DIR_VIEWS . $this->view;

        ?>

    </body>

    <footer>
        <?php

            require_once APP_DIR_TEMPLATE . 'includes/footer.php';

        ?>
    </footer>
    
</body>
</html>