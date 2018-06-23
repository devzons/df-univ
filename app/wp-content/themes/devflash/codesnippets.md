## Blog

	the_author_posts_link()

	the_time()

	get_the_category_list()

<div class="metabox">
	<p>Posted by <?php the_author_posts_link(); ?> on <?php the_time( 'M j Y' ); ?> in <?php echo WPget_the_category_list( ', ' ); ?></p>
</div>

 ===========================================

Method 1

	<?php if ( is_category() ) {
  		single_cat_title();
  	} 
  	if ( is_author() ) {
  		echo 'Posts by ' . get_the_author();
  	} ?>

Method 2

	the_archive_title();

	the_archive_description();

 ===========================================

## Custom Query

$homepagePosts = new WP_Query( array(

	'posts_per_page' => 2

) );

	'post_type' => 'page'
	'category_name' => 'awards'

	-------------------------

	echo wp_trim_words( get_the_content(), 18 )

	wp_reset_postdata()


## Automation

	gulpfile.js
	package.json
	setting.js
	webpack.config.js

	npm install

 ============================================

# Custom Query

## meta_key, meta_query

$today = date('Ymd');

$homepageEvents = new WP_Query( array(
	'posts_per_page' => 2,
	'post_type' => 'event',
	'meta_key' => 'event_date',
	'orderby' => 'meta_value_num',
	'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'event_date',
			'compare' => '>=',
			'value' => $today,
			'type' => 'numeric'
		)
	)
) );

## Query adjuster function

function university_adjust_queries( $query ) {
	if ( !is_admin() AND is_post_type_archive('event') AND $query->is_main_query() ) {
		$today = date('Ymd');
		$query->set( 'meta_key', 'event_date' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_query', array(
    		array(
    			'key' => 'event_date',
    			'compare' => '>=',
    			'value' => $today,
    			'type' => 'numeric'
    		)
	    ));
	}
}

add_action( 'pre_get_posts', 'university_adjust_queries' );

 ==========================================================

# Relational Posts


# Duplicate Code Clean up

 ==========================================================

# Live Search

## Javascript

## Open and close search

## Keyboard Events

## Managing Time

## Waiting Loading Spinner

# WP REST API

	wp-json/wp/v2/posts
	wp-json/wp/v2/posts?search=award

## How to search post type, pages, campuses, professor...

Before

import $ from 'jquery';

class Search {
	// 1. describe and create/initiate object
	constructor() {
		this.addSearchHTML();
		this.resultsDiv = $("#search-overlay__results");
		this.openButton = $(".js-search-trigger");
		this.closeButton = $(".search-overlay__close");
		this.searchOverlay = $(".search-overlay");
		this.searchField = $("#search-term");
		this.events();
		this.isOverlayOpen = false;
		this.isSpinnervisible = false;
		this.previousValue;
		this.typingTimer;
	}

	// 2. events
	events() {
		this.openButton.on( "click", this.openOverlay.bind(this) );
		this.closeButton.on( "click", this.closeOverlay.bind(this) );
		$(document).on( "keydown", this.keyPressDispatcher.bind(this) );
		this.searchField.on( "keyup", this.typingLogic.bind(this) );

	}

	// 3. methods (function, action)
	typingLogic() {
		if ( this.searchField.val() != this.previousValue ) {
			clearTimeout(this.typingTimer);

			if ( this.searchField.val() ) {
				if ( !this.isSpinnervisible ) {
					this.resultsDiv.html('<div class="spinner-loader"></div>');
					this.isSpinnervisible = true;
				}
				this.typingTimer = setTimeout( this.getResults.bind(this), 750 );
			} else {
				this.resultsDiv.html('');
				this.isSpinnervisible = false;
			}			
		}		
		this.previousValue = this.searchField.val();
	}
	
