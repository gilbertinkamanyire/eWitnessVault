# Quick Guide: Download Courtroom Background Image

## Recommended Free Images

Here are direct links to high-quality, free courtroom images you can use:

### Option 1: Unsplash (Recommended)
1. Visit: https://unsplash.com/s/photos/courtroom
2. Look for images with:
   - Dark wood paneling
   - Judge's bench/gavel
   - Professional lighting
   - High resolution (1920x1080+)

**Suggested searches:**
- "courtroom judge"
- "law court interior"
- "judge gavel"
- "courthouse interior"

### Option 2: Pexels
1. Visit: https://www.pexels.com/search/courtroom/
2. Download any image you like (all are free for commercial use)

### Option 3: Pixabay
1. Visit: https://pixabay.com/images/search/courtroom/
2. Filter by "Photos" and "Large" size

## Quick Download Instructions

1. **Download** your chosen image
2. **Rename** it to `admin-bg.jpg`
3. **Move** it to: `c:\xampp\htdocs\eWitnessVault\public\images\admin-bg.jpg`

## Optimize Before Using (Optional but Recommended)

### Online Tools:
- **TinyJPG**: https://tinyjpg.com
  - Drag and drop your image
  - Download the compressed version
  - Rename to `admin-bg.jpg`

- **Squoosh**: https://squoosh.app
  - Upload image
  - Adjust quality to 80-85%
  - Download optimized version

### Target Specifications:
- **File size**: 200-400 KB
- **Dimensions**: 1920x1080 pixels
- **Format**: JPG

## Alternative: Use AI to Generate

If you can't find the perfect image, use AI:

### ChatGPT/DALL-E:
Prompt: "Professional courtroom interior with judge's wooden bench and gavel, dark mahogany paneling, dramatic lighting, photorealistic, wide angle, cinematic"

### Leonardo.ai (Free):
1. Visit: https://leonardo.ai
2. Sign up (free)
3. Use prompt: "Elegant courtroom interior, judge's bench with gavel, dark wood, professional lighting, high detail, photorealistic, 16:9"

### Bing Image Creator (Free):
1. Visit: https://www.bing.com/create
2. Use prompt: "Professional courtroom with judge's gavel on wooden bench, dark wood paneling, dramatic lighting, photorealistic"

## After Adding the Image

Run these commands in your terminal:

```bash
# Navigate to project
cd c:\xampp\htdocs\eWitnessVault

# Clear caches
php artisan view:clear
php artisan cache:clear

# Rebuild assets
npm run build

# Or for development with hot reload:
npm run dev
```

## Verify It Works

1. Open your browser
2. Visit: http://localhost/eWitnessVault/public/admin/dashboard
3. You should see the courtroom background with a dark overlay
4. The background should be fixed (doesn't scroll with content)

## Troubleshooting

**Image not showing?**
- Check file exists: `public/images/admin-bg.jpg`
- Clear browser cache: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)
- Check browser console for errors (F12)
- Make sure Vite is running: `npm run dev`

**Background too bright?**
- Edit `resources/css/dashboard-new.css`
- Find line 52-56 (admin overlay)
- Increase opacity values from 0.92 to 0.95

**Background too dark?**
- Edit `resources/css/dashboard-new.css`
- Find line 52-56 (admin overlay)
- Decrease opacity values from 0.92 to 0.85

## Current File Structure

```
eWitnessVault/
├── public/
│   └── images/
│       ├── home-bg.png          ✅ (existing)
│       └── admin-bg.jpg         ⏳ (add this)
├── resources/
│   ├── css/
│   │   ├── admin.css            ✅ (created)
│   │   └── dashboard-new.css    ✅ (updated)
│   └── Views/
│       ├── layouts/
│       │   └── app.blade.php    ✅ (updated)
│       └── admin/
│           └── dashboard.blade.php ✅ (updated)
```

## License Note

All images from Unsplash, Pexels, and Pixabay are:
- ✅ Free for commercial use
- ✅ No attribution required
- ✅ Can be modified
- ✅ Safe for your project

Choose any image you like!

