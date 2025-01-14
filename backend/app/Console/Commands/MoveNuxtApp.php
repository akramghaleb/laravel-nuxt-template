<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MoveNuxtApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nuxt:move-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move Nuxt generated files from public/app/app to public/app';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $source = public_path('app/app');
        $destination = public_path('app');

        // Check if the source directory exists
        if (!File::exists($source)) {
            $this->error("Source directory does not exist: {$source}");
            return 1;
        }

        // Ensure the destination directory exists
        File::ensureDirectoryExists($destination);

        // Move all directories
        $directories = File::directories($source);
        foreach ($directories as $directory) {
            // Calculate the relative path
            $relativePath = substr($directory, strlen($source) + 1);
            $targetDir = $destination . DIRECTORY_SEPARATOR . $relativePath;

            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
                $this->info("Created directory: {$targetDir}");
            }
        }

        // Move all files
        $files = File::allFiles($source);
        foreach ($files as $file) {
            // Calculate the relative path
            $relativePath = substr($file->getPath(), strlen($source) + 1);
            $targetDir = $destination . DIRECTORY_SEPARATOR . $relativePath;

            // Ensure the target directory exists
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
                $this->info("Created directory for file: {$targetDir}");
            }

            // Define source and target file paths
            $sourceFile = $file->getPathname();
            $destinationFile = $targetDir . DIRECTORY_SEPARATOR . $file->getFilename();

            try {
                // Move the file
                File::move($sourceFile, $destinationFile);
                $this->info("Moved file: {$sourceFile} to {$destinationFile}");
            } catch (\Exception $e) {
                $this->error("Failed to move file: {$sourceFile}. Error: {$e->getMessage()}");
                return 1;
            }
        }

        // Delete the source directory after moving all files and directories
        try {
            File::deleteDirectory($source);
            $this->info("Deleted source directory: {$source}");
        } catch (\Exception $e) {
            $this->error("Failed to delete source directory: {$source}. Error: {$e->getMessage()}");
            return 1;
        }

        $this->info("Successfully moved all Nuxt app files from {$source} to {$destination}.");
        return 0;
    }
}
