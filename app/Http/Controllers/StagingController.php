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
        // Define the mapping of routes to blade file paths
        $pageMap = [
            'main' => 'www_v2.main.main',
        ];

        // Check if the requested page exists in the map
        if (!array_key_exists($page, $pageMap)) {
            // Try to find the view dynamically
            $viewPath = 'www_v2.' . str_replace('-', '.', $page) . '.' . $page;
            
            // Check if view exists
            if (!View::exists($viewPath)) {
                abort(404, "Staging page not found: {$page}");
            }
        } else {
            $viewPath = $pageMap[$page];
        }

        // Pass any request parameters to the view
        return view($viewPath, [
            'stagingMode' => true,
            'currentPage' => $page,
            'requestData' => $request->all()
        ]);
    }

    /**
     * List all available staging pages
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $availablePages = [
            [
                'name' => 'Main Page',
                'route' => 'main',
                'description' => '메인 페이지'
            ],
        ];

        return view('www_v2.index', [
            'pages' => $availablePages
        ]);
    }
}