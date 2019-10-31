<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

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
