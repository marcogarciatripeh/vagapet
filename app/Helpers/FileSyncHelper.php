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
        // Usar config() ao invés de env() para funcionar mesmo com cache
        $publicSyncPath = config('filesystems.public_sync_path');
        
        // Log para debug
        \Log::info("FileSyncHelper::syncToPublic chamado", [
            'filePath' => $filePath,
            'publicSyncPath' => $publicSyncPath,
            'publicPath' => public_path($filePath),
            'envValue' => env('PUBLIC_SYNC_PATH')
        ]);
        
        if (!$publicSyncPath) {
            \Log::warning("PUBLIC_SYNC_PATH não definido no .env - sincronização ignorada");
            return true;
        }
        
        if (!file_exists($publicSyncPath)) {
            \Log::error("Diretório público não existe: {$publicSyncPath}");
            return false;
        }

        try {
            $sourcePath = public_path($filePath);
            $destinationPath = rtrim($publicSyncPath, '/') . '/' . $filePath;
            $destinationDir = dirname($destinationPath);

            \Log::info("Tentando sincronizar", [
                'source' => $sourcePath,
                'destination' => $destinationPath,
                'sourceExists' => file_exists($sourcePath)
            ]);

            // Verificar se arquivo fonte existe
            if (!file_exists($sourcePath)) {
                \Log::error("Arquivo fonte não existe: {$sourcePath}");
                return false;
            }

            // Criar diretório de destino se não existir
            if (!is_dir($destinationDir)) {
                if (!mkdir($destinationDir, 0755, true)) {
                    \Log::error("Não foi possível criar diretório: {$destinationDir}");
                    return false;
                }
                \Log::info("Diretório criado: {$destinationDir}");
            }

            // Copiar arquivo
            if (copy($sourcePath, $destinationPath)) {
                chmod($destinationPath, 0664);
                \Log::info("Arquivo sincronizado com sucesso: {$destinationPath}");
                return true;
            } else {
                \Log::error("Falha ao copiar arquivo de {$sourcePath} para {$destinationPath}");
                return false;
            }
        } catch (\Exception $e) {
            \Log::error("Erro ao sincronizar arquivo: {$filePath}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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
        // Usar config() ao invés de env() para funcionar mesmo com cache
        $publicSyncPath = config('filesystems.public_sync_path');
        
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

