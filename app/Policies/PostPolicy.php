<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
 
    public function viewAny(User $user)
    {
        return $user->roles()->whereIn('name', ['admin', 'editor'])->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        //
    }


    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Post $post)
    {
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            return true;
        }
        return $user->id === $post->author_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->roles()->where('name', 'admin')->exists() || 
               $user->roles()->where('name', 'editor')->exists() || 
               $user->id === $post->author_id;
    }

    public function restore(User $user, Post $post): bool
    {
        //
    }


    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
