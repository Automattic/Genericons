# Genericons

Genericons are generic looking icons, suitable for a blog or simple website.

Genericons 4.0 is **not fully backwards compatible**, so you can't just drop-in replace this new version. For example, there are no social logos this set anymore, if you need that, please consider <a href="https://github.com/Automattic/social-logos">Social Logos</a>. If you need the old version of Genericons, <a href="genericons-classic.zip">that's available too</a>. 

## Usage

The Genericons icon set comes in three versions:

- Minimized SVG files in the `svg-min` directory
- An SVG sprite (not compatible with IE) in the `svg-sprite` directory
- An icon font (<a href="https://code.google.com/p/chromium/issues/detail?id=426333">shows up blurry in Chrome</a>) in the `icon-font` directory


## Building your own Genericons

Genericons are built semi-automatically. SVG source files in the `svg` directory are processed and converted into minimized SVGs, a sprite, and an icon font using `grunt`. To build your own version of Genericons, follow these instructions:

```
npm install
grunt
```

## Notes

**Photoshop mockups**

The `Genericons.ttf` file can be placed in your system fonts folder and used Photoshop or other graphics apps if you like.

If you're using Genericons in your Photoshop mockups, please remember to delete the old version of the font from Font Book, and grab the new one from the zip file. This also affects using it in your webdesigns: if you have an old version of the font installed locally, that's the font that'll be used in your website as well, so if you're missing icons, check for old versions of the font on your system.

**Pixel grid**

Genericons has been designed for a 16x16px grid. That means it'll look sharp at font-size: 16px exactly. It'll also be crisp at multiples thereof, such as 32px or 64px. It'll look reasonably crisp at in-between font sizes such as 24px or 48px, but not quite as crisp as 16 or 32. Please don't set the font-size to 17px, though, that'll just look terrible blurry.

**Antialiasing**

If you keep intact the `-webkit-font-smoothing: antialiased;` and `-moz-osx-font-smoothing: grayscale;` CSS properties. That'll make the icons look their best possible, in Firefox and WebKit based browsers.

**optimizeLegibility**

Note: On Android browsers with version 4.2, 4.3, and probably later, Genericons will simply not show up if you're using the CSS property "text-rendering" set to "optimizeLegibility.