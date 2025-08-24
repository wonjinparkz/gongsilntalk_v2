# Hero Basic Component Documentation

## Component Path
`/var/www/php-gsntalk/resources/views/components/v2/hero/hero-basic.blade.php`

## Usage
This component displays a two-part hero section: a main hero with background image and large text, followed by a sub hero with image and descriptive text.

## Basic Usage
```blade
<x-v2.hero.hero-basic />
```

## With Custom Props
```blade
<x-v2.hero.hero-basic 
    :mainTitle1="'첫 번째 타이틀 라인'"
    :mainTitle2="'두 번째 타이틀 라인'"
    :mainTitle3="'세 번째 타이틀 라인'"
    :mainBackgroundImage="'/assets/images/custom-bg.jpg'"
    :subImage="'/assets/images/custom-sub.jpg'"
    :subImageAlt="'설명 이미지'"
    :subText1="'첫 번째 설명 텍스트'"
    :subText2="'두 번째 설명 텍스트'"
    :containerClass="'my-custom-class'"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `mainTitle1` | string | '공실앤톡과 함께하는' | First line of main hero title |
| `mainTitle2` | string | '스마트한 부동산' | Second line of main hero title |
| `mainTitle3` | string | '중개 서비스' | Third line of main hero title |
| `mainBackgroundImage` | string | '/assets/media/hero-bg.jpg' | Background image for main hero |
| `subImage` | string | '/assets/media/hero-sub.jpg' | Image for sub hero left section |
| `subImageAlt` | string | '공실앤톡 서비스' | Alt text for sub hero image |
| `subText1` through `subText10` | string | Various default texts | 10 lines of descriptive text for sub hero |
| `containerClass` | string | '' | Additional CSS classes for the container |
| `id` | string | auto-generated | Unique ID for the component instance |

## Features

### Layout Structure
- **Main Hero**: 
  - Height: 735px (desktop), 520px (mobile)
  - Full width with max content width of 1080px
  - Left-aligned large text (3 lines)
  - Background image with overlay gradient
  
- **Sub Hero**:
  - Height: 735px (desktop), auto with min-height 520px (mobile)
  - Two-column layout: left image, right text
  - Text uses body-t-lg class (10 lines)
  - Mobile: Text on top, image on bottom

### Responsive Design
- **Desktop (>768px)**:
  - Main hero: 56px font size for titles
  - Sub hero: Side-by-side layout
  
- **Tablet (≤768px)**:
  - Main hero: 36px font size, 520px height
  - Sub hero: Stacked layout (text first, image second)
  
- **Mobile (≤480px)**:
  - Main hero: 28px font size
  - Sub hero: Reduced text size (14px)

### Styling
- Main hero uses gradient overlay for text readability
- Title text has text-shadow for better visibility
- Sub hero image has border-radius and box-shadow
- Background colors follow design system

## Examples

### Basic Hero Section
```blade
<x-v2.hero.hero-basic />
```

### Custom Content Hero
```blade
<x-v2.hero.hero-basic 
    :mainTitle1="'혁신적인 부동산'"
    :mainTitle2="'플랫폼의 시작'"
    :mainTitle3="'공실앤톡'"
    :mainBackgroundImage="'/assets/images/hero-main.jpg'"
    :subImage="'/assets/images/about-us.jpg'"
    :subText1="'우리는 부동산 시장의 혁신을 추구합니다.'"
    :subText2="'최신 기술과 전문 지식을 결합하여...'"
/>
```

### With Custom Class
```blade
<x-v2.hero.hero-basic 
    :containerClass="'dark-theme'"
/>
```

## Sub Text Props
The component accepts 10 text lines for the sub hero section:
- `subText1` through `subText10`

Each line is rendered as a separate paragraph with `body-t-lg` class styling.

## Notes for AI Agents
1. Component uses Blade's `@props` directive for prop handling
2. Main hero requires a background image path
3. Sub hero image and all text props are customizable
4. Heights are fixed on desktop but responsive on mobile
5. The sub hero layout reverses on mobile (text first, image second)
6. All text uses predefined typography classes from the design system
7. Background image is applied via inline style for dynamic paths