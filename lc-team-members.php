<?php
/*
Plugin Name: LC Team Members
Description: Fully responsive Team Members Plugin
Author: Learn Codez
Version: 2.0
Author URI: http://learncodez.com
License: GPLv2
*/

add_action( 'init', 'lc_teammembers_init' );

	//Creating the custom Client Testimonials type
	function lc_teammembers_init() 
	{
		/*≈=====≈=====≈=====≈=====≈=====≈=====≈=====
			Testimonial Post Type
		 ≈=====≈=====≈=====≈=====≈=====≈=====≈=====*/
		 // Setup post labels
		$post_type_labels = array(
			'name' => __( 'LC Team Members', 'lc-teammembers' ),
			'singular_name' => __( 'Team Member', 'lc-teammembers' ),
			'add_new' => __( 'Add New', 'lc-teammembers' ),
			'add_new_item' => __( 'Add New Team Member', 'lc-teammembers' ),
			'edit_item' => __( 'Edit Team Member', 'lc-teammembers' ),
			'new_item' => __( 'New Team Member', 'lc-teammembers' ),
			'view_item' => __( 'View Team Member', 'lc-teammembers' ),
			'search_items' => __( 'Search Team Members', 'lc-teammembers' ),
			'not_found' =>  __( 'No Team Members found', 'lc-teammembers' ),
			'not_found_in_trash' => __( 'No Team Members found in the trash', 'lc-teammembers' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'public' => true,
			'labels' => $post_type_labels,
			'singular_label' => __( 'Team Member', 'lc-teammembers' ),
			'public' => true,
			'show_ui' => true,
			'_builtin' => false,
			'_edit_link' => 'post.php?post=%d',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'teammember' ),
			'query_var' => 'teammember',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'menu_position' => 10,
			'menu_icon' => 'dashicons-groups' ,
			'register_meta_box_cb' => 'lc_teammembers_meta_boxes',		
		);

		register_post_type('teammembers', $args);	


		/*≈=====≈=====≈=====≈=====≈=====≈=====≈=====
		Testimonial Taxonomy
		≈=====≈=====≈=====≈=====≈=====≈=====≈=====*/
		// Register and configure Testimonial Category taxonomy
		$taxonomy_labels = array(
			'name' => __( 'Teammembers Department', 'lc-teammembers' ),
			'singular_name' => __( 'Department', 'lc-teammembers' ),
			'search_items' =>  __( 'Search Departments', 'lc-teammembers' ),
			'all_items' => __( 'All Departments', 'lc-teammembers' ),
			'parent_item' => __( 'Parent Departments', 'lc-teammembers' ),
			'parent_item_colon' => __( 'Parent Department', 'lc-teammembers' ),
			'edit_item' => __( 'Edit Department', 'lc-teammembers' ),
			'update_item' => __( 'Update Department', 'lc-teammembers' ),
			'add_new_item' => __( 'Add New Department', 'lc-teammembers' ),
			'new_item_name' => __( 'New Department', 'lc-teammembers' ),
			'menu_name' => __( 'Department', 'lc-teammembers' )
	  	);

		register_taxonomy( 'teammember_department', 'teammembers', array(
				'hierarchical' => true,
				'labels' => $taxonomy_labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'teammembers' )
			)
		);		
    
	}


/**
 * Adding the necessary metabox
 *
 * This functions is attached to the 'testimonials_post_type()' meta box callback.
 */
function lc_teammembers_meta_boxes() {
	add_meta_box( 'lc_teammembers_form', 'Member Details', 'lc_teammembers_form', 'teammembers', 'normal', 'high' );
}

/**
 * Adding the necessary metabox
 *
 * This functions is attached to the 'add_meta_box()' callback.
 */
