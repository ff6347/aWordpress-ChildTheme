<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

$options = get_option("aWordpressChildTheme_options");
$guestbook_id = $options["guestbook"];

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php

      $page_id     = get_queried_object_id();
      if($page_id != $guestbook_id){
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'aWordpressChildTheme' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

      }
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 0,
          'reverse_top_level' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'aWordpressChildTheme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'aWordpressChildTheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'aWordpressChildTheme' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'aWordpressChildTheme' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
        $page_id     = get_queried_object_id();
    if($page_id == $guestbook_id){
    comment_form( array(
      'title_reply' => 'Hinterlassen Sie einen Eintrag',
      'label_submit' => 'Eintrag abschicken',
      'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    	'</label><textarea placeholder="Meine Nachricht" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    	'</textarea></p>',
    	'comment_notes_after' => '<p class="form-allowed-tags">' .sprintf(
      __( 'Erforderliche Felder sind markiert *. Deine E-Mail-Adresse wird nicht veröffentlicht.' )
    	) . '</p>',

    	)
    );
  }else{
   comment_form();
  }
  ?>

</div><!-- #comments -->