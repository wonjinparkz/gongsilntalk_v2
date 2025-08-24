# Typography Classes Documentation for AI Agents

## Purpose
This document defines typography CSS classes used in the GSNTalk project. These classes should be used instead of hardcoding inline styles.

## Font Family
- Base font: `'Pretendard'`
- Fallback fonts: `-apple-system, BlinkMacSystemFont, system-ui, Roboto, 'Helvetica Neue', 'Segoe UI', 'Apple SD Gothic Neo', 'Noto Sans KR', 'Malgun Gothic', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', sans-serif`

## Heading Classes

### h1
- Class: `h1`
- Font-size: 60px
- Font-weight: 700
- Line-height: 1.2
- Usage: Main page titles, hero sections

### h2
- Class: `h2`
- Font-size: 48px
- Font-weight: 700
- Line-height: 1.3
- Usage: Section headings

### h3
- Class: `h3`
- Font-size: 36px
- Font-weight: 600
- Line-height: 1.4
- Usage: Sub-section headings

### h4
- Class: `h4`
- Font-size: 28px
- Font-weight: 600
- Line-height: 1.4
- Usage: Component titles

### h5
- Class: `h5`
- Font-size: 24px
- Font-weight: 500
- Line-height: 1.5
- Usage: Card titles, minor headings

### h6
- Class: `h6`
- Font-size: 20px
- Font-weight: 500
- Line-height: 1.5
- Usage: Small headings, labels

## Body Text Classes

### body-t-xl
- Class: `body-t-xl`
- Font-size: 20px
- Font-weight: 400
- Line-height: 1.6
- Usage: Extra large body text, lead paragraphs

### body-t-lg
- Class: `body-t-lg`
- Font-size: 18px
- Font-weight: 400
- Line-height: 1.6
- Usage: Large body text, emphasized content

### body-t-regular
- Class: `body-t-regular`
- Font-size: 16px
- Font-weight: 400
- Line-height: 1.6
- Usage: Standard body text, paragraphs

### body-t-sm
- Class: `body-t-sm`
- Font-size: 14px
- Font-weight: 400
- Line-height: 1.5
- Usage: Small text, secondary information

### body-t-caption
- Class: `body-t-caption`
- Font-size: 12px
- Font-weight: 400
- Line-height: 1.4
- Usage: Captions, labels, helper text

## Text Color Classes

### text-c-b1
- Class: `text-c-b1`
- Color: #1F1F1F
- Usage: Primary text, headings

### text-c-b2
- Class: `text-c-b2`
- Color: #4E4E4E
- Usage: Secondary text, body content

### text-c-b3
- Class: `text-c-b3`
- Color: #7A7A7A
- Usage: Tertiary text, placeholders, disabled states

## Font Weight Classes

### font-w-100
- Class: `font-w-100`
- Font-weight: 100 (Thin)

### font-w-200
- Class: `font-w-200`
- Font-weight: 200 (ExtraLight)

### font-w-300
- Class: `font-w-300`
- Font-weight: 300 (Light)

### font-w-400
- Class: `font-w-400`
- Font-weight: 400 (Regular)

### font-w-500
- Class: `font-w-500`
- Font-weight: 500 (Medium)

### font-w-600
- Class: `font-w-600`
- Font-weight: 600 (SemiBold)

### font-w-700
- Class: `font-w-700`
- Font-weight: 700 (Bold)

### font-w-800
- Class: `font-w-800`
- Font-weight: 800 (ExtraBold)

### font-w-900
- Class: `font-w-900`
- Font-weight: 900 (Black)

## Text Utility Classes

### text-a-left
- Class: `text-a-left`
- Text-align: left

### text-a-center
- Class: `text-a-center`
- Text-align: center

### text-a-right
- Class: `text-a-right`
- Text-align: right

### text-u-underline
- Class: `text-u-underline`
- Text-decoration: underline

### text-u-none
- Class: `text-u-none`
- Text-decoration: none

### text-t-uppercase
- Class: `text-t-uppercase`
- Text-transform: uppercase

### text-t-lowercase
- Class: `text-t-lowercase`
- Text-transform: lowercase

### text-t-capitalize
- Class: `text-t-capitalize`
- Text-transform: capitalize

## Usage Examples for AI Agents

### When creating a page title:
```html
<h1 class="h1 text-c-b1">Page Title</h1>
```

### When creating body content:
```html
<p class="body-t-regular text-c-b2">This is regular body text.</p>
```

### When creating a section with title and description:
```html
<div>
    <h2 class="h2 text-c-b1">Section Title</h2>
    <p class="body-t-lg text-c-b2">Section description text.</p>
</div>
```

### When creating small helper text:
```html
<span class="body-t-caption text-c-b3">Helper text or caption</span>
```

## Important Notes for AI Agents

1. **Never use inline styles** for typography. Always use these predefined classes.
2. **Combine classes** as needed: `class="h3 text-c-b1 text-a-center"`
3. **Default line-height** is already set in each class, no need to add manually.
4. **Font-family** is automatically applied through CSS, don't add it inline.
5. **Use semantic HTML elements** with appropriate classes: `<h1 class="h1">` not `<div class="h1">`
6. **Text color classes** can be combined with any typography class.
7. **Font weight classes** can override the default weight of heading/body classes when needed.

## File Location
These classes are defined in: `/var/www/php-gsntalk/public/assets/css/common.css`