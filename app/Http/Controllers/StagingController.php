<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StagingController extends Controller
{
    /**
     * Display staging pages from www_v2 directory
     *
     * @param Request $request
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $page = 'main')
    {
        $viewPath = $this->findViewPath($page);
        
        if (!$viewPath) {
            abort(404, "Staging page not found: {$page}");
        }

        // Pass any request parameters to the view
        return view($viewPath, [
            'stagingMode' => true,
            'currentPage' => $page,
            'requestData' => $request->all()
        ]);
    }

    /**
     * Find the view path for a given page
     *
     * @param string $page
     * @return string|null
     */
    private function findViewPath($page)
    {
        // First try direct mapping (backwards compatibility)
        $directViewPath = 'www_v2.' . str_replace('-', '.', $page);
        if (View::exists($directViewPath)) {
            return $directViewPath;
        }

        // Scan www_v2 directory for matching files
        $basePath = resource_path('views/www_v2');
        if (!is_dir($basePath)) {
            return null;
        }

        $directories = $this->getDirectories($basePath);
        
        foreach ($directories as $directory) {
            $directoryPath = $basePath . '/' . $directory;
            $bladeFiles = $this->getBladeFiles($directoryPath);
            
            foreach ($bladeFiles as $file) {
                $fileName = str_replace('.blade', '', pathinfo($file, PATHINFO_FILENAME));
                $route = $directory . '-' . $fileName;
                
                if ($route === $page) {
                    return 'www_v2.' . $directory . '.' . $fileName;
                }
            }
        }

        return null;
    }

    /**
     * List all available staging pages
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $availablePages = $this->scanWwwV2Directory();

        return view('www_v2.index', [
            'pages' => $availablePages
        ]);
    }

    /**
     * Scan www_v2 directory for available pages
     *
     * @return array
     */
    private function scanWwwV2Directory()
    {
        $pages = [];
        $basePath = resource_path('views/www_v2');
        
        if (!is_dir($basePath)) {
            return $pages;
        }

        $directories = $this->getDirectories($basePath);
        
        foreach ($directories as $directory) {
            $directoryPath = $basePath . '/' . $directory;
            $bladeFiles = $this->getBladeFiles($directoryPath);
            
            foreach ($bladeFiles as $file) {
                $fileName = str_replace('.blade', '', pathinfo($file, PATHINFO_FILENAME));
                $route = $directory . '-' . $fileName;
                
                $pages[] = [
                    'name' => $this->formatPageName($directory, $fileName),
                    'route' => $route,
                    'description' => $this->generateDescription($directory, $fileName),
                    'directory' => $directory,
                    'file' => $fileName
                ];
            }
        }

        return $pages;
    }

    /**
     * Get directories from given path
     *
     * @param string $path
     * @return array
     */
    private function getDirectories($path)
    {
        $directories = [];
        
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && is_dir($path . '/' . $entry)) {
                    $directories[] = $entry;
                }
            }
            closedir($handle);
        }
        
        sort($directories);
        return $directories;
    }

    /**
     * Get blade files from given directory
     *
     * @param string $path
     * @return array
     */
    private function getBladeFiles($path)
    {
        $files = [];
        
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && pathinfo($entry, PATHINFO_EXTENSION) === 'php' && str_ends_with($entry, '.blade.php')) {
                    $files[] = $entry;
                }
            }
            closedir($handle);
        }
        
        sort($files);
        return $files;
    }

    /**
     * Format page name for display
     *
     * @param string $directory
     * @param string $fileName
     * @return string
     */
    private function formatPageName($directory, $fileName)
    {
        $directoryFormatted = ucfirst(str_replace('_', ' ', $directory));
        $fileFormatted = ucfirst(str_replace('_', ' ', $fileName));
        
        return $directoryFormatted . ' - ' . $fileFormatted;
    }

    /**
     * Generate description for page
     *
     * @param string $directory
     * @param string $fileName
     * @return string
     */
    private function generateDescription($directory, $fileName)
    {
        $descriptions = [
            'main' => '메인 페이지',
            'about' => '소개 페이지',
            'contact' => '연락처 페이지',
            'service' => '서비스 페이지',
        ];

        return $descriptions[$fileName] ?? $directory . ' ' . $fileName . ' 페이지';
    }
}