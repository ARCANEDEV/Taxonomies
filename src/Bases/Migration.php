<?php namespace Arcanedev\Taxonomies\Bases;

use Arcanedev\Support\Bases\Migration as BaseMigration;

/**
 * Class     Migration
 *
 * @package  Arcanedev\Taxonomies\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Migration extends BaseMigration
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->setConnection(config('taxonomies.database.connection', null));
        $this->setPrefix(config('taxonomies.database.prefix', null));
    }
}
