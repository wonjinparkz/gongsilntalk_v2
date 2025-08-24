# Features Basic Component Documentation

## Component Path
`/var/www/php-gsntalk/resources/views/components/v2/features/features-basic.blade.php`

## Usage
This component displays a feature section with text content and an image, commonly used for hero sections or feature highlights.

## Basic Usage
```blade
<x-v2.features.features-basic />
```

## With Custom Props
```blade
<x-v2.features.features-basic 
    :subtitle1="'간편한 매물 관리로'"
    :subtitle2="'시간을 절약하세요'"
    :title="'스마트한 부동산 매물 관리 시스템'"
    :description1="'매물 등록부터 관리까지 한번에'"
    :description2="'실시간 매물 현황 파악 가능'"
    :description3="'효율적인 매물 추천 시스템'"
    :image="'/assets/images/dashboard.png'"
    :imageAlt="'매물 관리 대시보드'"
    :enableStrikethrough="true"
    :containerClass="'my-custom-class'"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `subtitle1` | string | '부동산에서 찾기 어려운' | First line of subtitle |
| `subtitle2` | string | '역세권 사무실' | Second line of subtitle |
| `title` | string | '효율적인 부동산 관리 솔루션' | Main title text |
| `description1` | string | '점점 공실 찾기 어려운 강남은 물론,' | First line of description |
| `description2` | string | '부동산에서 잘 안 보여주는' | Second line of description |
| `description3` | string | '진짜 초역세권 사무실을 확인하세요.' | Third line of description |
| `image` | string | '/assets/media/s_map.png' | Image path |
| `imageAlt` | string | '공실앤톡 대시보드' | Image alt text |
| `imagePosition` | string | 'right' | Image position ('left' or 'right') |
| `enableStrikethrough` | boolean | true | Enable/disable scroll animation for strikethrough effect |
| `containerClass` | string | '' | Additional CSS classes for the container |
| `id` | string | auto-generated | Unique ID for the component instance |

## Features

### Strikethrough Animation
- When `enableStrikethrough` is `true`, scrolling down adds a strikethrough line to subtitle text
- Animation occurs sequentially: first line, then second line with 200ms delay
- Scrolling up removes the strikethrough in reverse order

### Image Position
- **`imagePosition: 'left'`**: Image on the left, text on the right
  - Desktop: Text is left-aligned
  - Mobile: Text remains left-aligned
- **`imagePosition: 'right'`**: Image on the right, text on the left (default)
  - Desktop: Text is left-aligned
  - Mobile: Text is right-aligned

### Responsive Design
- **Desktop (>768px)**: Side-by-side layout with text (flex: 4.5) and image (flex: 5.5)
- **Mobile (≤768px)**: 
  - Stacked vertical layout (text first, image second regardless of imagePosition)
  - Subtitle: 24px font-size, 700 font-weight
  - Title: 34px font-size, reduced margins
  - Description: 18px font-size
  - Text alignment depends on imagePosition

### Styling
- Uses CSS variables for colors (`--primary-color`, `--secondary-color`)
- Image has box shadow and decorative blur element
- Text uses predefined typography classes

## Examples

### Hero Section with Right Image (Default)
```blade
<x-v2.features.features-basic 
    :subtitle1="'지금까지와는 다른'"
    :subtitle2="'새로운 경험'"
    :title="'공실앤톡과 함께하는 스마트한 부동산'"
    :description1="'AI 기반 매물 추천'"
    :description2="'자동화된 고객 관리'"
    :description3="'실시간 시장 분석'"
    :image="'/assets/images/hero-image.jpg'"
/>
```

### Feature with Left Image
```blade
<x-v2.features.features-basic 
    :subtitle1="'전문가의 노하우를'"
    :subtitle2="'시스템으로'"
    :title="'20년 경험을 담은 부동산 솔루션'"
    :imagePosition="'left'"
    :enableStrikethrough="false"
/>
```

### Multiple Instances
When using multiple instances on the same page, each will have a unique ID automatically generated to prevent conflicts:
```blade
<x-v2.features.features-basic :title="'첫 번째 섹션'" />
<x-v2.features.features-basic :title="'두 번째 섹션'" />
```

## Notes for AI Agents
1. Component uses Blade's `@props` directive for prop handling
2. Each instance gets a unique ID to prevent JavaScript conflicts
3. All text props support Korean and English
4. Image path should be absolute from public directory
5. The component is self-contained with styles and scripts
6. Strikethrough animation only loads JavaScript when enabled