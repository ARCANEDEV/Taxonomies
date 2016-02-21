<?php namespace Arcanedev\Taxonomies\Models;

use Baum\Node;

/**
 * Class     Category
 *
 * @package  Arcanedev\Taxonomies\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int             id
 * @property  Category        parent
 * @property  int             parent_id
 * @property  int             lft
 * @property  int             rgt
 * @property  int             depth
 * @property  string          name
 * @property  string          slug
 * @property  string          description
 * @property  \Carbon\Carbon  created_at
 * @property  \Carbon\Carbon  updated_at
 */
class Category extends Node
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Category constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::updating(function (Category $category) {
            // Baum triggers a parent move, which puts the item last in the list,
            // even if the old and new parents are the same
            if ($category->isParentIdSame()) {
                $category->stopBaumParentMove();
            }
        });
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get path attribute.
     *
     * Accessor for path attribute, which is a string consisting of the ancestors
     * of each node, separated by " > ".
     *
     * @return string
     */
    public function getPathAttribute()
    {
        $return    = [];

        foreach ($this->getAncestors() as $ancestor) {
            $return[] = $ancestor->name;
        }

        $return[] = $this->name;

        return implode(' > ', $return);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check for dirty parent ID.
     *
     * Returns true if the parent_id value in the database is different to the current
     * value in the model's dirty attributes
     *
     * @return bool
     */
    protected function isParentIdSame()
    {
        /** @var self $oldCategory */
        $oldCategory          = self::where('id', $this->id)->first();
        $dirty                = $this->getDirty();
        $isParentColumnSet    = isset($dirty[$this->getParentColumnName()]);
        $isNewParentSameAsOld = false;

        if ($isParentColumnSet) {
            $isNewParentSameAsOld = ($dirty[$this->getParentColumnName()] === $oldCategory->parent->id);
        }

        return $isParentColumnSet && $isNewParentSameAsOld;
    }

    /**
     * Reset parent ID.
     *
     * Removes the parent_id field from the model's attributes and sets $moveToNewParentId
     * static property on the parent Baum\Node model class to false to prevent Baum from
     * triggering a move. This can be required because Baum triggers a parent move, which
     * puts the item last in the list, even if the old and new parents are the same.
     */
    protected function stopBaumParentMove()
    {
        unset($this->{$this->getParentColumnName()});

        self::$moveToNewParentId = false;
    }
}
