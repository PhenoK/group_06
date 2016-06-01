
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
Editor::inst( $db, 'book' )
    ->fields(
        Field::inst( 'id' ),
        Field::inst( 'lang' ),
        Field::inst( 'category' ),
        Field::inst( 'author' ),
        Field::inst( 'translator' ),
        Field::inst( 'publisher' ),
        Field::inst( 'publish_date' ),
        Field::inst( 'isbn' )  
    )
    ->process( $_POST )
    ->json();
?>