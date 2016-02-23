<?php namespace Arcanedev\Taxonomies\Traits;

use Arcanedev\Taxonomies\Models\Category;
use Illuminate\Database\Eloquent\Model;

/**
 * Class     Categorizable
 *
 * @package  Arcanedev\Taxonomies\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  \Illuminate\Database\Eloquent\Collection  $categories
 *
 * @method    \Illuminate\Database\Eloquent\Relations\MorphToMany  morphToMany(string $related, string $name, string $table = null, string $foreignKey = null, $otherKey = null, $inverse = false)
 */
trait Categorizable
{
    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        $configs = config('taxonomies.categories', []);

        return $this->morphToMany(
            array_get($configs, 'model',       Category::class),
            array_get($configs, 'morph.name',  'categorizable'),
            array_get($configs, 'morph.table', 'categories_relations')
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function categoriesList()
    {
        return $this->categories()->lists('name', 'id')->toArray();
    }

    /**
     * @param  array  $categories
     */
    public function categorize($categories)
    {
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
    }

    /**
     * @param  array  $categories
     */
    public function uncategorize($categories)
    {
        foreach ($categories as $category) {
            $this->removeCategory($category);
        }
    }

    /**
     * @param  array  $categories
     */
    public function recategorize($categories)
    {
        $this->categories()->sync([]);

        $this->categorize($categories);
    }

    /**
     * @param Model $category
     */
    public function addCategory(Model $category)
    {
        if ( ! $this->categories->contains($category->getKey())) {
            $this->categories()->attach($category);
        }
    }

    /**
     * @param Model $category
     */
    public function removeCategory(Model $category)
    {
        $this->categories()->detach($category);
    }
}
