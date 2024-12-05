<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    protected $table = 'job_listings';

    protected $fillable = ['title', 'description', 'salary', 'tags', 'job_type', 'remote', 'requirements', 'benefits', 'address', 'city', 'state', 'zipcode', 'contact_email', 'contact_phone', 'company_name', 'company_description', 'company_logo', 'company_website', 'user_id'];

    use HasFactory;

    //Relation to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    //Relation to Bookmarks
    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user_bookmarks')->withTimestamps();
    }
}