function lc_teammembers_form() {
	$post_id = get_the_ID();
	$teammember_data = get_post_meta( $post_id, '_teammember', true );
	$position = ( empty( $teammember_data['position'] ) ) ? '' : $teammember_data['position'];
	$twitter_link = ( empty( $teammember_data['twitter_link'] ) ) ? '' : $teammember_data['twitter_link'];
	$facebook_link = ( empty( $teammember_data['facebook_link'] ) ) ? '' : $teammember_data['facebook_link'];
	$linkedin_link = ( empty( $teammember_data['linkedin_link'] ) ) ? '' : $teammember_data['linkedin_link'];
	$googleplus_link = ( empty( $teammember_data['googleplus_link'] ) ) ? '' : $teammember_data['googleplus_link'];

	wp_nonce_field( 'teammembers', 'teammembers' );
	?>
	<p>
		<label>Position</label><br />
		<input type="text" value="<?php echo $position; ?>" name="teammember[position]" size="40" />
		<em><?php _e( 'The Designation Of the Team Member', 'lc_teammembers' ); ?></em>
	</p>
	<p>
		<label>Twitter</label><br />
		<input type="text" value="<?php echo $twitter_link; ?>" name="teammember[twitter_link]" size="40" />
		<em><?php _e( 'The Twitter link of the Team Member', 'lc_teammembers' ); ?></em>
	</p>
	<p>
		<label>Facebook</label><br />
		<input type="text" value="<?php echo $facebook_link; ?>" name="teammember[facebook_link]" size="40" />
		<em><?php _e( 'The Facebook link of the Team Member', 'lc_teammembers' ); ?></em>
	</p>
	<p>
		<label>LinkedIn</label><br />
		<input type="text" value="<?php echo $linkedin_link; ?>" name="teammember[linkedin_link]" size="40" />
		<em><?php _e( 'The LinkedIn link of the Team Member', 'lc_teammembers' ); ?></em>
	</p>
	<p>
		<label>Google Plus</label><br />
		<input type="text" value="<?php echo $googleplus_link; ?>" name="teammember[googleplus_link]" size="40" />
		<em><?php _e( 'The Google Plus link of the Team Member', 'lc_teammembers' ); ?></em>
	</p>

	<?php
}

add_filter( 'manage_edit-teammembers_columns', 'lc_teammembers_edit_columns' );
function lc_teammembers_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'teammember' => 'Team Member',
        'position' => 'Position',        
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
add_action( 'manage_posts_custom_column', 'lc_teammembers_columns', 10, 2 );
function lc_teammembers_columns( $column, $post_id ) {
    $teammember_data = get_post_meta( $post_id, '_teammember', true );
    switch ( $column ) {
        case 'teammember':
            the_excerpt();
            break;
        case 'position':
            if ( ! empty( $teammember_data['position'] ) )
                echo $teammember_data['position'];
            break;       
    }
}


add_action( 'save_post', 'lc_teammembers_save_post' );
/**
 * Data validation and saving
 *
 * This functions is attached to the 'save_post' action hook.
 */
function lc_teammembers_save_post( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	if ( ! empty( $_POST['teammembers'] ) && ! wp_verify_nonce( $_POST['teammembers'], 'teammembers' ) )
		return;

	if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;
	}

	if ( ! wp_is_post_revision( $post_id ) && 'teammembers' == get_post_type( $post_id ) ) {
		remove_action( 'save_post', 'lc_teammembers_save_post' );

		wp_update_post( array(
			'ID' => $post_id			
		) );

		add_action( 'save_post', 'lc_testimonials_save_post' );
	}

	if ( ! empty( $_POST['teammember'] ) ) {
		$teammember_data['position'] = ( empty( $_POST['teammember']['position'] ) ) ? '' : sanitize_text_field( $_POST['teammember']['position'] );
		$teammember_data['twitter_link'] = ( empty( $_POST['teammember']['twitter_link'] ) ) ? '' : sanitize_text_field( $_POST['teammember']['twitter_link'] );
		$teammember_data['facebook_link'] = ( empty( $_POST['teammember']['facebook_link'] ) ) ? '' : esc_url( $_POST['teammember']['facebook_link'] );
		$teammember_data['linkedin_link'] = ( empty( $_POST['teammember']['linkedin_link'] ) ) ? '' : sanitize_text_field( $_POST['teammember']['linkedin_link'] );
		$teammember_data['googleplus_link'] = ( empty( $_POST['teammember']['googleplus_link'] ) ) ? '' : esc_url( $_POST['teammember']['googleplus_link'] );
		update_post_meta( $post_id, '_teammember', $teammember_data );
	} else {
		delete_post_meta( $post_id, '_teammember' );
	}
}



