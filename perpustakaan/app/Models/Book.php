<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Book
 *
 * @property int                      $id
 * @property string                   $title
 * @property null|string              $summary
 * @property int                      $published_year
 * @property null|int                 $category_id
 * @property null|Carbon              $created_at
 * @property null|Carbon              $updated_at
 *
 * @property-read Category            $category
 * @property-read Collection|Borrow[] $borrows
 *
 * @method static Builder|Book query()
 */
class Book extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'summary',
        'published_year',
        'category_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title'          => 'string',
            'summary'        => 'string',
            'published_year' => 'int',
            'category_id'    => 'int',
            'created_at'     => 'datetime',
            'updated_at'     => 'datetime',
        ];
    }

    /**
     * @return HasMany|Borrow
     */
    public function borrows(): HasMany|Borrow
    {
        return $this->hasMany('App\Models\Borrow', 'book_id', 'id');
    }

    /**
     * @return BelongsTo|Category
     */
    public function category(): BelongsTo|Category
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
