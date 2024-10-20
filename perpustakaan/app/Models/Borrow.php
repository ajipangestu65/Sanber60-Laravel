<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Borrow
 *
 * @property int         $id
 * @property Carbon      $borrowed_at
 * @property Carbon      $returned_date
 * @property null|Carbon $returned_at
 * @property int         $user_id
 * @property int         $book_id
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @property-read Book   $book
 * @property-read User   $user
 *
 * @method static Builder|Borrow query()
 */
class Borrow extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = 'borrows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'borrowed_at',
        'returned_date',
        'returned_at',
        'user_id',
        'book_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'borrowed_at'   => 'datetime',
            'returned_date' => 'datetime',
            'returned_at'   => 'datetime',
            'user_id'       => 'int',
            'book_id'       => 'int',
            'created_at'    => 'datetime',
            'updated_at'    => 'datetime',
        ];
    }

    /**
     * @return BelongsTo|Book
     */
    public function book(): BelongsTo|Book
    {
        return $this->belongsTo('App\Models\Book', 'book_id', 'id');
    }

    /**
     * @return BelongsTo|User
     */
    public function user(): BelongsTo|User
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
