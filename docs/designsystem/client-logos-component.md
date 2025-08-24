# Client Logos Component Documentation

## Component Path
`/var/www/php-gsntalk/resources/views/components/v2/features/client-logos.blade.php`

## Usage
A client logos marquee component displaying brand logos in 3 rows with infinite scroll animation. Features alternating scroll directions for visual interest.

## Basic Usage
```blade
<x-v2.features.client-logos />
```

## With Custom Props
```blade
<x-v2.features.client-logos 
    :logos="[
        'row1' => [
            ['src' => '/assets/media/custom-logo1.png', 'alt' => 'Company 1'],
            // ... more logos
        ],
        'row2' => [...],
        'row3' => [...]
    ]"
    :animationSpeed="25"
    :logoHeight="50"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `logos` | array | 27 default brand logos | Three rows of logo arrays with src and alt |
| `animationSpeed` | integer | 30 | Animation duration in seconds for one complete scroll |
| `logoHeight` | integer | 60 | Height of logos in pixels |
| `containerClass` | string | '' | Additional CSS classes |
| `id` | string | auto-generated | Unique component ID |

## Logo Data Structure
Each logo in the arrays should have:
```php
[
    'src' => '/path/to/logo.png',
    'alt' => 'Company Name',
]
```

## Layout Structure

### Three Rows with Alternating Direction
1. **Row 1**: Scrolls left (9 logos by default)
2. **Row 2**: Scrolls right (9 logos by default)
3. **Row 3**: Scrolls left (9 logos by default)

### Default Logo Distribution
- Uses brand_01.png through brand_27.png
- 9 logos per row
- Total of 27 client logos

## Features

### Visual Effects
- **Full Color**: Logos display in their original colors
- **Full Opacity**: Logos are fully visible (opacity: 1)
- **No Hover Effects**: Clean, consistent appearance without interaction effects

### Animation
- **Infinite Scroll**: Seamless loop animation
- **Alternating Directions**: 
  - Rows 1 & 3: Left to right
  - Row 2: Right to left
- **Gradient Masks**: Smooth fade at edges for elegant appearance
- **Cloning**: JavaScript duplicates items for seamless infinite scroll

### Styling
- Background: #FFFFFF (white)
- Container padding: 60px (desktop), 40px (tablet), 30px (mobile)
- Row gap: 24px (desktop), 16px (tablet), 12px (mobile)
- Logo spacing: 40px gap + 30px padding per item

## Responsive Behavior

### Desktop (>768px)
- Logo height: 60px
- Marquee height: 100px
- 6 logos displayed at once
- Edge gradient: 100px width

### Tablet (≤768px)
- Logo height: 40px
- Marquee height: 80px
- 4 logos displayed at once
- Edge gradient: 50px width
- Reduced gaps and padding

### Mobile (≤480px)
- Logo height: 35px
- Marquee height: 70px
- 3 logos displayed at once
- Edge gradient: 30px width
- Minimal gaps and padding

## Examples

### Default Usage
```blade
<x-v2.features.client-logos />
```

### Custom Logos with Faster Animation
```blade
@php
$customLogos = [
    'row1' => [
        ['src' => '/assets/media/partner1.png', 'alt' => 'Partner 1'],
        ['src' => '/assets/media/partner2.png', 'alt' => 'Partner 2'],
        // ... more logos
    ],
    'row2' => [...],
    'row3' => [...]
];
@endphp

<x-v2.features.client-logos 
    :logos="$customLogos"
    :animationSpeed="20"
/>
```

### Smaller Logos
```blade
<x-v2.features.client-logos 
    :logoHeight="45"
    :containerClass="'compact-logos'"
/>
```

## JavaScript Functionality
The component includes JavaScript that:
1. Identifies all marquee content rows
2. Clones all logo items twice
3. Appends clones to create seamless infinite scroll
4. Runs on DOMContentLoaded to ensure proper initialization

## CSS Variables
The component uses CSS custom properties for flexibility:
- `--marquee-width`: 100% of container
- `--marquee-height`: Dynamic based on logo height
- `--marquee-elements-displayed`: Number of visible logos
- `--marquee-animation-duration`: Configurable speed
- `--logo-height`: Configurable logo size

## Notes for AI Agents
1. Component displays 27 logos by default (brand_01.png to brand_27.png)
2. Three rows with 9 logos each
3. Middle row scrolls in opposite direction for visual interest
4. Logos display in full color with no hover effects
5. JavaScript cloning ensures seamless infinite scroll
6. Responsive design adjusts logo count and size
7. Edge gradients create smooth fade effect
8. Component uses unique ID to avoid conflicts with multiple instances