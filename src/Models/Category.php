<?php namespace Arcanedev\Taxonomies\Models;

use Arcanedev\LaravelNestedSet\NodeTrait;
use Arcanedev\Taxonomies\Bases\Model;

/**
 * Class     Category
 *
 * @package  Arcanedev\Taxonomies\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int             id
 * @property  string          name
 * @property  string          slug
 * @property  string          description
 * @property  int             _lft
 * @property  int             _rgt
 * @property  int             parent_id
 * @property  \Carbon\Carbon  created_at
 * @property  \Carbon\Carbon  updated_at
 */
class Category extends Model
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use NodeTrait;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', '_lft', '_rgt', 'parent_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

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
        return self::get()->toTree()->toArray();
    }
}
