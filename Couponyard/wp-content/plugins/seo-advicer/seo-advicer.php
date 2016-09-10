<?php
/*
Plugin Name: SEO Advicer
Version: 1.4.2
Plugin URI: http://www.scorpiongodlair.com/seo-advicer-wordpress-plugin/
Description: SEO Advicer will give you random SEO Actions you need to take for better SEO Strength in your website. This includes many advices of OnSite SEO and OffSite SEO. Make sure to follow all of the tips given by SEO Advicer.
Author: ScorpionGod Lair
Author URI: http://www.scorpiongodlair.com
License: GPL2

SEO Advicer Plugin
Copyright (C) 2013, Shyam Chathuranga - shyam@scorpiongodlair.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function seo_advices_list() {
	/* All the SEO Advices are written by Shyam Chathuranga */
	$advices = "Three letters called SEO means Search Engine Optimization
SEO is the process of creating a highly user-friendly & highly useful websites
Just like you've 2 Hands, SEO also has 2 Hands
Those 2 hands of the SEO are OnSite & OffSite SEO
OnSite SEO means the process of improving the Quality <em>in</em> your website
OffSite SEO means the process of making your website popular in similar websites
One of the major factors of OnSite SEO is <a href='http://www.scorpiongodlair.com/keyword-density/' title='Read about Keyword Density more!'>Keyword Density</a>
<a href='http://www.scorpiongodlair.com/link-building-introduction/' title='Learn what is correct Link Building ...'>Link Building</a> is the most popular SEO action around the world
Yeah! Proper SEO can bring you higher Search Engine Rankings
You don't get the 100% of your Rankings, If you do only Link Building
Without <a href='http://www.scorpiongodlair.com/social-media-seo-helpers/' title='Don't rely on SEO & Social Media'>high quality and useful content</a>, You'll not increase your earnings
Traffic is the number of people who visit your website
Organic Traffic, It's the visitors who arrive from Search Engines in a result of what they search
Sometimes, Organic Traffic is known as Search Engine Traffic
In SEO, we call Search Engines as SEs sometimes.!
High SE rankings can boost your Sales overnight
Conversion Rate is the overall percentage of visitors who turn into your prospects
Since 2010, Google cares much about your Website Loading Time as one OnSite SEO factor
Don't use slow WordPress Themes, use faster Themes such as Genesis Themes.
Google loves websites which use Industry Latest Technologies such as HTML-5, CSS3
You need to use Meta Tags such as Meta Description, Meta Keywords
If you wanna make your website perform perfectly in Social Media....
Use OpenGraph Tags or OG Tags which are used by Facebook, GPlus, Pinterest
Make your content looks great on Twitter by adding Twitter Meta Cards
Create a perfect navigation menu in your website
Optimize every image you post by using ALT and Title attributes
Keyword Density is the no. of times the Targeted Keyword appears in your post
Always it is best to write 900+ words every time
Create official profiles on Pinterest, Twitter, Facebook, Google+ & Youtube
Write regular guest posts on High Authority Blogs
Do a simple Keyword Research to choose the Primary Keyword before writing
Create a sitemap.xml for your WordPress Website
Try to start the Meta Description with your Primary Keyword
Google use only 65 characters in Title, Don't use more than 65 chars
Write a Meta Description up to 150 characters, 5 chars is skipped for Date
Remove 'category' part of the Category URL slug
Get Google Authorship for your website
Having Google Authorship would boost your search rankings & trust
Keep a Posting Frequency of 5 per week, Google loves those who do
Use a good SEO Plugin in your WordPress website
Read well-explained SEO articles on <a href='http://www.scorpiongodlair.com' title='Internet Marketer, Genesis Developer'>ScorpionGod Lair</a>
Create a digitally achievable Goal, Hire a Professional to follow it
Use a well-developed WP Theme to feel the power of Theme SEO Coding
Minimize the number of plugins you use, it makes your website faster
Include possible functionality to your Theme, instead of using a Plugin
Disable duplicate content archives
Use Google Webmaster Tools to make your website index on Google within seconds
Claim your new website on Alexa
Cloak all your affiliate links,so they look okay for Google
Use %%postname%% as your permalink structure in WordPress
Yah! Breadcrumbs can help you in SERPs
Use Photoshop to Optimize your Images by using Meta Data Factor
Go to File > File Info in Photoshop to fill your Image Meta Data
ALT & Title Attributes, File Name and Perfect Meta Data makes an Image Search Optimized
Writing something under 150 chars won't help you - Make it attractive
Breadcrumbs will help Google to display your Page URL nicely
SEO is all about correct website improvements
Use Google Webmaster Tools and Bing Webmaster Tools
site:scorpiongodlair.com will show all of the Indexed Pages on Google - Check your domain
1st Step Google Authorship: Add Author G+ URL in WordPress
2nd Step Google Authorship: Add your Website to Contribution section in G+ Profile
3rd Step Google Authorship: Add a human picture to G+ Profile
Once you followed all 3 Steps for Google Authorship, you might get it
Bounce Rate is the number of visitors who leave your website under 10 seconds
If your Bounce Rate is high in Google Analytics, you're in a ranking danger
Creating useful content for people will reduce your Bounce Rate
'Not Provided' means Google doesn't reveal the Keyword your visitors arrive
Naturally add your Primary Keyword in a H2 or H3 Tag
Don't use H1 Tags more than <b>once</b>
Learn few <a href='http://www.scorpiongodlair.com/link-building-strategies/' title='42 Genuine Link Building Strategies'>Link Building Strategies</a>, Follow anyone you like
Use Google Analytics to check your Bounce Rates & Visitor behaviours
Claim your website on Technorati & Dmoz Directory
Competition bar in Keyword Planner Tool shows only the number of advertisers for that keyword
Proper competition for a Keyword can be found by searching on Google with that keyword
Competition doesn't mean it's Hard, it means niche is Hot
When competition rises in Keyword Planner Tool, it means high value for Adsense Ads
If you're using Genesis Theme, You should use <a href='http://wordpress.org/plugins/genesis-optimized-social-share/' title='Load 4 Popular Social Counters without affecting your Loading Time.!'>Optimized Social Share Plugin</a>
<a href='http://www.scorpiongodlair.com/genesis' title='See it in your own eyes'>Genesis Framework</a> is the fastest WordPress Theme Framework in the world
Always use Keyword Planner Tool to find the most profitable keyword for your post idea
Learn Copywriting, Read about Internet Marketing, Result - Better Post";

	// Here we split it into lines
	$advicesli = explode( "\n", $advices );

	// And then randomly choose a line
	return wptexturize( $advicesli[ mt_rand( 0, count( $advicesli ) - 1 ) ] );
}

// Displaying SEO Advicer Messages on WP Dashboard
add_action( 'admin_notices', 'seo_advices' );
function seo_advices() {
	$chosen = seo_advices_list();
	echo "<p id='advice'>$chosen</p>";
}

// Fancy looking Design by outputting these CSS Styles
add_action( 'admin_head', 'advices_style' );
function advices_style() {
	echo "
	<style type='text/css'>
	#advice {padding: 10px 15px; margin: 10px auto; width: 800px; font-size: 16px; background: #BFD3FF; border: 1px solid #3E6777; border-radius: 8px; text-align: center; text-shadow: 0px 1px #eee; color: #1B72A4; font-weight: bold; overflow: hidden; height: 16px;}
	</style>
	";
}
?>