	// Sync vs Async =======================================================
	getResults() {
		$.getJSON( universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
			$.getJSON( universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val(), pages => {
				var combinedResults = posts.concat( pages );
				this.resultsDiv.html(`
					<h2 class="search-overlay__section-title">General Information</h2>
					${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
						${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}				
					${combinedResults.length ? '</ul>' : ''}
				`);
				this.isSpinnervisible = false;
			} );
		} );
	}

	// Async end ================================ 

	openOverlay() {
		this.searchOverlay.addClass( "search-overlay--active");
		$("body").addClass("body-no-scroll");
		this.searchField.val('');
		// after animation, ready to focus
		setTimeout( () => this.searchField.focus(), 301 );
		this.isOverlayOpen = true;
	}

	closeOverlay() {
		this.searchOverlay.removeClass( "search-overlay--active");
		$("body").removeClass("body-no-scroll");
		this.isOverlayOpen = false;
	}

	keyPressDispatcher(e) {
		if ( e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus') ) {
			this.openOverlay();			
		}

		if ( e.keyCode == 27 && this.isOverlayOpen ) {
			this.closeOverlay();			
		}
	}

	addSearchHTML() {
		$("body").append(`
			<div class="search-overlay">
				<div class="search-overlay__top">
					<div class="container">
						<i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
						<input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
						<i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
					</div>
				</div>
				<div class="container">
					<div id="search-overlay__results"></div>
				</div>
			</div> 
		`);
	}
}

export default Search;

After

	============================ Better and speed way ===============================
	getResults() {
		$.when( 
			$.getJSON( universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val() ), 
			$.getJSON( universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val() ) 
			).then( ( posts, pages ) => {
			var combinedResults = posts[0].concat( pages[0] );
			this.resultsDiv.html(`
				<h2 class="search-overlay__section-title">General Information</h2>
				${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
					${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}				
				${combinedResults.length ? '</ul>' : ''}
			`);
			this.isSpinnervisible = false;
		}, () => {
			this.resultsDiv.html('<p>Unexpected error; please try again.</p>');
		} );
	}
	==============================


# Custom WP REST API - add Custom field - customize json

	/wp-json/wp/v2/posts

## add custom field authorName -- functions.php

function university_custom_rest() {
	register_rest_field( 'post', 'authorName', array(
		'get_callback' => function() { return get_the_author(); }
	) );
}

	// Search.js

	getResults() {
		$.when( 
			$.getJSON( universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val() ), 
			$.getJSON( universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val() ) 
			).then( ( posts, pages ) => {
			var combinedResults = posts[0].concat( pages[0] );
			this.resultsDiv.html(`
				<h2 class="search-overlay__section-title">General Information</h2>
				${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
					${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ${ item.authorName }` : ''}</li>`).join('')}				
				${combinedResults.length ? '</ul>' : ''}
			`);
			this.isSpinnervisible = false;
		}, () => {
			this.resultsDiv.html('<p>Unexpected error; please try again.</p>');
		} );
	}

## Create custom API - Add new custom route(URL)
	
- by default, custom post type will not include in the REST API, show_in_rest

	register_post_type( 'professor', array(
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'public' => true,
		'labels' => array(
			'name' => 'Professors',
			'add_new_item' => 'Add New Professor',
			'edit_item' => 'Edit Professor',
			'all_items' => 'All Professors',
			'singular_name' => 'Professor'
		),
		'menu_icon' => 'dashicons-businessman'
	) );

4 Reasons why we're doing this -------------------------

	1. Custom search logic

	2. Response with less JSON data (load faster for visitors)

	3. Send only 1 getJSON request instead of 6 in our JS

	4. Perfect exercise for sharpening PHP skills


function university_register_search() {
	register_rest_route( 'university/v1', 'search', array(
		'methods' => WP_REST_SERVER::READABLE,
		'callback' => 'universitySearchResults'
	) );
}

add_action( 'rest_api_init', 'university_register_search');

function universitySearchResults() {
	return 'congrat';
}

## Create our own RAW JSON data

	- we don't have to create JSON data, php will automatically be changed to json in WP


