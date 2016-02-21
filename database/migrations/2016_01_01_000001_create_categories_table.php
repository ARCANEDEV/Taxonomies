<?php

use Arcanedev\Taxonomies\Bases\Migration;
use Illuminate\Database\Schema\Blueprint;

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

            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();

            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->longText('description')->nullable();

            $table->timestamps();
        });
    }
}
