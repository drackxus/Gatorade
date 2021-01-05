<?php

add_action('user_register','usuario_registrado_callback');

function usuario_registrado_callback($user_id){
    $user = get_user_by( 'id', $user_id );
    $new = array(
        'post_title' => $user->data->user_nicename,
        'post_type' => 'perfiles',
        'post_status' => 'publish'
    );

    $post_id = wp_insert_post( $new );
    update_post_meta($post_id, 'usuario', $user->data->user_nicename);
}