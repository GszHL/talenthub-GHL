<?php
declare(strict_types=1);
require dirname(__DIR__) . '/src/bootstrap.php';
use TalentHub\ApiException;
use TalentHub\Validator;
assert(Validator::text(['title' => ' Nuevo empleo '], 'title') === 'Nuevo empleo');
$threw = false;
try { Validator::documentId('../private'); } catch (ApiException) { $threw = true; }
if (!$threw) { fwrite(STDERR, "ERROR: identificador inválido permitido\n"); exit(1); }
echo "Smoke PHP OK\n";
?>