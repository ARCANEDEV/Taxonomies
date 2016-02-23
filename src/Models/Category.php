<?php namespace Arcanedev\Taxonomies\Models;

use Kalnoy\Nestedset\Node;

/**
 * Class     Category
 *
 * @package  Arcanedev\Taxonomies\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Category extends Node
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function categorizable()
    {
        return $this->morphTo();
    }

    /**
     * @param  string  $related
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function entries($related)
    {
        return $this->morphedByMany(
            $related,
            config('taxonomies.categories.morph.name', 'categorizable'),
            config('taxonomies.categories.morph.table', 'categories_relations')
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    public static function tree()
    {
        return static::get()->toTree()->toArray();
    }
}
