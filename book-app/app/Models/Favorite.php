<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // Define which columns are mass assignable
    protected $fillable = ['user_id', 'book_id', 'book_title', 'favorited_at', 'author'];
 
    // Indicate that the model uses a custom timestamp column
    public $timestamps = true;  // Still need to use timestamps for 'favorited_at'

    // Specify the custom created_at column
    const CREATED_AT = 'favorited_at';
    
    // Optionally, specify a custom updated_at column if needed (if using it)
    const UPDATED_AT = 'favorited_at'; // If you want to use the same column for both

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

