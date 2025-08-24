# Button Classes Documentation for AI Agents

## Purpose
This document defines button CSS classes used in the GSNTalk project. These classes follow a modern, flexible button system with consistent styling.

## CSS Variables
```css
--btn-primary-color: var(--secondary-color)  /* Uses #007FFF */
--btn-primary-hover: var(--secondary-color-dark)  /* Uses #0066CC */
--btn-primary-active: #0052A3
--btn-secondary-color: #000000
--btn-secondary-hover: var(--secondary-color)  /* Uses #007FFF */
--btn-padding-lg: 16px 32px
--btn-padding-md: 12px 24px
--btn-padding-sm: 8px 16px
--btn-radius: 8px
```

## Base Button Class

### .btn
- **Required base class** for all buttons
- **Default style: Black background (#000000)**
- **Default hover: Blue background (#007FFF)**
- Display: inline-flex
- Align-items: center
- Justify-content: center
- Height: 48px (default)
- Gap: 8px (for icons)
- Font-size: 16px
- Font-weight: 600
- Line-height: 1.5
- Border-radius: 8px
- Background: var(--btn-secondary-color) (black by default)
- Color: white
- Border: 1px solid var(--btn-secondary-color)
- Hover: Changes to blue (#007FFF)
- Transition: all 0.2s ease
- Cursor: pointer

## Button Sizes

### .btn-lg (Large)
- Class combination: `btn btn-lg`
- Padding: 16px 32px
- Font-size: 18px
- Height: 56px

### .btn-md (Medium - Default)
- Class combination: `btn btn-md` or just `btn`
- Padding: 12px 24px
- Font-size: 16px
- Height: 48px

### .btn-sm (Small)
- Class combination: `btn btn-sm`
- Padding: 8px 16px
- Font-size: 14px
- Height: 36px

## Button Variants

### Primary Button
- Class: `btn btn-primary`
- Background: #007FFF
- Color: white
- Border: 2px solid #007FFF
- Hover: Background #0066CC
- Active: Background #0052A3

### Secondary Button
- Class: `btn btn-secondary`
- Background: #000000
- Color: white
- Border: 2px solid #000000
- Hover: Background #007FFF (changes to blue)

### Outline Primary
- Class: `btn btn-outline-primary`
- Background: white
- Color: #007FFF
- Border: 2px solid #007FFF
- Hover: Background #007FFF, Color white

### Outline Secondary
- Class: `btn btn-outline-secondary`
- Background: white
- Color: #000000
- Border: 2px solid #000000
- Hover: Background #007FFF, Color white

### Ghost Button
- Class: `btn btn-ghost`
- Background: transparent
- Color: #007FFF
- Border: none
- Hover: Background rgba(0, 127, 255, 0.1)

## Button States

### Disabled State
- Attribute: `disabled`
- Opacity: 0.5
- Cursor: not-allowed
- Pointer-events: none
- Example: `<button class="btn btn-primary" disabled>Disabled</button>`

### Loading State
- Class: `btn-loading`
- Shows loading spinner
- Disables interaction

## Width Modifiers

### Full Width Button
- Class: `btn-full`
- Width: 100%
- Example: `btn btn-primary btn-full`

## Button with Icons

Icons can be added as child elements. The `.btn` class has `gap: 8px` for proper spacing.

### Icon Position Examples:
```html
<!-- Icon on left -->
<button class="btn btn-primary">
    <svg>...</svg>
    Button Text
</button>

<!-- Icon on right -->
<button class="btn btn-primary">
    Button Text
    <svg>...</svg>
</button>

<!-- Icon only -->
<button class="btn btn-primary">
    <svg>...</svg>
</button>
```

## Usage Examples for AI Agents

### Default button (black with blue hover):
```html
<button class="btn">Default Button</button>
```

### Primary button (blue):
```html
<button class="btn btn-primary">Primary Button</button>
```

### Large secondary button:
```html
<button class="btn btn-secondary btn-lg">Large Button</button>
```

### Small outline button:
```html
<button class="btn btn-outline-primary btn-sm">Small Outline</button>
```

### Full width button:
```html
<button class="btn btn-primary btn-full">Full Width Button</button>
```

### Button with icon:
```html
<button class="btn btn-primary">
    <span>✓</span>
    Save Changes
</button>
```

### Disabled button:
```html
<button class="btn btn-primary" disabled>Disabled Button</button>
```

### Ghost button:
```html
<button class="btn btn-ghost">Ghost Button</button>
```

### Button group example:
```html
<div style="display: flex; gap: 12px;">
    <button class="btn btn-outline-secondary">Cancel</button>
    <button class="btn btn-primary">Confirm</button>
</div>
```

## Important Rules for AI Agents

1. **Always use `btn` base class** - Never use button variant classes alone
2. **Combine classes properly** - `class="btn btn-primary btn-lg"` not `class="btn-primary-lg"`
3. **Don't mix incompatible variants** - Don't use `btn-primary btn-secondary` together
4. **Use semantic HTML** - Use `<button>` or `<a class="btn">` elements
5. **Don't hardcode colors** - Use the predefined classes, not inline styles
6. **Icon spacing is automatic** - The gap property handles spacing, don't add margins
7. **Disabled state uses attribute** - Use `disabled` attribute, not a class
8. **Full width is a modifier** - Combine with variant: `btn btn-primary btn-full`

## Legacy Button Classes (DO NOT USE)
These classes exist for backward compatibility but should NOT be used in new code:
- `btn_point`, `btn_point_ghost`
- `btn_gray`, `btn_gray_ghost`
- `btn_graydeep_ghost`, `btn_graylight_ghost`
- `btn_md`, `btn_sm` (without base `btn` class)

## File Location
These classes are defined in: `/var/www/php-gsntalk/public/assets/css/common.css`

## Component Showcase
View live examples at: `/component-viewer` → designsystem → buttons-new