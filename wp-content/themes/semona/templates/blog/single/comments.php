<?php 
function sm_post_comments($comment, $args, $depth) { ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-wrapper clearfix">
			<div class="avatar">
				<?php echo get_avatar( $comment, 100 ); ?>
			</div>
			<div class="comment-box">
				<div class="comment-author">
					<h5 class="author"><?php echo get_comment_author_link(); ?></h5>
					<div class="date">
						<?php printf( esc_html__( 'Posted on %1$s at %2$s', 'semona' ), get_comment_date(),  get_comment_time() ); ?>
					</div>
					<div class="comment-links clearfix">
						<?php edit_comment_link( esc_html__( 'Edit', 'semona' ), '  ', '' ) ?>
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__('Reply', 'semona'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div>
				<div class="comment-text">
					<?php
					if( $comment->comment_approved == '0' ) {
						echo "<p class='sm-label-awaiting-moderation'>";
						echo esc_html__( 'Your comment is awaiting moderation.', 'semona' );
						echo '</p>';
					}
					comment_text();
					?>
				</div>
			</div>
		</div>
	</li>
<?php
}
?>
<div id="comments" class="sm-post-comments">
	<?php if( !post_password_required() ): ?>
		<?php
		if( have_comments() ) { ?>
			<h3 class="comments-label"><?php echo esc_html__( 'Comments', 'semona' ) ?></h3>
			<ol class="comment-list">
			<?php 
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 100,
					'callback'	=> 'sm_post_comments'
				) ); 
			?>
			</ol>
		<?php 
		} else {
			if( !comments_open() ) { ?>
			<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'semona' ); ?></p>
			<?php 
			}
		}
		?>
		<?php
		if( comments_open() ) {
			echo "<div id=\"comment-input\">";
			
			function sm_modify_comment_form_fields( $fields ){
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$fields['author'] = '<div class="comment-fields row"><div class="col-sm-4"><input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" placeholder="'. esc_html__( "Your Name...", 'semona' ).'" tabindex="1"'. ( $req ? 'aria-required="true"' : '' ).' class="sm-comment-form-field" /></div>';
				$fields['email'] = '<div class="col-sm-4"><input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'. esc_html__( "Email Address...", 'semona' ).'" tabindex="2"'. ( $req ? 'aria-required="true"' : '' ).' class="sm-comment-form-field"  /></div>';
				$fields['url'] = '<div class="col-sm-4"><input type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. esc_html__( "Your Website...", 'semona').'" tabindex="3" class="sm-comment-form-field" /></div></div>';
				return $fields;
			}
			add_filter( 'comment_form_default_fields', 'sm_modify_comment_form_fields' );
			
			global $user_identity;
			
			$comments_args = array(
					'must_log_in' => '<p class="must-log-in">' . sprintf( esc_html__( "You must be %slogged in%s to post a comment.", 'semona' ), '<a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ).'">', '</a>' ) . '</p>',
					'logged_in_as' => '<p class="logged-in-as">' . esc_html__( "Logged in as", 'semona' ) . ' <a href="' .admin_url( "profile.php" ).'">'.$user_identity.'</a>. <a href="' .wp_logout_url(get_permalink()).'" title="' . esc_html__("Log out of this account", 'semona').'">'. esc_html__("Log out &raquo;", 'semona').'</a></p>',
					'comment_notes_before' => '',
					'comment_notes_after' => '',
					'comment_field' => '<div id="comment-textarea"><textarea name="comment" id="comment" rows="4" tabindex="4" class="sm_modify_comment_form_fields" placeholder="'. esc_html__( "Your Comment...", 'semona' ).'"></textarea></div>',
					'id_submit' => 'comment-submit',
					'label_submit' => esc_html__( "Post Comment", 'semona' ),
			);
			$comments_args['title_reply'] = '<span class="comments-label leave-comment">' .  esc_html__( "Leave A Comment", 'semona' ) . '</span>';
			$comments_args['title_reply_to'] = $comments_args['title_reply'];
		
			comment_form( $comments_args );
			
			echo "</div>";
		}
		?>
	<?php else:
		echo '<div class="post-comment-protected-message">';
		echo esc_html__( 'This post is password protected. Please enter password to view comments.' , 'semona' );
		echo '</div>';
	endif; /* endif - post_password_protected() */ ?>
</div>