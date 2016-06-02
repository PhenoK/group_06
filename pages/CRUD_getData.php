<?php

/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
include( "../datatable/php/DataTables.php" );
 
// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;
 
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'product' )
    ->fields(
        Field::inst( 'id' ),
        Field::inst( 'type' ),
        Field::inst( 'name' ),
        Field::inst( 'price' ),
        Field::inst( 'inventory' ),
        Field::inst( 'rank' ),
        Field::inst( 'sales' ),
        Field::inst( 'pre_img' ),
        Field::inst( 'intro_img1' ) ,
        Field::inst( 'intro_img2' ) ,
        Field::inst( 'intro_img3' ),
        Field::inst( 'intro_video' ) 
       
            
    )

    ->process( $_POST )
    ->json();
?>