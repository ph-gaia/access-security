<?php

// Separador de Diretório
define('DS', DIRECTORY_SEPARATOR);
// Rota padrão para a plicação
// Altere o valor somente se a aplicação não estiver rodando em um
// subdomínio específico.
// Default Value : /
define('APPDIR', '/access_security/public/');
define('APPNAME', 'Access Security');
define('APPVERSION', '1.0.0');
// chave privada
define('SALT_KEY', 'UQT0JBGIXT3LADDSWQOLMQ7LEAIWGUA2CURMWZUJIOUJSZ3EFHPSZN53ODPUZPM2');
// tempo para expirar o token
define('EXPIRATE_TOKEN', 2592000); // 30 dias
// dominio
define("HOST_DEV", "http://localhost:8000");
// Nome da Aplicação
define('APPNAM', 'Access Security');
// Versão da Aplicação
define('APPVER', '1.0');
define('URI_LOGIN', '/admin/login');