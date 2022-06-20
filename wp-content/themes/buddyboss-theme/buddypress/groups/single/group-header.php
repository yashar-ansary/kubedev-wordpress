<?php
/**
 * BuddyPress - Groups Header
 *
 * @since 3.0.0
 * @version 3.1.0
 */

$group_link = bp_get_group_permalink();
$admin_link = trailingslashit( $group_link . 'admin' );
$group_avatar = trailingslashit( $admin_link . 'group-avatar' );
$group_cover_link = trailingslashit( $admin_link . 'group-cover-image' );
$tooltip_position = bp_disable_group_cover_image_uploads() ? 'down' : 'up';
?>
<div id="cover-image-container" class="item-header-wrap">

	<?php $class = bp_disable_group_cover_image_uploads() ? 'bb-disable-cover-img' : 'bb-enable-cover-img'; ?>

	<div id="item-header-cover-image" class="<?php echo $class; ?>">
		<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
			<div id="item-header-avatar">
				<?php if ( bp_is_item_admin() ) { ?>
					<a href="<?php echo $group_avatar; ?>" class="link-change-profile-image" data-balloon-pos="down" data-balloon="<?php _e('Change Group Photo', 'buddyboss-theme'); ?>">
						<i class="bb-icon-edit-thin"></i>
					</a>
				<?php } ?>
				<?php bp_group_avatar(); ?>
			</div><!-- #item-header-avatar -->
		<?php endif; ?>

		<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
			<div id="item-header-content">
				<?php if ( function_exists('bp_enable_group_hierarchies') && bp_enable_group_hierarchies() ): ?>
					<?php
					$parent_id = bp_get_parent_group_id();
					if( $parent_id != 0 ) { ?>
						<div class="bp-group-parent-wrap flex align-items-center">
							<?php bp_group_list_parents(); ?>
							<div class="bp-parent-group-title-wrap">
								<a class="bp-parent-group-title" href="<?php echo bp_get_group_permalink( groups_get_group( $parent_id ) ); ?>"><?php echo bp_get_group_name( groups_get_group( $parent_id ) ); ?></a>
								<i class="bb-icon-chevron-right"></i>
								<span class="bp-current-group-title"><?php echo esc_attr( bp_get_group_name() ); ?></span>
							</div>
						</div>
					<?php } ?>
				<?php endif; ?>

				<div class="flex align-items-center bp-group-title-wrap">
					<h2 class="bb-bp-group-title"><?php echo esc_attr( bp_get_group_name() ); ?></h2>
                    <?php if ( function_exists('bp_get_group_status_description') ){ ?>
					    <p class="bp-group-meta bp-group-status" data-balloon-pos="<?php echo esc_attr( $tooltip_position ); ?>" data-balloon-length="large" data-balloon="<?php echo esc_html( bp_get_group_status_description() ); ?>"><?php echo wp_kses( bp_nouveau_group_meta()->status, array( 'span' => array( 'class' => array() ) ) ); ?></p>
					<?php } ?>
                    <p class="bp-group-meta bp-group-type"><?php echo wp_kses( bp_nouveau_group_meta()->status, array( 'span' => array( 'class' => array() ) ) ); ?></p>
				</div>

				<?php echo isset( bp_nouveau_group_meta()->group_type_list ) ? bp_nouveau_group_meta()->group_type_list : ''; ?>
				<?php bp_nouveau_group_hook( 'before', 'header_meta' ); ?>

				<?php if ( bp_nouveau_group_has_meta_extra() ) : ?>
					<div class="item-meta">
						<?php echo bp_nouveau_group_meta()->extra; ?>
					</div><!-- .item-meta -->
				<?php endif; ?>

				<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
					<?php if ( ! empty( bp_nouveau_group_meta()->description ) ) : ?>
						<div class="group-description">
							<?php echo bp_nouveau_group_meta()->description; ?>
						</div><!-- //.group_description -->
					<?php endif; ?>
				<?php endif; ?>

				<?php bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>

				<?php bp_nouveau_group_header_buttons(); ?>
				<?php
				if ( function_exists( 'bb_nouveau_group_header_bubble_buttons' ) ) {
					bb_nouveau_group_header_bubble_buttons();
				}
                ?>
			</div><!-- #item-header-content -->
		<?php endif; ?>

	</div><!-- #item-header-cover-image -->

</div><!-- #cover-image-container -->