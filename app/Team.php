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
        } else {
            $this->members()->whereIn('users.id', array_map(function ($item) {
                return $item->id;
            }, $user));
        }
    }

    function add($user)
    {
        if ($user instanceof User) {
            $this->guardAgainstMaxNumber(1);
            return $this->members()->save($user);
        }
        $this->guardAgainstMaxNumber(count($user));
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

    function guardAgainstMaxNumber($numberOfUsers)
    {
        echo 'step 2 <br>';
        $availableNumber = $this->size - $this->count();
        dd($availableNumber);
        //@guard
        /*if ($numberOfUsers > $availableNumber) {
            throw new \Exception;
        }*/
    }
}
