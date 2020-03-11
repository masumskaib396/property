<?php 
if (!defined('CMB2_LOADED')) {
	return;


}



function vdm_register_metabox() {
$prefix = 'vdm_';  
	  $cmb = new_cmb2_box( array(
	        'id'            => $prefix . 'metabox',
	        'title'         => esc_html__( 'All Property Data', 'vdm' ),
	        'object_types'  => array( 'user-data', ), 
	    ) );

	  $group_field_id = $cmb->add_field( array(
		    'id'            => $prefix . 'box',
		    'type'          => 'group',
		    'repeatable'    => true, 
		    'options'       => array(
		    'group_title'   => __( 'Property {#}', 'vdm' ),
		    'add_button'    => __( 'Add Data', 'vdm' ),
		    'remove_button' => __( 'Remove Student', 'vdm' ),
		    'sortable'      => true, 
		    ),
	  ) );

	  $cmb->add_group_field( $group_field_id, array(
	    'name'          => 'Property Name',
	    'id'            => $prefix . 'property_name',
	    'type'          => 'text',
	  ) );


	  $cmb->add_group_field( $group_field_id, array(
	    'name'          => 'Files',
	    'id'            =>  $prefix . 'image',
	    'type'          => 'file_list',
	    'text'    => array(
	    'add_upload_file_text' => 'Add File'
	    ),
	  ) );


}
add_action( 'cmb2_init', 'vdm_register_metabox' );