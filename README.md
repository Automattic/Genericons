# Genericons

Genericons are generic looking icons, suitable for a blog or simple website.

Genericons 4.0 is **not fully backwards compatible**, so you can't just drop-in replace this new version. For example, there are no social logos this set anymore, if you need that, please consider <a href="https://github.com/Automattic/social-logos">Social Logos</a>. If you need the old version of Genericons, <a href="genericons-classic.zip">that's available too</a>.

## Usage

The Genericons icon set comes in three versions:

- Minimized SVG files in the `svg-min` directory
- An SVG sprite (compatible with IE9 and up) in the `svg-sprite` directory
- An icon font (<a href="https://code.google.com/p/chromium/issues/detail?id=426333">shows up blurry in Chrome</a>) in the `icon-font` directory

### Using SVG in WordPress themes

First, include the PHP file in your `functions.php` or elsewhere in your theme/plugin:

`require get_template_directory() . '/genericons/svg-php/genericons.php';`

Then, use a PHP function to display the icon where you'd like to use it:

`<?php genericon( 'menu' ); ?>`

If you want the Genericon returned, rather than output, use `get_genericon()` instead:

`<?php get_genericon( 'menu' ); ?>`

If you need to assign an ID to a specific Genericon, you can do that by passing the ID as a parameter:

`<?php get_genericon( 'menu', 'menu-button' ); ?>`

The script uses [HTML-inline SVG sprites](https://24ways.org/2014/an-overview-of-svg-sprite-creation-techniques/). By default, it references an external SVG sprite in order to leverage browser caching. If you'd prefer to inject the sprite inline for whatever reason, pass `false` as the third parameter of the function:

`<?php genericon( 'menu', '', false ); ?>`

[svg4everybody](https://github.com/jonathantneal/svg4everybody) is bundled in order to provide full IE support, from IE9 and up.

The final parameter allows you to manually define the title used for screen readers. Set it to 'none' if the icon is purely presentational, otherwise pass a value for a more specific title.

`<?php genericon( 'twitter', '', true, 'Follow me on Twitter' ); ?>``

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
