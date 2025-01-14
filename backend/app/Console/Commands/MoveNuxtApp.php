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
        $this->moveNuxtAssets();
        $this->updatePayloadPath();
        return 0;
    }

    private function moveNuxtAssets()
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

        $this->info("Successfully moved all Nuxt app files from {$source} to {$destination}.\n");
    }

    private function updatePayloadPath()
    {
        // Define the path to the public/app directory
        $appPath = public_path('app');

        // Check if the directory exists
        if (!File::exists($appPath)) {
            $this->error("The directory $appPath does not exist.");
            return Command::FAILURE;
        }

        // Get all files in the directory
        $indexFiles = File::allFiles($appPath);

        foreach ($indexFiles as $file) {
            if ($file->getExtension() === 'html' && $file->getFilename() === 'index.html') {
                $this->info('Processing: ' . $file->getPathname());

                // Read the file contents
                $content = File::get($file->getPathname());

                // Check if _payload.json exists in the file
                if (str_contains($content, '_payload.json')) {
                    $this->info("Found '_payload.json' in: " . $file->getPathname());

                    // Get the relative directory from public/app
                    $relativePath = str_replace($appPath, '', $file->getPath());

                    // Current path
                    $currentPath = $relativePath . '/_payload.json';

                    // Construct the correct path for _payload.json
                    $correctPath = '/app' . $relativePath . '/_payload.json';

                    // Replace /_payload.json with the correct path
                    $updatedContent = preg_replace(
                        "/" . preg_quote($currentPath, '/') . "/",
                        $correctPath,
                        $content
                    );

                    // Add /app next to href=' if not already present
                    $finalContent = preg_replace_callback(
                        "/href='(?!\/app)/",
                        function ($matches) {
                            return "href='/app";
                        },
                        $updatedContent
                    );

                    // Write the updated content back to the file
                    if ($finalContent !== $content) {
                        File::put($file->getPathname(), $finalContent);
                        $this->info('Updated: ' . $file->getPathname());
                    } else {
                        $this->info('No changes required for: ' . $file->getPathname());
                    }
                } else {
                    $this->info("'_payload.json' not found in: " . $file->getPathname());
                }
            }
        }

        $this->info('All index.html files in the public/app directory have been processed.\n');

        $this->removePayloadPath();
    }

    private function removePayloadPath()
    {
        // Define the path to the _nuxt directory
        $nuxtPath = public_path('app');

        // Check if the directory exists
        if (!File::exists($nuxtPath)) {
            $this->error("The directory $nuxtPath does not exist.");
            return Command::FAILURE;
        }

        // Get all .js files in the directory
        $jsFiles = File::allFiles($nuxtPath);

        foreach ($jsFiles as $file) {
            if ($file->getExtension() === 'js') {
                $this->info('Processing: ' . $file->getPathname());

                // Read the file contents
                $content = File::get($file->getPathname());

                // Regex to match the specific async function
                $codeToRemove = 'async function Zc(e){const t=fetch(e).then(n=>n.text().then(ea));try{return await t}catch(n){console.warn("[nuxt] Cannot load payload ",e,n)}return null}';
                // $newCode = 'async function Zc(e){const t=fetch("/app"+e).then(n=>n.text().then(ea));try{return await t}catch(n){console.warn("[nuxt] Cannot load payload ",e,n)}return null}';
                $newCode = 'async function Zc(e){return null}';

                // Remove the matched block of code
                $updatedContent = str_replace($codeToRemove, $newCode, $content);

                // Write the updated content back to the file
                if ($updatedContent !== $content) {
                    File::put($file->getPathname(), $updatedContent);
                    $this->info('Updated: ' . $file->getPathname());
                } else {
                    $this->info('No changes required for: ' . $file->getPathname());
                }
            }
        }

        $this->info('All JavaScript files in the _nuxt directory have been processed.\n');
    }
}
