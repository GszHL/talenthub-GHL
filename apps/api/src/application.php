<?php
declare(strict_types=1);
namespace TalentHub;
final class Application {
    public static function handle(): void {
        try {
        Http::cors();
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/',PHP_URL_PATH) ;
        $jobs = [
            [
            'id' => 'demo00001',
            'ownerId' => 'demoEmpresa',
            'companyName' => 'Empresa demo',
            'title' => 'Practicas de desarrollo php',
            'location' => 'Irapuato, Guanajuato',
            'modality' => 'Hibrido',
            'description' => 'aprende desarrollo bacjen con php',
            'status' => 'OPEN',
            'createdAt' => gmdate('c'),
            ],
        ];  
        if ($method === 'GET' && $path === '/api/v1/health') {
            Http::json(['ok' => true, 'service' => 'Talent-hub', 'version' => 'sesion-01']);
        }
        if ($method === 'GET' && $path === '/api/v1/jobs') {
            Http::json(['ok' => true, 'service' => 'Talent-hub', 'version' => 'sesion-01']);
        }
         if ($method === 'GET' && preg_match('#^/api/v1/jobs/([A-Za-a0-9_-]+)$#', (string)
            $path, $matches)) {
               if($matches[1] === $jobs[0]['id']) {
                Http::json(['jobs' => $jobs[0]]);
               }
               throw new ApiException('Vacante no encontrada');
            }
            throw new ApiException('Ruta no encontrada', 404);
    
        } catch (ApiException $e) {
            Http::json(['error' => $e->getMessage()], $e->httpStatus);
        }catch (\Throwable $e) {
            Http::json(['error' => 'Error interno del servidor'], 500);
        }
    }
}
?>