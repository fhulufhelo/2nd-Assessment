<?php

namespace App\Traits;

use App\Activity;
use Illuminate\Support\Facades\Auth;


trait Recordable
{
    public static function boot()
    {
        parent::boot();

        if (!Auth::check()) return;

        foreach (static::getActivitiesToRecord() as $event) {

            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

    }

    protected static function getActivitiesToRecord()
    {
        return ['created', 'updated', 'deleted'];
    }


    protected function recordActivity($event)
    {

        $this->actitvity()->create([
            'user_id' => Auth::id(),
            'type' => $this->getActivityType($event)
        ]);
    }


    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }


    public function actitvity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }
    
}



