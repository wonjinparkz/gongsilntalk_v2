# Staging Environment Documentation

## Overview
The staging environment provides a preview system for v2 pages before they are deployed to production. All staging pages are stored in `/resources/views/www_v2/` and are accessible via `/staging/{page}` routes.

## Directory Structure
```
/resources/views/
├── www/                    # Current production pages
└── www_v2/                 # Staging v2 pages
    ├── index.blade.php     # Staging index/list page
    ├── main/
    │   └── main.blade.php  # Main page (/staging/main)
    ├── about/
    │   └── about.blade.php # About page (/staging/about)
    ├── product/
    │   ├── product.blade.php
    │   ├── product-list.blade.php
    │   └── product-detail.blade.php
    └── [other folders]/
        └── [page].blade.php
```

## Routing Convention

### URL Pattern
```
/staging/{page-name}
```

### File Mapping
- URL: `/staging/main` → File: `/www_v2/main/main.blade.php`
- URL: `/staging/about` → File: `/www_v2/about/about.blade.php`
- URL: `/staging/product-list` → File: `/www_v2/product/product-list.blade.php`

### Naming Rules
1. The page name in the URL matches the blade file name (without .blade.php)
2. Use hyphens in URLs for multi-word pages (product-list)
3. The folder structure follows the page category

## Controller
**Location**: `/app/Http/Controllers/StagingController.php`

### Key Methods:
- `index()`: Lists all available staging pages at `/staging`
- `show($page)`: Displays the requested staging page

### Page Mapping
The controller includes a predefined mapping for common pages:
```php
$pageMap = [
    'main' => 'www_v2.main.main',
    'about' => 'www_v2.about.about',
    'product' => 'www_v2.product.product',
    'product-list' => 'www_v2.product.product-list',
    'product-detail' => 'www_v2.product.product-detail',
    // ... more mappings
];
```

## Creating New Staging Pages

### Step 1: Create Directory
```bash
mkdir -p /var/www/php-gsntalk/resources/views/www_v2/{category}
```

### Step 2: Create Blade File
Create your blade file following the naming convention:
```
/resources/views/www_v2/{category}/{page-name}.blade.php
```

### Step 3: Add to Controller (Optional)
If using a custom naming pattern, add to the `$pageMap` in StagingController:
```php
'custom-page' => 'www_v2.category.custom-page',
```

### Step 4: Access the Page
Navigate to: `https://yourdomain.com/staging/{page-name}`

## Example Staging Page Template
```blade
@extends('layouts.master')

@section('title', 'Page Title - 공실앤톡')

@section('content')
<div class="page-v2-container">
    
    <!-- Use v2 components -->
    <x-v2.hero.hero-basic />
    <x-v2.features.feature-cards />
    
    <!-- Staging Notice (auto-shown in staging mode) -->
    @if(isset($stagingMode) && $stagingMode)
    <div class="staging-banner">
        <div class="staging-banner-content">
            <strong>🚧 Staging Environment</strong>
            <span>이 페이지는 개발 중인 v2 버전입니다</span>
            <a href="/staging" class="staging-link">스테이징 목록 보기</a>
        </div>
    </div>
    @endif
</div>
@endsection
```

## Available Variables in Staging Pages
All staging pages receive these variables:
- `$stagingMode`: Boolean indicating staging environment (always true)
- `$currentPage`: The current page name
- `$requestData`: Any request parameters

## Features
1. **Staging Index**: Browse all available staging pages at `/staging`
2. **Staging Banner**: Automatic notification banner on staging pages
3. **v2 Components**: Full access to v2 design system components
4. **Isolation**: Staging pages don't affect production

## Best Practices
1. Always test in staging before moving to production
2. Use v2 components for consistency
3. Include the staging banner for clear identification
4. Follow the naming conventions for easy navigation
5. Document any special requirements for each page

## Migration to Production
When ready to deploy to production:
1. Copy the blade file from `/www_v2/` to `/www/`
2. Update the production routes
3. Remove staging-specific code (staging banner)
4. Test thoroughly in production environment

## URLs
- **Staging Index**: `/staging`
- **Main Page**: `/staging/main`
- **About Page**: `/staging/about`
- **Component Viewer**: `/component-viewer`
- **Design System**: `/design-system-v2`