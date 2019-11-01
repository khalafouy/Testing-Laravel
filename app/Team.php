<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];


    function remove($user)
    {
        if ($user instanceof User) {
            $this->members()->where('users.id', '=', $user->id)->delete();
        }
        else
        {
            $this->members()->whereIn('users.id',array_map(function($item){
                return $item->id;
            },$user));
        }
    }

    function add($user)
    {
        $this->guardAgainstMaxNumber();
        if ($user instanceof User)
            return $this->members()->save($user);
        return $this->members()->saveMany($user);

        // $method=$user instanceof User)?'save':'saveMany';
        // $this->members()->$method($user);


    }


    function members()
    {
        return $this->hasMany(User::class);
    }

    function count()
    {
        return $this->members()->count();
    }

    function guardAgainstMaxNumber()
    {
        //@guard
        if ($this->count() >= $this->size) {
            throw new \Exception;
        }
    }
}
