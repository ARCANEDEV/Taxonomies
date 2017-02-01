<?php namespace Arcanedev\Taxonomies\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface  Categorizable
 *
 * @package   Arcanedev\Taxonomies\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Categorizable
{
    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    public function categories();

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function categoriesList();

    public function categorize($categories);

    public function uncategorize($categories);

    public function recategorize($categories);

    public function addCategory(Model $category);

    public function removeCategory(Model $category);
}
