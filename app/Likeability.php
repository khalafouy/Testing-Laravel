<?php


namespace App;


trait Likeability
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like($userId)
    {
        $like = new Like(['user_id' => $userId, 'likeable_id' => $this->id, 'likeable_type' => get_class($this)]);
        $like->save();
    }

    public function unLike($userId)
    {
        $this->likes()->where('user_id', '=', $userId)->delete();

    }

    public function isLiked($userId)
    {
        return !!$this->likes()->where('user_id', $userId)->count();
    }

    public function toogle($userId)
    {
        if (!$this->isLiked($userId)) {
            return $this->like($userId);
        }
        return $this->unLike($userId);
    }

    public function getLikeCountAttribute()
    {
        return $this->likes()->count();
    }
}