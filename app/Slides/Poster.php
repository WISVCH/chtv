<?php
/**
 * Created by PhpStorm.
 * User: thomasoomens
 * Date: 28/03/2018
 * Time: 18:19
 */

namespace App\Slides;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Poster extends \App\Slide
{
    protected $table = 'posters';
    protected $caption = "Poster";
    protected $name = "poster";
    protected $description = "Upload a basic poster.";

    protected $fillable = ['slide_id', 'filename'];

    /**
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public function validateRequest($request)
    {
        return (parent::validateRequest($request)) && ($request->validate([
            'poster' => 'required|image'
        ]));
    }

    public function postSave($request)
    {
        if ($request->poster) {
            $name = 'poster'. $this->slideId .'.'. $request->file('poster')->extension();
            $request->poster->storeAs('/public/uploads', $name);
            $this->filename = $name;
            $this->save();

            ini_set('memory_limit', '256M');
            $image = Image::make($request->file('poster')->getRealPath());
            $image->fit(150, 85)->save(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() .'public/uploads/thumbs/'. $name);
        }
    }

    public function getPreview(): string
    {
        return "storage/uploads/thumbs/". $this->filename;
    }

}