<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        // static::addGlobalScope('active', function (Builder $builder) {
        //     $builder->where('status', 1);
        // });
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFootnoteAttribute()
    {
        return $this->type . 'Type, created at ' . date('Y-m-d', strtotime($this->created_at));
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
