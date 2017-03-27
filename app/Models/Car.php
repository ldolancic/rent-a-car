<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'seats',
        'doors',
        'transmission',
        'type',
        'fuel',
        'price_per_day',
        'additional_details'
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

    public function nonCoverPhotos()
    {
        return $this->photos()->where('is_cover', false)->get();
    }

    public function photoUpload($request, $fieldName = 'additional_photo')
    {
        $uploadedImg = $request->file($fieldName);

        if($uploadedImg) {
            $carPhoto = new CarPhoto();

            $carPhoto->is_cover = $fieldName == 'cover_photo' ? true : false;
            $carPhoto->name = time() . $uploadedImg->getClientOriginalName();

            // if we are uploading a cover photo, delete the old cover photo
            if ($carPhoto->is_cover) {
                foreach ($this->photos as $photo) {
                    if ($photo->is_cover == true) {
                        $photo->delete();
                    }
                }
            }

            $uploadedImg->move(__DIR__ . '/../../public/car_images/', $carPhoto->name);

            $this->photos()->save($carPhoto);

            return $carPhoto;
        }
    }
}
