# Feature Cards Component Documentation

## Component Path
`/var/www/php-gsntalk/resources/views/components/v2/features/feature-cards.blade.php`

## Usage
A feature cards component displaying 5 cards in a unique layout: 4 columns with the 2nd column containing 2 smaller cards stacked vertically.

## Basic Usage
```blade
<x-v2.features.feature-cards />
```

## With Custom Props
```blade
<x-v2.features.feature-cards 
    :cards="[
        [
            'title' => '첫 번째 기능',
            'description' => '첫 번째 기능 설명',
            'image' => '/assets/media/custom-icon.png',
        ],
        // ... 5개의 카드 데이터
    ]"
    :containerClass="'custom-class'"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `cards` | array | 5 default cards | Array of card objects with title, description, image |
| `containerClass` | string | '' | Additional CSS classes |
| `id` | string | auto-generated | Unique component ID |

## Card Data Structure
Each card in the `cards` array should have:
```php
[
    'subtitle' => 'Optional subtitle text', // Can be empty string
    'title' => 'Card Title<br>With HTML', // Supports HTML for line breaks
    'description' => 'Optional description text', // Can be empty string
    'image' => '/path/to/image.png',
]
```

## Layout Structure

### Desktop Layout (4 columns)
1. **Column 1**: Single large card (flex: 1)
2. **Column 2**: Two small cards stacked (flex: 1)
3. **Column 3**: Single large card (flex: 1)
4. **Column 4**: Single large card (flex: 1)

### Large Card Style (Columns 1, 3, 4)
- Text align: left
- Display: flex column (desktop), flex row (mobile)
- Min width: 250px
- Background: white
- Border radius: 20px
- Padding: 40px 24px 24px 40px
- Image: max(2vw, 130px) square (bottom-right on desktop, 60x60px right side on mobile)
- Subtitle: 18px, font-weight 500, color #666
- Title: 34px, font-weight 700 (supports HTML)
- Description: 16px, font-weight 400

### Small Card Style (Column 2)
- Display: flex row
- Align items: center
- Padding: 34px 24px 35px 40px
- Height: 50% of large card
- Image: 60x60px (right side)
- Subtitle: 18px, font-weight 500, color #666
- Title: 34px, font-weight 700 (supports HTML)
- Description: 16px, font-weight 400

### Mobile Layout
- All cards stack vertically
- One card per row
- Large cards: horizontal layout (text left, image right)
- Small cards: maintain horizontal layout (text left, image right)
- Responsive padding and font sizes

## Responsive Behavior

### Desktop (>1024px)
- 4 columns layout
- Column 2 has 2 stacked cards
- Gap: 20px

### Tablet (≤1024px)
- 2 columns per row
- Wrapping layout
- Maintains card hierarchy

### Mobile (≤768px)
- Single column layout
- All cards stack vertically
- All cards use horizontal layout (text left, image right)
- Unified image sizing (50x50px)

### Small Mobile (≤480px)
- Reduced padding
- Smaller gaps (12px)

## Examples

### Default Usage
```blade
<x-v2.features.feature-cards />
```

### Custom Cards
```blade
@php
$customCards = [
    ['subtitle' => '최다 사무실 보유!', 'title' => '보유 사무실 수<br>4,200개+', 'description' => '', 'image' => '/assets/media/icon1.png'],
    ['subtitle' => '', 'title' => '실시간 알림', 'description' => '관심 매물 변동사항 확인', 'image' => '/assets/media/icon2.png'],
    ['subtitle' => '', 'title' => '간편한 계약', 'description' => '복잡한 과정을 간편하게', 'image' => '/assets/media/icon3.png'],
    ['subtitle' => '전국 최다!', 'title' => '등록된 매물<br>15,000개+', 'description' => '', 'image' => '/assets/media/icon4.png'],
    ['subtitle' => '믿을 수 있는 거래', 'title' => '검증된 중개사<br>2,500명+', 'description' => '', 'image' => '/assets/media/icon5.png'],
];
@endphp

<x-v2.features.feature-cards :cards="$customCards" />
```

### With Container Class
```blade
<x-v2.features.feature-cards 
    :containerClass="'dark-theme custom-padding'"
/>
```

## Styling Features
- White card backgrounds
- 20px border radius
- Box shadow with hover effect
- Hover: translateY(-5px) with enhanced shadow
- Smooth transitions (0.3s ease)

## Notes for AI Agents
1. Component requires exactly 5 cards in the array
2. Each card must have: subtitle (can be empty), title (supports HTML), description (can be empty), image
3. Second column always contains cards at index 1 and 2 (small cards)
4. Cards 0, 3, 4 are large format:
   - Desktop: Image at bottom-right with `max(2vw, 130px)` sizing
   - Mobile: Image on right side at 60x60px
5. Cards 1, 2 are small format (image on right side for both desktop and mobile)
6. All images default to `/assets/media/m_bn_img_1.png`
7. Mobile view maintains horizontal card layout with text left, image right
8. Component uses flexbox for responsive layout
9. Titles support HTML for line breaks (`<br>`)
10. Card hover effects are applied to all card types