<?php namespace Arcanedev\Taxonomies\Traits;

use Arcanedev\Taxonomies\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
            Arr::get($configs, 'model',       Category::class),
            Arr::get($configs, 'morph.name',  'categorizable'),
            Arr::get($configs, 'morph.table', 'categories_relations')
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param  array  $categories
     */
    public function categorize($categories)
    {
        foreach ($categories as $category) {
            $this->attachCategory($category);
        }
    }

    /**
     * Detach all categories.
     *
     * @param  array  $categories
     */
    public function uncategorize($categories)
    {
        foreach ($categories as $category) {
            $this->detachCategory($category);
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
     * Attach a category.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $category
     */
    public function attachCategory(Model $category)
    {
        if ( ! $this->categories->contains($category->getKey())) {
            $this->categories()->attach($category);
        }
    }

    /**
     * Detach a category.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $category
     */
    public function detachCategory(Model $category)
    {
        $this->categories()->detach($category);
    }

    /**
     * Get the categories as a list with [id => name].
     *
     * @return array
     */
    public function categoriesList()
    {
        return $this->categories()
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
