<?php

use Arcanedev\Taxonomies\Bases\Migration;
use Illuminate\Database\Schema\Blueprint;
use Arcanedev\LaravelNestedSet\Utilities\NestedSet;

/**
 * Class     CreateCategoriesTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateCategoriesTable extends Migration
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('taxonomies.categories.table', 'categories'));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Migrate to database.
     */
    public function up()
    {
        $this->createSchema(function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            NestedSet::columns($table);
            $table->timestamps();
        });
    }
}
