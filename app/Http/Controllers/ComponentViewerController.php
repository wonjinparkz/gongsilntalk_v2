<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ComponentViewerController extends Controller
{
    /**
     * 컴포넌트 뷰어 메인 페이지
     */
    public function index($component = null)
    {
        $v2Path = resource_path('views/components/v2');
        $folders = [];
        $selectedComponent = null;
        $selectedFolder = null;
        
        // v2 디렉토리의 하위 폴더 스캔
        if (File::exists($v2Path)) {
            $directories = File::directories($v2Path);
            foreach ($directories as $directory) {
                $folderName = basename($directory);
                $components = $this->getComponentsInFolder($directory);
                if (count($components) > 0) {
                    $folders[$folderName] = $components;
                    
                    // URL에서 전달된 컴포넌트 찾기
                    if ($component && in_array($component, $components)) {
                        $selectedComponent = $component;
                        $selectedFolder = $folderName;
                    }
                }
            }
        }
        
        return view('component-viewer.index', compact('folders', 'selectedComponent', 'selectedFolder'));
    }
    
    /**
     * 특정 컴포넌트를 iframe으로 렌더링
     */
    public function renderComponent(Request $request)
    {
        $folder = $request->input('folder');
        $component = $request->input('component');
        
        // 보안을 위한 경로 검증
        if (!$folder || !$component) {
            abort(404);
        }
        
        // 컴포넌트 경로 생성
        // 폴더는 점(.)으로, 파일명의 언더스코어는 대시(-)로
        $componentPath = "v2.{$folder}." . str_replace('_', '-', $component);
        
        // 컴포넌트 파일 존재 확인
        $filePath = resource_path("views/components/v2/{$folder}/{$component}.blade.php");
        if (!File::exists($filePath)) {
            abort(404, "Component not found: {$componentPath}");
        }
        
        return view('component-viewer.frame', [
            'componentPath' => $componentPath,
            'folder' => $folder,
            'component' => $component
        ]);
    }
    
    /**
     * 폴더 내의 컴포넌트 목록 가져오기
     */
    private function getComponentsInFolder($directory)
    {
        $components = [];
        $files = File::files($directory);
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $componentName = Str::before($file->getFilename(), '.blade.php');
                $components[] = $componentName;
            }
        }
        
        return $components;
    }
}