<?php
/**
 * In the model data must be prepared for all templates with which the called action works,
 * this is both a main template for some who make up a content.
 */

/**
 * Database object for data from the database, uncomment if necessary to work with DB.
 */
// $db = new \core\Db();


function get_index_data()
{
    return [
        'title' => 'SIA Unibep datu sistēma',
        'description' => null,
        'keywords' => null,
    ];
}
