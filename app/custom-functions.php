<?php
/***
 * @Descripcion: custom-functions.php
 * Contiene las diferentes funciones utiles para presonalizacion de wordpress
 * Opciones de wordpress presonalizadas
 *
 *
***/

 
/* CREAR USER METAS */

// Hooks near the bottom of profile page (if current user) 
add_action('show_user_profile', 'custom_user_profile_fields');

// Hooks near the bottom of the profile page (if not current user) 
add_action('edit_user_profile', 'custom_user_profile_fields');

// @param WP_User $user
function custom_user_profile_fields( $user ) {
?>
    <h2>Intereses</h2>
    <table class="form-table">
        <tr>
            <th>
                <label for="interesCategoria"><?php _e( 'Categorías' ); ?></label>
            </th>
            <td>
                <input type="text" name="interesCategoria" id="interesCategoria" value="<?php echo esc_attr( get_the_author_meta( 'interesCategoria', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="interesEtiqueta"><?php _e( 'Etiquetas' ); ?></label>
            </th>
            <td>
                <input type="text" name="interesEtiqueta" id="interesEtiqueta" value="<?php echo esc_attr( get_the_author_meta( 'interesEtiqueta', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
    </table>

    <h2>Favoritos</h2>
    <table class="form-table">
        <tr>
            <th>
                <label for="favoritos"><?php _e( 'Favoritos' ); ?></label>
            </th>
            <td>
                <input type="text" name="favoritos" id="favoritos" value="<?php echo esc_attr( get_the_author_meta( 'favoritos', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
<?php
}


// Hook is used to save custom fields that have been added to the WordPress profile page (if current user) 
add_action( 'personal_options_update', 'update_extra_profile_fields' );

// Hook is used to save custom fields that have been added to the WordPress profile page (if not current user) 
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );

function update_extra_profile_fields( $user_id ) {
    if ( current_user_can( 'edit_user', $user_id ) )
        update_user_meta( $user_id, 'interesCategoria', $_POST['interesCategoria'] );
        update_user_meta( $user_id, 'interesEtiqueta', $_POST['interesEtiqueta'] );
        update_user_meta( $user_id, 'favoritos', $_POST['favoritos'] );
}

/* CREAR USER METAS */






?>
