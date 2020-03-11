<?php
/*
   Template Name: Downlode Page
 *
 *
 *
 * @package fortun
 */

 get_header('data'); 


if( isset( $_POST['vdm_download_files'] ) ) {
    var_dump( $_POST['vdm_download_files'] );
}


$folders = get_user_meta( get_current_user_id(), '_vdm_download_info', true );


$args = array(
    'post_type' => 'user-data',
    'post_status' => 'publish',
    'posts_per_page' => 1000,
);

$postd = new WP_Query($args);


?>


<div class="vdm-tab-title-wrap">
    <div class="vdm-container">
        <div class="vdm-tab-title-column">
            <div class="vdm-tab-title">
                <h3>the old bakery</h3>
            </div>
            <div class="vdm-tab-title-menu">
                <ul>
                    <li><a href="#">my downloads</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="tabbable">
    <div class="vdm-tab-main-wrap">
        <div class="vdm-custom-tab">
            <h4 class="vdmmenu-title">folder</h4>
            <div class="vdm-tab-menu">
                <ul>
                    <li>
                        <a href="#"><i class="fas fa-folder"></i> home</a>
                       <ul class="tabs">
                            <?php if ($postd->have_posts()): while($postd->have_posts()): $postd->the_post();?>
                            	<li><i class="fas fa-chevron-right"></i><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                            <?php endwhile; endif; wp_reset_postdata(); ?>
                        </ul> 
                    </li>
                </ul>
            </div>
        </div>
        <div class="vdm-tab-form">
            <form method="post">
                <div class="vdm-tab-item">
                    <div class="vdm-tab-item-header">
                        <div class="header-left">
                            <ul>
                                <li><a href="<?php home_url() ?>">home</li>
                            </ul>
                        </div>
                        <div class="header-right">
                            <input type="submit" class="download-all" value="download all">
                            <?php wp_nonce_field( 'vdm_download_action', 'vdm_download_nonce' ) ?>
                        </div>
                    </div>
                    <div class="vdm-table-wrap">
                        <table class="vdm-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-group">
                                            <input type="checkbox" class="vdm_all_checked" id="vdm-allchecked-<?php echo $attachment_id; ?>">
                                            <label for="vdm-allchecked-<?php echo $attachment_id; ?>"></label>
                                        </div>
                                    </th>
                                    <th>Title</th>
                                    <th>Size</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ( (array)$folders as $attachment_id => $data) :

                                    $attachment_id = (int)$attachment_id;

                                    if( !isset( $attachment_id ) || empty( $attachment_id ) )
                                        return false;
                                    
                                    $fileurl = get_attached_file( $attachment_id );

                                    if( empty( $fileurl ) || !file_exists( $fileurl ) )
                                        return false;

                                    $bytes = filesize( $fileurl );
                                    $filesize = vdmFormatSizeUnits( $bytes );                    
                            
                                    $filename = basename( $fileurl );
                                    $filetype = wp_check_filetype($filename)['ext'];


                            
                                    $obj = get_post( $attachment_id );


                                    $upload_date = $obj->post_date;
                                    $upload_date = date( 'M d', strtotime($upload_date) );
                                    
                                    // $filesize = filesize( get_attached_file( $user_data ) );
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" name="vdm_download_files[]" value="<?php echo $attachment_id; ?>" id="checkbox-<?php echo $attachment_id; ?>">
                                                <label for="checkbox-<?php echo $attachment_id; ?>"></label>
                                            </div>
                                        </td>
                                        <td class="fixed-width"><img src="<?php echo vdm_filetype_icon($filetype); ?>" /><?php echo esc_html( $filename ); ?></td>
                                        <td><?php echo esc_html( $filesize ); ?></td>
                                        <td><?php echo esc_html( $upload_date ); ?></td>
                                    </tr>
                                <?php endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

        </div>
    </div>
<?php get_footer('data') ?>