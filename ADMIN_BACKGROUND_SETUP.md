# Admin Dashboard Background Setup Guide

## Overview
This guide will help you add a professional courtroom background image (judge with gavel) to your admin dashboard pages.

## Step 1: Get a Courtroom Background Image

### Option A: Use Free Stock Images
Download a professional courtroom image from these free sources:

1. **Unsplash** (https://unsplash.com)
   - Search: "courtroom judge gavel"
   - Search: "judge hammer court"
   - Search: "law court justice"

2. **Pexels** (https://pexels.com)
   - Search: "courtroom"
   - Search: "judge gavel"
   - Search: "law court"

3. **Pixabay** (https://pixabay.com)
   - Search: "courtroom judge"
   - Search: "gavel justice"

### Option B: Use AI-Generated Images
Generate a custom image using:
- **DALL-E** (https://openai.com/dall-e)
- **Midjourney** (https://midjourney.com)
- **Leonardo.ai** (https://leonardo.ai)

**Suggested Prompt:**
```
"Professional courtroom interior with judge's bench and gavel, 
dark wood paneling, dramatic lighting, cinematic, high quality, 
photorealistic, wide angle"
```

### Recommended Image Specifications:
- **Resolution**: 1920x1080 or higher
- **Format**: JPG or PNG
- **File Size**: Under 500KB (optimize for web)
- **Aspect Ratio**: 16:9 or wider
- **Style**: Professional, slightly dark/dramatic lighting

## Step 2: Optimize the Image

Before uploading, optimize your image:

1. **Resize** to 1920x1080 pixels
2. **Compress** using:
   - TinyPNG (https://tinypng.com)
   - Squoosh (https://squoosh.app)
   - ImageOptim (Mac)
3. **Target file size**: 200-400KB

## Step 3: Add Image to Your Project

1. Save your optimized image as `admin-bg.jpg`
2. Place it in: `public/images/admin-bg.jpg`

```bash
# From your project root (c:\xampp\htdocs\eWitnessVault)
# Copy your downloaded image to:
public/images/admin-bg.jpg
```

## Step 4: Verify the Setup

The CSS is already configured in `resources/css/admin.css`:

```css
body.admin-dashboard {
    background-image: url('/images/admin-bg.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
```

## Step 5: Test the Background

1. **Clear Laravel cache**:
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

2. **Rebuild assets**:
   ```bash
   npm run build
   # or for development:
   npm run dev
   ```

3. **Visit admin pages**:
   - http://localhost/eWitnessVault/public/admin/dashboard
   - http://localhost/eWitnessVault/public/admin/users
   - http://localhost/eWitnessVault/public/admin/roles

## Alternative: Use a Darker Overlay

If the background is too bright, adjust the overlay in `resources/css/admin.css`:

```css
body.admin-dashboard::before {
    background: linear-gradient(135deg, 
        rgba(15, 23, 42, 0.95) 0%,    /* Increase from 0.92 to 0.95 */
        rgba(30, 41, 59, 0.92) 50%,   /* Increase from 0.88 to 0.92 */
        rgba(15, 23, 42, 0.95) 100%); /* Increase from 0.92 to 0.95 */
}
```

## Troubleshooting

### Background not showing?
1. Check file path: `public/images/admin-bg.jpg` exists
2. Clear browser cache (Ctrl+Shift+R or Cmd+Shift+R)
3. Check browser console for 404 errors
4. Verify Vite is running: `npm run dev`

### Background too bright/dark?
Adjust the overlay opacity in `resources/css/admin.css` (lines 18-26)

### Background not fixed on scroll?
Ensure `background-attachment: fixed;` is set in the CSS

## Current Setup Status

✅ **Completed:**
- Admin CSS file created (`resources/css/admin.css`)
- CSS imported in `resources/css/app.css`
- Layout updated to apply `admin-dashboard` class
- Glass-morphism styling configured
- Responsive design implemented

⏳ **Pending:**
- Add courtroom background image to `public/images/admin-bg.jpg`

## Quick Start Commands

```bash
# Navigate to project
cd c:\xampp\htdocs\eWitnessVault

# Clear caches
php artisan view:clear
php artisan cache:clear

# Rebuild assets
npm run build

# Start development server (if needed)
php artisan serve
```

## Support

If you need help finding or creating the perfect courtroom image, let me know and I can:
1. Suggest specific free images
2. Provide more detailed AI prompts
3. Help adjust the CSS styling

