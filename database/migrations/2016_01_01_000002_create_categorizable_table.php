<?php

use Arcanedev\Taxonomies\Bases\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateCategorizableTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateCategorizableTable extends Migration
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('taxonomies.categories.morph.table', 'categories_relations'));
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
            $table->integer('category_id');
            $table->morphs(config('taxonomies.categories.morph.name', 'categorizable'));
            $table->timestamps();
        });
    }
}
