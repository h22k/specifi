<?php

namespace App\Models;

use App\Filters\BaseFilter;
use App\Filters\Contracts\IFilterable;
use App\Filters\Helper\Filterable;
use App\Filters\TaskFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model implements IFilterable
{
    use HasFactory, Filterable;

    protected $with = [
        'category',
        'assigned',
        'createdBy',
    ];

    protected $fillable = [
        'created_by',
        'assigned_to',
        'title',
        'description',
        'progress',
        'category_id',
    ];

    /**
     * @return BaseFilter
     */
    public function getFilterClass(): BaseFilter
    {
        return new TaskFilter;
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TaskCategory::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
