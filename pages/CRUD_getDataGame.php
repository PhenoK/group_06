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
Editor::inst( $db, 'game' )
    ->fields(
        Field::inst( 'id' ),
        Field::inst( 'category' ),
        Field::inst( 'lang' ),
        Field::inst( 'sale_date'),
        Field::inst( 'company' ),
        Field::inst( 'platform' ),
        Field::inst( 'multi_player' )  
    )
    ->process( $_POST )
    ->json();
?>