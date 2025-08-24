# Color Tokens Documentation for AI Agents

## Purpose
This document defines color tokens used in the GSNTalk project. These colors should be used consistently throughout the application.

## CSS Variables (Defined in :root)
```css
--main-color: #F16341
--primary-color: #F16341
--primary-color-light: #FF8A65
--primary-color-dark: #D84315
--primary-bg: #FFF5F2

--secondary-color: #007FFF
--secondary-color-light: #4DA3FF
--secondary-color-dark: #0066CC
--secondary-bg: #E6F2FF
```

## Primary Colors (Brand - Orange)
- **Primary**: `#F16341` - Main brand color
- **Primary Light**: `#FF8A65` - Light emphasis
- **Primary Dark**: `#D84315` - Dark emphasis  
- **Primary BG**: `#FFF5F2` - Background color

## Secondary Colors (Blue)
- **Secondary**: `#007FFF` - Secondary color
- **Secondary Light**: `#4DA3FF` - Light secondary
- **Secondary Dark**: `#0066CC` - Dark secondary
- **Secondary BG**: `#E6F2FF` - Secondary background

## Gray Scale
- **Gray 900**: `#212121` - Darkest gray
- **Gray 800**: `#424242`
- **Gray 700**: `#616161`
- **Gray 600**: `#757575`
- **Gray 500**: `#9E9E9E` - Mid gray
- **Gray 400**: `#BDBDBD`
- **Gray 300**: `#E0E0E0`
- **Gray 200**: `#EEEEEE`
- **Gray 100**: `#F5F5F5`
- **Gray 50**: `#FAFAFA` - Lightest gray

## Semantic Colors
### Success
- **Main**: `#4CAF50` - Success, completed status
- **Light**: `#C8E6C9` - Success background

### Warning
- **Main**: `#FF9800` - Warning, attention needed
- **Light**: `#FFE0B2` - Warning background

### Error
- **Main**: `#F44336` - Error, failed status
- **Light**: `#FFCDD2` - Error background

### Info
- **Main**: `#2196F3` - Information, guidance
- **Light**: `#BBDEFB` - Info background

## Background Colors
- **Page Background**: `#FAFAFA` - Full page background
- **Card Background**: `#FFFFFF` - Card/container background
- **Hover Background**: `#F5F5F5` - Hover state background
- **Selected Background**: `#FFF5F2` - Selected item background

## Text Colors
- **Primary Text**: `#212121` - Main text
- **Secondary Text**: `#666666` - Supporting text
- **Disabled Text**: `#999999` - Inactive text
- **Brand Text**: `#F16341` - Brand emphasis text
- **Black Text**: `#1F1F1F` - Alternative primary text (from typography)
- **Medium Text**: `#4E4E4E` - Alternative secondary text (from typography)
- **Light Text**: `#7A7A7A` - Alternative tertiary text (from typography)

## Border Colors
- **Default Border**: `#E0E0E0` - 1px width
- **Light Border**: `#F0F0F0` - 1px width
- **Focus Border**: `#F16341` - 2px width
- **Error Border**: `#F44336` - 2px width

## Button Color Variables
- **Button Primary**: `#007FFF` - Primary button color
- **Button Primary Hover**: `#0066CC` - Primary button hover
- **Button Primary Active**: `#0052A3` - Primary button active
- **Button Secondary**: `#000000` - Secondary/default button color
- **Button Secondary Hover**: `#007FFF` - Secondary button hover

## Usage Guidelines for AI Agents

### When to use Primary (Orange) colors:
- Brand identity elements
- Main navigation active states
- Important CTAs specific to GSNTalk brand
- Selected states for brand-specific features

### When to use Secondary (Blue) colors:
- General interactive elements
- Buttons and links
- Form focus states
- Information panels
- General CTAs

### When to use Semantic colors:
- **Success**: Completion messages, successful operations
- **Warning**: Alerts, caution messages
- **Error**: Error messages, validation failures
- **Info**: Informational messages, tooltips

### Color Combinations:
- **Text on white background**: Use `#212121` or `#1F1F1F`
- **Secondary text**: Use `#666666` or `#4E4E4E`
- **Disabled/placeholder text**: Use `#999999` or `#7A7A7A`
- **Primary brand emphasis**: Use `#F16341`
- **Secondary/interactive emphasis**: Use `#007FFF`

### Background Usage:
- **Page base**: `#FAFAFA`
- **Content cards**: `#FFFFFF`
- **Hover states**: `#F5F5F5`
- **Selected brand items**: `#FFF5F2`
- **Selected secondary items**: `#E6F2FF`

## Important Notes for AI Agents

1. **Primary color** (#F16341) is the GSNTalk brand color - use for brand-specific elements
2. **Secondary color** (#007FFF) is blue - use for general interactive elements and buttons
3. **Never hardcode colors** - use the defined color tokens
4. **Maintain contrast** - ensure text is readable on backgrounds
5. **Use semantic colors** for status messages
6. **Gray scale** should be used for neutral UI elements
7. **Borders** should use the defined border colors and widths

## File Locations
- Color showcase component: `/var/www/php-gsntalk/resources/views/components/v2/designsystem/colors.blade.php`
- CSS variables: `/var/www/php-gsntalk/public/assets/css/common.css`