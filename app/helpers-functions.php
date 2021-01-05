<?php
/***
 * @Descripcion: helpers-functions.php
 * Contiene las diferentes funciones axiliares a las demas funciones de wordpress
 *
 * Estas funciones auxiliares estan destinadas a ser accesibles por cuarquier funcion
 *
 *
***/


/*
|-------------------------------------------------------------------------------
| Function for the control and test variables
|
|-------------------------------------------------------------------------------
*/
function dump( $test, $metod = 2 ){

	$test = str_replace( '<', '&lt;', $test );
	$test = str_replace( '>', '&gt;', $test );

	echo '<pre class="dump">';

	if( $metod == 1 ){
		var_dump( $test );

	}else{
		print_r( $test );

	}
	echo '</pre>';
}


/*
|-------------------------------------------------------------------------------
| Function for the print paged
|-------------------------------------------------------------------------------
*/
function PrintPagination( $wp_query ){

	$big = 999999999;

	$arrgs = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '/page/%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'end_size' => 1,
		'mid_size' => 2,
		'prev_text' => '<i class="fa fa-chevron-left"></i>',
		'next_text' => '<i class="fa fa-chevron-right"></i>'
	);

	$postPagination = paginate_links( $arrgs );

	return $postPagination;

}


/*
|-------------------------------------------------------------------------------
| Function to clean and validate POST data
| @param { array } post_data: POST data
|-------------------------------------------------------------------------------
*/
function CleanPostData( $post_data ) {

	// Declaramos array con los datos escapados
	$cleaned_data = array();

	// Recorremos el array del POST para escapar los datos
	foreach( $post_data as $name => $data ) {

		// Determinamos si es un array anidado
		if( is_array( $post_data[ $name ] ) ) {

			// Recorremos y escapamos Array anidado
			foreach ( $post_data[ $name ] as $sub_name => $sub_data ) {
				$cleaned_data[ $name ][ $sub_name ] = esc_sql( $post_data[ $name ][ $sub_name ] );
			}

		} else {
			// Recorremos y escapamos datos
			$cleaned_data[ $name ] = esc_sql( $post_data[ $name ] );
		}
	}

	return $cleaned_data;

}

/*
|-------------------------------------------------------------------------------
| Function currente date
| @param { none }
|-------------------------------------------------------------------------------
*/
function FechaActual() {

	//Fecha Actual
	$local_time = time();
	$cur_year	= date("Y", $local_time);
	$cur_month	= date("m", $local_time);
	$cur_day	= date("j", $local_time);
	$is_current_day = $cur_day.'/'.$cur_month.'/'.$cur_year;

	return $is_current_day;

}


/*
|-------------------------------------------------------------------------------
| Function check if the value is empty
| @param { string } value: value to checking
| @param { string } ifEmpty: respond if value empty
|-------------------------------------------------------------------------------
*/
function issetVal( $value, $ifEmpty ) {

	if( isset( $value ) ){
		$theValue = $value;

	}else{
		$theValue = $ifEmpty;
	}

	return $theValue;

}

?>
