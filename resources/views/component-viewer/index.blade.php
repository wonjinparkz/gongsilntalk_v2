<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Component Viewer - V2 Components</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Pretendard', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f5;
            height: 100vh;
            overflow: hidden;
        }
        
        .container {
            display: flex;
            height: 100vh;
        }
        
        /* 좌측 사이드바 */
        .sidebar {
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
            padding: 20px;
        }
        
        .sidebar h1 {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #F16341;
        }
        
        .folder-section {
            margin-bottom: 20px;
        }
        
        .folder-title {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            background: #f8f8f8;
            border-radius: 6px;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            transition: all 0.2s;
        }
        
        .folder-title:hover {
            background: #F16341;
            color: white;
        }
        
        .folder-title.active {
            background: #F16341;
            color: white;
        }
        
        .folder-title::before {
            content: '📁';
            margin-right: 8px;
        }
        
        .folder-title.active::before {
            content: '📂';
        }
        
        .component-list {
            display: none;
            padding-left: 20px;
        }
        
        .component-list.active {
            display: block;
        }
        
        .component-item {
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 4px;
            color: #666;
            transition: all 0.2s;
            font-size: 14px;
        }
        
        .component-item:hover {
            background: #f0f0f0;
            color: #333;
            padding-left: 16px;
        }
        
        .component-item.active {
            background: #FFF5F2;
            color: #F16341;
            font-weight: 500;
            border-left: 3px solid #F16341;
        }
        
        /* 우측 컨텐츠 영역 */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fafafa;
        }
        
        .content-header {
            background: white;
            padding: 15px 25px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .component-path {
            font-size: 14px;
            color: #666;
        }
        
        .component-path span {
            color: #F16341;
            font-weight: 600;
        }
        
        .iframe-container {
            flex: 1;
            padding: 20px;
            display: grid;
            gap: 20px;
            overflow-y: auto;
        }
        
        .iframe-wrapper {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .iframe-header {
            background: #f8f8f8;
            padding: 12px 20px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .iframe-title {
            font-weight: 600;
            color: #333;
        }
        
        .iframe-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        
        .device-buttons {
            display: flex;
            gap: 4px;
            background: white;
            padding: 2px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }
        
        .device-btn {
            padding: 4px 8px;
            background: transparent;
            color: #666;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .device-btn:hover {
            background: #f0f0f0;
        }
        
        .device-btn.active {
            background: #F16341;
            color: white;
        }
        
        .refresh-btn {
            padding: 4px 12px;
            background: #F16341;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: opacity 0.2s;
        }
        
        .refresh-btn:hover {
            opacity: 0.8;
        }
        
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .iframe-wrapper.mobile-view {
            max-width: 375px;
            margin: 0 auto;
        }
        
        .iframe-wrapper.tablet-view {
            max-width: 768px;
            margin: 0 auto;
        }
        
        .iframe-wrapper.desktop-view {
            max-width: none;
        }
        
        .empty-state {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 18px;
        }
        
        .grid-1 { grid-template-columns: 1fr; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        
        .view-toggle {
            display: flex;
            gap: 10px;
        }
        
        .view-btn {
            padding: 6px 12px;
            background: #e0e0e0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .view-btn.active {
            background: #F16341;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- 좌측 사이드바 -->
        <div class="sidebar">
            <h1>🎨 V2 Components</h1>
            
            @if(count($folders) > 0)
                @foreach($folders as $folderName => $components)
                    <div class="folder-section">
                        <div class="folder-title" onclick="toggleFolder('{{ $folderName }}')">
                            {{ ucfirst($folderName) }} ({{ count($components) }})
                        </div>
                        <div class="component-list" id="folder-{{ $folderName }}">
                            @foreach($components as $component)
                                <div class="component-item" 
                                     onclick="selectComponent('{{ $folderName }}', '{{ $component }}', this)">
                                    {{ $component }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <p style="color: #999; text-align: center; margin-top: 50px;">
                    No components found in v2 directory
                </p>
            @endif
        </div>
        
        <!-- 우측 컨텐츠 영역 -->
        <div class="content">
            <div class="content-header">
                <div class="component-path" id="component-path">
                    Select a component from the sidebar
                </div>
                <div class="view-toggle">
                    <button class="view-btn active" onclick="setGridView(1, this)">Single View</button>
                    <button class="view-btn" onclick="setGridView(2, this)">Grid View</button>
                </div>
            </div>
            
            <div class="iframe-container grid-1" id="iframe-container">
                <div class="empty-state">
                    👈 Select a component to preview
                </div>
            </div>
        </div>
    </div>
    
    <script>
        let selectedComponents = [];
        let gridColumns = 1;
        
        // Check if there's a pre-selected component from URL
        @if($selectedComponent && $selectedFolder)
            window.addEventListener('DOMContentLoaded', () => {
                // Open the folder
                const folder = document.getElementById('folder-{{ $selectedFolder }}');
                const folderTitle = document.querySelector('.folder-title[onclick*="{{ $selectedFolder }}"]');
                if (folder && folderTitle) {
                    folder.classList.add('active');
                    folderTitle.classList.add('active');
                    
                    // Select the component
                    setTimeout(() => {
                        const componentItem = document.querySelector('.component-item[onclick*="{{ $selectedComponent }}"]');
                        if (componentItem) {
                            componentItem.click();
                        }
                    }, 100);
                }
            });
        @endif
        
        function toggleFolder(folderName) {
            const folderList = document.getElementById(`folder-${folderName}`);
            const folderTitle = event.currentTarget;
            
            // Toggle active class
            folderList.classList.toggle('active');
            folderTitle.classList.toggle('active');
        }
        
        function selectComponent(folder, component, element) {
            // Update active state in sidebar
            document.querySelectorAll('.component-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
            
            // Update path display
            document.getElementById('component-path').innerHTML = 
                `v2.<span>${folder}</span>.<span>${component}</span>`;
            
            // Update URL without page reload
            const newUrl = `/component-viewer/${component}`;
            window.history.pushState({folder, component}, '', newUrl);
            
            // Add component to view
            addComponentToView(folder, component);
        }
        
        function addComponentToView(folder, component) {
            const container = document.getElementById('iframe-container');
            const componentId = `${folder}-${component}`;
            
            // Clear empty state or previous single view
            if (gridColumns === 1) {
                container.innerHTML = '';
            } else if (container.querySelector('.empty-state')) {
                container.innerHTML = '';
            }
            
            // Check if component already exists
            if (document.getElementById(`wrapper-${componentId}`)) {
                return;
            }
            
            // Create iframe wrapper
            const wrapper = document.createElement('div');
            wrapper.className = 'iframe-wrapper';
            wrapper.id = `wrapper-${componentId}`;
            wrapper.innerHTML = `
                <div class="iframe-header">
                    <div class="iframe-title">${folder}/${component}</div>
                    <div class="iframe-controls">
                        <div class="device-buttons">
                            <button class="device-btn" onclick="setDeviceView('${componentId}', 'mobile', this)" title="Mobile (375px)">
                                📱 Mobile
                            </button>
                            <button class="device-btn" onclick="setDeviceView('${componentId}', 'tablet', this)" title="Tablet (768px)">
                                💻 Tablet
                            </button>
                            <button class="device-btn active" onclick="setDeviceView('${componentId}', 'desktop', this)" title="Desktop (Full)">
                                🖥️ Desktop
                            </button>
                        </div>
                        <button class="refresh-btn" onclick="refreshComponent('${componentId}', '${folder}', '${component}')">
                            🔄 Refresh
                        </button>
                    </div>
                </div>
                <iframe id="iframe-${componentId}" 
                        src="{{ route('component.viewer.render') }}?folder=${folder}&component=${component}">
                </iframe>
            `;
            
            container.appendChild(wrapper);
            
            // Store component info
            selectedComponents.push({ id: componentId, folder, component });
        }
        
        function refreshComponent(componentId, folder, component) {
            const iframe = document.getElementById(`iframe-${componentId}`);
            iframe.src = `{{ route('component.viewer.render') }}?folder=${folder}&component=${component}&t=${Date.now()}`;
        }
        
        function setDeviceView(componentId, device, button) {
            const wrapper = document.getElementById(`wrapper-${componentId}`);
            
            // Remove all device view classes
            wrapper.classList.remove('mobile-view', 'tablet-view', 'desktop-view');
            
            // Add the selected device view class
            wrapper.classList.add(`${device}-view`);
            
            // Update button states
            const deviceButtons = button.parentElement.querySelectorAll('.device-btn');
            deviceButtons.forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
        }
        
        function setGridView(columns, button) {
            gridColumns = columns;
            const container = document.getElementById('iframe-container');
            
            // Update button states
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
            
            // Update grid class
            container.className = `iframe-container grid-${columns}`;
            
            // Clear view if switching to single
            if (columns === 1 && selectedComponents.length > 0) {
                const last = selectedComponents[selectedComponents.length - 1];
                container.innerHTML = '';
                addComponentToView(last.folder, last.component);
            }
        }
        
        // Auto-open first folder
        window.addEventListener('DOMContentLoaded', () => {
            // Only open first folder if no component is pre-selected
            @if(!$selectedComponent)
                const firstFolder = document.querySelector('.folder-title');
                if (firstFolder) {
                    firstFolder.click();
                }
            @endif
        });
        
        // Handle browser back/forward navigation
        window.addEventListener('popstate', (event) => {
            if (event.state && event.state.component) {
                const componentItem = document.querySelector(`.component-item[onclick*="${event.state.component}"]`);
                if (componentItem) {
                    componentItem.click();
                }
            } else {
                // Going back to main page, clear selection
                document.getElementById('iframe-container').innerHTML = `
                    <div class="empty-state">
                        👈 Select a component to preview
                    </div>
                `;
                document.getElementById('component-path').innerHTML = 'Select a component from the sidebar';
                document.querySelectorAll('.component-item').forEach(item => {
                    item.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>