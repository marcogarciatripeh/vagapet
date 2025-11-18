<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileSyncHelper
{
    /**
     * Sincroniza um arquivo do repositório para o diretório público
     * 
     * @param string $filePath Caminho relativo do arquivo (ex: 'professionals/photos/image.jpg')
     * @return bool
     */
    public static function syncToPublic(string $filePath): bool
    {
        // Só sincronizar em produção (quando PUBLIC_SYNC_PATH estiver definido)
        $publicSyncPath = env('PUBLIC_SYNC_PATH');
        
        if (!$publicSyncPath || !file_exists($publicSyncPath)) {
            // Em desenvolvimento, não precisa sincronizar
            return true;
        }

        try {
            $sourcePath = public_path($filePath);
            $destinationPath = rtrim($publicSyncPath, '/') . '/' . $filePath;
            $destinationDir = dirname($destinationPath);

            // Criar diretório de destino se não existir
            if (!is_dir($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }

            // Copiar arquivo se existir no repositório
            if (file_exists($sourcePath)) {
                copy($sourcePath, $destinationPath);
                chmod($destinationPath, 0664);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            \Log::error("Erro ao sincronizar arquivo: {$filePath}", [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Sincroniza múltiplos arquivos
     * 
     * @param array $filePaths Array de caminhos relativos
     * @return void
     */
    public static function syncMultipleToPublic(array $filePaths): void
    {
        foreach ($filePaths as $filePath) {
            self::syncToPublic($filePath);
        }
    }

    /**
     * Remove arquivo do diretório público
     * 
     * @param string $filePath Caminho relativo do arquivo
     * @return bool
     */
    public static function removeFromPublic(string $filePath): bool
    {
        $publicSyncPath = env('PUBLIC_SYNC_PATH');
        
        if (!$publicSyncPath) {
            return true;
        }

        try {
            $destinationPath = rtrim($publicSyncPath, '/') . '/' . $filePath;
            
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            \Log::error("Erro ao remover arquivo: {$filePath}", [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}

