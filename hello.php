<?php
/**
 * @package Hello_Dolly
 * @version 1.7.2
 */
/*
Plugin Name: Hello Inspiration
Plugin URI: https://kurtisness.com
Description: Inspiration quotes from multiple authors, based on the plugin Hello Dolly by Matt Mullenweg.
Author: Kurt Ness
Version: 2.0.1
Author URI: https://kurtisness.com
*/

function hello_dolly_get_lyric() {
	/** These are the Quotes */
	$lyrics = "
''If a bullet should enter my brain, let that bullet destroy every closet door.'' - Harvey Milk
''Hope will never be silent'' - Harvey Milk
''How wonderful it is that nobody need wait a single moment before starting to improve the world.''- Anne Frank
''Peace cannot be kept by force; it can only be achieved by understanding.''- Albert Einstein
''...and you, and you, and you got to give them hope.''-Harvey Milk
''You will do the best that you can at this moment in your life.''-Mrs. Judi Olson
''I have not failed 10,000 times—I’ve successfully found 10,000 ways that will not work.''- Thomas Edison
''No person is your friend who demands your silence or denies your right to grow.''-Alice Walker
''My silences had not protected me. Your silence will not protect you.''-Audre Lorde
''Do one thing every day that scares you''-Eleanor Roosevelt
''Whatever you are, be a good one.''-Abraham Lincoln
''Make it a great day or not, the choice is yours''-Dr. Johansen
''Nothing will work unless you do.''-Maya Angelou
''Never regret anything that made you smile.''-Mark Twain
''Real change, enduring change, happens one step at a time.''-Ruth Bader Ginsburg
''Reacting in anger or annoyance will not advance one's ability to persuade.''-Ruth Bader Ginsburg
''You can disagree without being disagreeable''-Ruth Bader Ginsburg";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Various quotes from different authors for inspiration', 'hello-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_dolly' );

// We need some CSS to position the paragraph.
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );
