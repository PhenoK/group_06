<?php

    
 
/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
include( "datable/php/DataTables.php" );
 
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
        Field::inst( 'name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'price' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'content' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'inventory' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'rank' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'sales' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'pre_img' )
           ->validator( 'Validate::notEmpty' ),
            ->setFormatter( 'Format::ifEmpty', null ),
        Field::inst( 'intro_img1' )
            ->validator( 'Validate::notEmpty' ),
            ->setFormatter( 'Format::ifEmpty', null ),
        Field::inst( 'intro_img2' )
            ->validator( 'Validate::notEmpty')
           
    )
    ->process( $_POST )
    ->json();

  
?>