<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Car extends Model
{
    use AlgoliaEloquentTrait;

    protected $fillable = [
        'brand',
        'model',
        'seats',
        'doors',
        'price_per_day'
    ];

    public function photos()
    {
        return $this->hasMany('App\Models\CarPhoto');
    }

    public function rents()
    {
        return $this->hasMany('App\Models\Rent');
    }

    public function carTrackings()
    {
        return $this->hasMany('App\Models\CarTracking');
    }

    public function coverPhoto()
    {
        return $this->photos()->where('is_cover', true)->first();
    }

    public function getAlgoliaRecord()
    {
        return array_merge($this->toArray(), [
            'cover_photo' => $this->coverPhoto()
        ]);
    }

    public function nonCoverPhotos()
    {
        return $this->photos()->where('is_cover', false)->get();
    }

    public function processImageUpload($request, $isCover = false)
    {
        $uploadedImg = $request->file('photo');

        if($uploadedImg) {
            $carPhoto = new CarPhoto();
            $carPhoto->is_cover = $isCover;
            $carPhoto->name = time() . $uploadedImg->getClientOriginalName();

            $uploadedImg->move(__DIR__ . '/../../public/car_images/', $carPhoto->name);

            $this->photos()->save($carPhoto);
        }
    }
}
