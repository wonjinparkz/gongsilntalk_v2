# Title Box Component Documentation

## Component Path
`/var/www/php-gsntalk/resources/views/components/v2/text/title-box.blade.php`

## Usage
A reusable title box component with subtitle (h5) and main title (h3), featuring keyword highlighting with marker/highlighter effects.

## Basic Usage
```blade
<x-v2.text.title-box />
```

## With Custom Props
```blade
<x-v2.text.title-box 
    :subtitle="'우리가 만드는'"
    :subtitleHighlight="['우리', '만드는']"
    :title="'혁신적인 부동산 플랫폼'"
    :alignment="'center'"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `subtitle` | string | '공실앤톡이 제공하는' | Subtitle text (h5) |
| `subtitleHighlight` | array | ['공실앤톡'] | Keywords to highlight with marker effect |
| `title` | string | '스마트한 부동산 솔루션' | Main title text (h3) |
| `alignment` | string | 'center' | Text alignment: 'left', 'center', 'right' |
| `containerClass` | string | '' | Additional CSS classes |
| `id` | string | auto-generated | Unique component ID |

## Features

### Layout
- Full width container (100%)
- Max content width: 1080px
- Gap between subtitle and title: 16px (desktop), 8px (mobile)
- Centered content with configurable alignment

### Typography
- **Subtitle (h5)**:
  - Desktop: 20px font size
  - Mobile: 18px (768px), 16px (480px)
  - Font weight: 500 (default), 700 (highlighted keywords)
  
- **Title (h3)**:
  - Desktop: 36px font size
  - Mobile: 28px (768px), 24px (480px)
  - Font weight: 700

### Highlight Effects
The component includes 4 highlight styles for subtitle keywords:

1. **Default (Marker/Highlighter)**:
   - Yellow gradient background
   - 40% height coverage from bottom
   - Slight skew effect

2. **Underline Style** (add class `style-underline`):
   - Simple colored underline
   - Uses primary color

3. **Box Style** (add class `style-box`):
   - Light background box
   - Full height coverage

4. **Circle Style** (add class `style-circle`):
   - Bordered circular outline
   - Full keyword enclosure

## Examples

### Basic Center-Aligned Title
```blade
<x-v2.text.title-box 
    :subtitle="'공실앤톡이 제공하는'"
    :subtitleHighlight="['공실앤톡']"
    :title="'스마트한 부동산 솔루션'"
/>
```

### Left-Aligned with Multiple Highlights
```blade
<x-v2.text.title-box 
    :subtitle="'빠르고 정확한 매물 검색'"
    :subtitleHighlight="['빠르고', '정확한']"
    :title="'원하는 공간을 찾아드립니다'"
    :alignment="'left'"
/>
```

### Right-Aligned Title
```blade
<x-v2.text.title-box 
    :subtitle="'새로운 시작'"
    :subtitleHighlight="['새로운']"
    :title="'공실앤톡과 함께'"
    :alignment="'right'"
/>
```

### Custom Highlight Style
To use alternative highlight styles, modify the component or add classes:
```blade
<!-- Would need component modification to support this -->
<x-v2.text.title-box 
    :subtitle="'혁신적인 서비스'"
    :subtitleHighlight="['혁신적인']"
    :highlightStyle="'style-underline'"
/>
```

## Responsive Behavior

### Desktop (>768px)
- Subtitle: 20px
- Title: 36px
- Gap: 16px
- Padding: 40px 20px

### Tablet (≤768px)
- Subtitle: 18px
- Title: 28px
- Gap: 8px
- Padding: 30px 16px

### Mobile (≤480px)
- Subtitle: 16px
- Title: 24px
- Gap: 8px
- Padding: 20px 16px

## Notes for AI Agents
1. Component uses h5 and h3 tags from common.css typography system
2. Highlight effect is applied via string replacement in PHP
3. Multiple keywords can be highlighted simultaneously
4. The highlight marker effect uses pseudo-element (::after)
5. Component is fully responsive with 3 breakpoints
6. Alignment affects both text-align and flexbox alignment
7. The yellow highlighter effect is the default style