//Adding the responsiveslides.js script and our script
function lc_teammembers_register_scripts(){
	//Only add these script if we are not in the admin dashboard
	if(!is_admin()){
		//wp_register_script('responsiveslides', plugins_url('js/responsiveslides.min.js', __FILE__), array('jquery') );
		//wp_enqueue_script('responsiveslides'); 

		wp_register_style( 'fontAwesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
		wp_enqueue_style( 'fontAwesome' );
		
		wp_register_style( 'Teammembers', plugins_url('lc-team-members/css/team-member.css') );
		wp_enqueue_style( 'Teammembers' );
		
	}
}


add_action('wp_print_scripts', 'lc_teammembers_register_scripts'); 


function display_lc_team_members() {
ob_start();
	//echo 'This is test team';
	//
	//We only want posts of the testimonials type

	global $post;
	$args = array(  
        'post_type' => 'teammembers',  
        'posts_per_page' => -1,
        'orderby' => 'published',
        'order' => 'ASC'
    );  


    

	$the_query = new WP_Query($args); ?>

	<?php
	//Creating a new side loop
    while ( $the_query->have_posts() ) : $the_query->the_post();   	
    
    	$img= get_the_post_thumbnail( $post->ID, 'large' );
    	$teammember_data = get_post_meta( $post->ID, '_teammember', true );
    	

    	$thumb_src = null;
		if ( has_post_thumbnail($post->ID) ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'team-thumb' );
			$thumb_src = $src[0];
		}


		?>


		<div class="team_member">
			<div class="profile-header">				
				<img src="<?php echo $thumb_src; ?>" alt="<?php the_title(); ?>, <?php echo $teammember_data['position']; ?>"> 
			</div>		
			<div class="profile-content">
				<h3><?php the_title(); ?></h3>
				<p class="position"><?php echo $teammember_data['position']; ?></p>
				
			</div>	
			<div class="social">	
				<?php if ($teammember_data['facebook_link']): ?>
					<a href="<?php echo $teammember_data['facebook_link']; ?>" target="blank">
						<i class="fa fa-facebook-square fa-2x "></i>
					</a>	
				<?php endif; ?>			
				<?php if ($teammember_data['twitter_link']): ?>
					<a href="<?php echo $teammember_data['twitter_link']; ?>" target="blank">
						<i class="fa fa-twitter-square fa-2x "></i>
					</a>	
				<?php endif; ?>
				<?php if ($teammember_data['linkedin_link']): ?>
					<a href="<?php echo $teammember_data['linkedin_link']; ?>" target="blank">
						<i class="fa fa-linkedin-square fa-2x "></i>
					</a>		
				<?php endif; ?>
				<?php if ($teammember_data['googleplus_link']): ?>
					<a href="<?php echo $teammember_data['googleplus_link']; ?>" target="blank">
						<i class="fa fa-google-plus-square fa-2x "></i>
					</a>
				<?php endif; ?>	
			</div>
			<div class="member_details">	
				<?php the_content(); ?>
			</div>
		</div>
		


		<?php

    	

    	endwhile;

	    // Reset Post Data
		wp_reset_postdata();

	?>


	<?php


 	return ob_get_clean();

}

add_shortcode('lc_team_members', 'display_lc_team_members');