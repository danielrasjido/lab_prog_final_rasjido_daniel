<?php

// =====================
// INCLUDES MANUALES
// =====================
require_once __DIR__ . '/../app/config/DBConfig.php';

require_once __DIR__ . '/../app/libs/database/Connection.php';

require_once __DIR__ . '/../app/core/model/dao/base/InterfaceDAO.php';
require_once __DIR__ . '/../app/core/model/dao/base/BaseDAO.php';
require_once __DIR__ . '/../app/core/model/dao/UsuarioDAO.php';

require_once __DIR__ . '/../app/core/model/dto/base/InterfaceDto.php';
require_once __DIR__ . '/../app/core/model/dto/UsuarioDTO.php';

require_once __DIR__ . '/../app/core/service/base/InterfaceService.php';
require_once __DIR__ . '/../app/core/service/UsuarioService.php';

echo "===== TEST UsuarioService =====\n";
$service = new UsuarioService();
$usuario = $service->load(1);
var_dump($usuario);
echo "\n===== FIN TEST UsuarioService =====\n";
