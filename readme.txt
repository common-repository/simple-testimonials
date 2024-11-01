=== Simple Testimonials ===
Contributors: PIXELovely
Donate link: https://ko-fi.com/U6U31XPQI
Tags: testimonials, random testimonials, random quote, random testimonial
Requires at least: 3.0.1
Tested up to: 6.1.1
Stable tag: 1.0.7
Requires PHP: 5.2+
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily manage testimonials and display them anywhere on your blog in seconds, via blocks, widgets or shortcodes.

== Description ==
I created this plugin to make it easy peasy for my clients to manage all the nice things that _their_ customers and clients said about them. They've loved it so much, I've decided to make it available to the world.

When you install it, you will gain a new section in your wordpress admin where you can easily create and manage all your testimonials. It's extremely similar to creating a new post or page. Just go to the testimonial section, click "Add new", and follow the on-screen prompts. That's it. When you're done, you can get a random testimonial to display each time a page loads with the handy included widget, or the shortcode [testimonial]. Phew, easy peasy!

This plugin is perfect for you if:

*	You want to establish credibility on every page, not just a single testimonials page.
*	You want to manage everything in one place, instead of having to update a separate testimonials page and various text widgets in your sidebars.
*	You want a testimonial page that is auto-formatted, so everything looks uniform and clean, without you having to futz around with copy-pasting code.

== Installation ==

1. Download the zip file, and unzip it.
1. Upload the entire folder (simple-testimonials) to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

Now, to start using it, just:

1. Add some testimonials in the new testimonial section.
1. To display the testimonials in a sidebar or other widgetized location, simply drag the widget named "Random Testimonial" to your widget area. You may open the widget panel and choose a number of testimonials to display.
1. To display the testimonials in a post or page, type the shortcode **[testimonial]** into any post or page that you like. You can display more than one testimonial at a time by specifying a number, like this: **[testimonial number=3]** Just substitute your number for my 3.
1. To create a testimonials page, where all your testimonials are shown at once, use the shortcode above, but set the number to 0. When you use 0, no limit will be used, and all of your testimonials will be shown at once.
1. If you forgot how to use the testimonial plugin at any time, I've placed a 1 page user manual directly into the testimonial section of your admin area. You're welcome! :)

== Creating Testimonials ==

Create and customize your testimonials as you would a post or a page. Just click "Testimonials" in the left hand admin menu, and then click "Add New".

Enter the testimonial into the larger text area. Then in the slot labeled Attribution place the name, initials, or other more anonymous identifier (such as "happy customer from Atlanta"). You can also leave the attribution blank, if you prefer.

Remember to save, and you've created your first testimonial!

== Categorizing Testimonials ==
You can add your testimonials to categories of your choosing. While creating or editing a testimonial, find the box labelled "Testimonial Categories". If this is your first time categorizing your testimonials, you'll need to create some categories! Click the link "+Add New Category", name your new category, and click the button "Add New Category".

Put a check next to any categories you want this testimonial to be included in. Save your changes!

== Widgets ==
If you are using a ["widgetized"](http://codex.wordpress.org/Widgetizing_Themes) theme - that is, one that allows you to drag widgets to a sidebar, footer, or other location - you can display any number of testimonials in the sidebar.

Just find the widget named "Random Testimonial," and drag it to your widget area of choice. By default, this widget will show one testimonial. You may open its panel and select another number from the dropdown.

When using a widget, you may also enter a number of characters to limit how much of a testimonial to display. This will prevent extra-long testimonials from breaking your beautiful site design.

Want to give people a link to view the rest of a shortened testimonial, or just to see more of the nice things people have said about you? Just paste the URL to your testimonial page into the last slot on the widget, labeled "Add a read more link". A "read more" link will automatically appear at the bottom of the widget.

Remember to save!

== Shortcode ==
To add a testimonial anywhere at all, simply place this shortcode into a page or post: [testimonial]

When the page displays, that little tag will be transformed into a beautiful testimonial, randomly chosen from your collection!

By default, this tag will display a single random testimonial, but you can choose any number like this: [testimonial number=3] Just substitute your number for my 3 in this example.

If you want to only show testimonials from a particular category of testimonials, add the name of the category like this: [testimonial category=featured] Just substitute the name of your testimonial category for the word "featured" in this example.

You can even have your testimonials be picked out of more than one category! Use quotes around the list, and use commas to separate the names of all the categories you want to use. For example: [testimonial category="Best of 2016, Best of 2015"]

To create a page where all of your testimonials display at once, simply use the above shortcode, with the number set to 0. This will cause all of your testimonials to display at once. Their order will be random.

== Styling ==
This plugin deliberately employs extremely minimal default styling, to make it fit in with any theme.

If you are an advanced user and wish to apply your own CSS styles to the testimonials this plugin outputs, the plugin follows this structure:

`<div class='pixelovely_testimonial'>
<p>Testimonial</p>
<span class='pixelovely_testimonial_attribution'>- Attribution</span>
</div>
<span class='pixelovely_readmore'><a href='http://www.yourlinkhere.com/'>Read more</a><span>`

Apply your CSS to div.pixelovely_testimonial, span.pixelovely_testimonial_attribution and span.pixelovely_readmore

== Changelog ==
= 1.0.7 =
Tested up to 6.1.1

= 1.0.6 =
* Minor compliance changes

= 1.0.5 =
* Tested up to 5.8

= 1.0.3 =
* Tested up to 5.7.1

= 1.0.2 =
* Tested up to 5.5

= 1.0.1 =
* Renamed some functions for better compliance with WP plugin guidelines
* Removed/replaced some deprecated code
* Added a block for the new WP Blocks editor
* Moved manual to readme, removed manual page from plugin


= 1.0.0 =
* Added the ability to categorize your testimonials
* Added a dropdown to the widget options, for choosing a specific category to pick testimonials from
* Added a "category" attribute to testimonial shortcodes
* Updated manual page to describe the new options

= 0.0.9 =
* Re-uploading files from 0.0.8

= 0.0.8 =
* Updating to reflect that the plugin works in 4.2
* Fixing a broken span tag
* Added the basics of internationalization

= 0.0.7 =
* Updating to reflect that the plugin works in 4.0

= 0.0.6 =
* Changing interface from meta inputs to be their own inputs. This prevents the meta info from plugins from appearing above the main post-type inputs, such as SEO plugins.
* Updating admin icon to utilize new icon-fonts

= 0.0.5 =
* Minor fix to div structures when an attribution is not supplied.

= 0.0.4 =
* Added an optional character limit to testimonials outputted with a widget
* Added an optional "read more" link to the testimonial widget
* Made some changes to try to prevent SEO plugins from appearing on the testimonial composition page, as testimonials are not themselves intended to be stand-alone pages.
* Fixed broken image in the manual
* Updated manual to reflect new options
* Gave the testimonials section a custom icon in the admin backend

= 0.0.3 =
* Fixed an error in the shortcodes that could cause testimonials to appear in unexpected places in layouts with lots of floats.

= 0.0.2 =
* Excluded individual testimonials from search results, as they are not intended to be stand-alone pages.

= 0.0.1 =
* Plugin first released! I would very much appreciate it if you remembered to rate the plugin after trying it.
