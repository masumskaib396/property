<?php


if ( ! function_exists( 'agni_framework_setup_abc' ) ) :

	function agni_framework_setup_abc() {
		  add_theme_support( 'custom-logo' );
		
	}
endif;


add_action( 'after_setup_theme', 'agni_framework_setup_abc' );




function wp_child_enqueue_scripts() {
    wp_enqueue_style( 'parent-style', get_parent_theme_file_uri('/style.css'), array('fortun-bootstrap'));
    wp_enqueue_style( 'magnific-popup', get_theme_file_uri('/css/magnific-popup.css'));
	wp_enqueue_style('child-fontawesome', get_theme_file_uri('css/fontawesome.css'));
	// wp_enqueue_style( 'vdm-child', get_theme_file_uri('style.css'));

	wp_enqueue_script('magnific-popup', get_theme_file_uri('js/jquery.magnific-popup.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('childstyle-script', get_theme_file_uri('js/main.js'), array('jquery'), '1.0', true);

    wp_localize_script( 'childstyle-script', 'vdm_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'redirect_url' => home_url(),
        'nonce' => wp_create_nonce( 'vdm_ajax_nonce' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'wp_child_enqueue_scripts');





if (!function_exists('vdmFormatSizeUnits')) {
    function vdmFormatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}


function vdm_filetype_icon($type) {

    switch ($type) {
        case 'pdf':
            $icon = 'pdf';
            break;
        case 'doc':
            $icon = 'doc';
            break;
        case 'xlsx':
            $icon = 'xlsx';
            break;
        case 'zip':
            $icon = 'zip';
            break;
        case 'png':
            $icon = 'png';
            break;
        case 'csv':
            $icon = 'csv';
            break;
        case 'jpg':
        case 'jpeg':
        case 'gif':
        case 'svg':
        case 'ai':
            $icon = 'default';
            break;
        default:
            $icon = 'default';
            break;
    }

    $icon_url = get_stylesheet_directory_uri() . "/img/icons/{$icon}.png";
    return $icon_url;
}


require_once 'inc/cpt.php';
require_once 'inc/meta-boxex.php';
// require_once 'inc/crbon-fields.php';


/**
 * Download multiples files at once in WordPress
 */
function vdm_files_downloads() {


// update_user_meta(get_current_user_id(), '_vdm_download_info', '');

    if ( 
        ! isset( $_POST['vdm_download_nonce'] ) 
        || ! wp_verify_nonce( $_POST['vdm_download_nonce'], 'vdm_download_action' ) 
        || !isset($_POST['vdm_download_files'])
        || empty($_POST['vdm_download_files'])
        || !is_user_logged_in()
    ) {
       return;
    }

    /**
     * Get current user data
     */
    $current_user = wp_get_current_user();
    
    /**
     * Start Download Process
     */

    $download_fiels = (array) $_POST['vdm_download_files'];

    $foldername = "vdm-downloaded-files-by-{$current_user->user_login}/";

    $new_data = array();
    
    /**
     * Get current user ID
     */
    $user_id = $current_user->ID;

    // get current date
    $current = date('m/d/Y h:i:s a', time());
    $timestamp = strtotime($current);

    // get old data
    $old_data = get_user_meta($user_id, '_vdm_download_info', true);

    /**
     * Get site current upload dir and path
     */
    $upload_dir = wp_get_upload_dir();
    $filepath = $upload_dir['path'] . '/';

    /**
     * Naming the file. you can change it as you wish.
     */
    $filename = 'vdm-download-files-' .uniqid() . "-" . $user_id . ".zip";

    /**
     * Full location for the zip. where it should be saved.
     * 
     */
    $mainFile = $filepath.$filename;

    /**
     * Make sure ZipArchive is available
     */
    if( !class_exists( 'ZipArchive' ) ) {
        print 'Sorry, this side did not support PHP default library "ZipArchive".';
        exit;
    }

    /**
     * Start create zip file using default php library : ZipArchive
     * 
     * @link https://www.php.net/manual/en/class.ziparchive.php
     * @link https://www.php.net/manual/en/ziparchive.addfile.php
     * 
     */
    $zip = new ZipArchive;
    $zip->open($mainFile, ZipArchive::CREATE);
    
    foreach ($download_fiels as $file) {
        
        /**
         * Get attachment file url
         */
        $url = get_attached_file((int)$file);
        if ( !isset( $url ) || !file_exists( $url ) ) {
            return;
        }
        
        /**
         * Then input in zip file
         */
        $zip->addFile($url, $foldername.basename($url));

        if ( !empty( $old_data ) && array_key_exists($file, $old_data) ) {
            $old_data[$file]['date'][] = $current;
        } else {
            $new_data[$file]['date'][] = $current;
            $new_data[$file]['size'] = $timestamp;
        }

    }
    $zip->close();

    /**
     * Before download make sure your zip has been created successfully.
     */
    if (file_exists($mainFile)) {

        if ( !empty( $old_data ) && !empty($new_data) ) {
            $new_data = $old_data + $new_data;
        } elseif ( !empty( $old_data ) && empty( $new_data ) ) {
            $new_data = $old_data;
        }
        
        update_user_meta($user_id, '_vdm_download_info', $new_data);

        /**
         * Get zip file size
         */
        $filesize = filesize($mainFile);

        /**
         * http headers for zip downloads
         * 
         * @link https://perishablepress.com/http-headers-file-downloads/
         */
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-Disposition:attachment; filename=\"".$filename."\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".$filesize);
        ob_end_flush();
        @readfile($mainFile);

        /**
         * Now delete the zip file. IF you want to store it then you can. just remove this line.
         */
        unlink($mainFile);
    
    }

}
add_action('wp_loaded', 'vdm_files_downloads');


function vdm_user_registration(){
    if ( ! isset( $_POST['vdm_user_reg_nonce'] ) 
        || ! wp_verify_nonce( $_POST['vdm_user_reg_nonce'], 'vdm_user_reg' ) 
    ) {
        return;
    }

    if( !isset( $_POST['email'] ) || !isset( $_POST['password'] ) )
        return;

    $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : '';
    $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : '';
    $uname = (isset($_POST['uname']) && !empty($_POST['uname'])) ? $_POST['uname'] : '';
    $cpassword = (isset($_POST['cpassword']) && !empty($_POST['cpassword'])) ? $_POST['cpassword'] : '';

    $error = array();

    if (empty($uname)) {
        $error['username_empty'] = "Username can\'t be empty";
    }

    if (strpos($uname, ' ' ) !== FALSE) {
        $error['username_space'] = "user has space";
    }
    
    if (username_exists( $uname )) {
        $error['username_exists'] = "User name already exists";
    }

    if (empty($email)) {
        $error['email_empty'] = "Email can\'t be empty";
    }

    if (!is_email($email)) {
        $error['email_valid'] = "Email has no valid value";
    }

    if (email_exists($email)) {
        $error['email_existence'] = "Email already exists";
    }

    if( empty( $password ) || empty( $cpassword ) ) {
        $error['pass_empty'] = "Password can\'t be empty";
    }

    if( strlen($password) < 6 || strlen($password) < 6 ) {
        $error['pass_length'] = "Password has to be at least 6 characters.";
    }

    if (strcmp($password, $cpassword) !== 0) {
        $error['password'] = "password didn't match";
    }

    if (count($error) == 0) {
        $user_id = wp_create_user( sanitize_text_field( $uname ),  $password, sanitize_email($email) );
        if( $user_id )
            return "use crate successfully";
    }else{
        return $error;
    }
};

add_action( 'wp_ajax_nopriv_vmd_login', 'vmd_login' );

function vmd_login(){

    check_ajax_referer( 'vdm_ajax_nonce', 'nonce' );

    $error = array();
    //Veryfi Nonce

    if( !isset( $_POST['user_login'] ) || !isset( $_POST['user_pass'] ) )
        return;
     $user = (isset($_POST['user_login']) && !empty($_POST['user_login'])) ? $_POST['user_login'] : '';
     $pass = (isset($_POST['user_pass']) && !empty($_POST['user_pass'])) ? $_POST['user_pass'] : '';
     $remember = (isset($_POST['remember']) && !empty($_POST['remember'])) ? (boolean)$_POST['remember'] : false;


    if (empty($user)) {
        $error['user_empty'] = "Username can\'t be empty";
    }

    if (empty($pass)) {
         $error['userpass_empty'] = "Password can\'t be empty";
    }

    if( count($error) != 0 ) {
        wp_send_json_error( $user );
        wp_die();
    }

    $creds = array(
        'user_login'    => $user,
        'user_password' => $pass,
        'remember' => $remember
    );
    $user = wp_signon( $creds, '' );

    if ( is_wp_error( $user ) ) {
        wp_send_json_error( 'Username or password is incorrect' );
        wp_die();
    } else {
        wp_set_current_user( $user->ID );
        wp_send_json_success( 'Successful, redirecting...' );
        wp_die();
    }
};

function vmd_redirect_custom_login_page(){
    wp_redirect(site_url(). "/login");
    exit();
}
add_action('wp_logout', 'vmd_redirect_custom_login_page');



function p_btn($attributes){
?>
<div id="login-popup" class="white-popup mfp-hide">
    <div class="form-registration">
        <div class="container">
            <div class="row form-inner">
                <div class="col-md-6 col-md-offset-3">
                    <div class="vdm-registration-form">
                        <?php if ( !is_user_logged_in() ) : ?>
                        <div class="vmd-form-heading">
                        <?php _e("Login Form");?>
                        </div>
                        <div class="vdm-form-msg"></div>
                        <form id="vdm_login" method="POST">
                            <p>
                                <label for="user_login" >User Name</label>
                                <input type="text"  value="" class="input" id="user_login" required name="user_login" />
                            </p>
                            
                            <p>
                                <label for="user_pass" >Password</label>
                                 <input type="password" value="" class="input" id="user_pass" required name="user_pass" />
                            </p>
                            
                            <div class="form-footer">
                                <p>
                                    <label for="remember">
                                    <input name="remember" type="checkbox" id="remember" value="1"  />
                                    Remember Me</label>
                                </p>
                                <p>
                                    <input type="submit" tabindex="100" value="Log In"id="wp-submit" name="wp-submit" />
                                </p>
                            </div>

                        </form>
                        <?php else : ?>
                            <div class="vmd-form-heading">
                                <?php _e("Your are already login.",'');?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    

$default = array(
    'text' => 'VIEW BROCHURE',
    'url' => '',
);

$params = shortcode_atts($default,$attributes);

if (is_user_logged_in()) {
    $value = $params['url'];
    $pclass = "";
}else{
    $value = "#login-popup";
    $pclass = "popup";
};

$btn = <<<EOD
<a class="btn btn-default {$pclass}" href="{$value}">{$params['text']}</a>
EOD;
return $btn;

}
add_shortcode( 'lbtn', 'p_btn' );











