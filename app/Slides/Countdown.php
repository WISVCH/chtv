<?php
/**
 * Created by PhpStorm.
 * User: thomasoomens
 * Date: 28/03/2018
 * Time: 18:19
 */

namespace App\Slides;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Countdown extends \App\Slide
{
    protected $table = 'countdowns';
    protected $caption = "Countdown";
    protected $name = "countdown";
    protected $description = "Create a countdown with your own background and logo.";

    protected $fillable = ['slide_id', 'header', 'description_left', 'description_right', 'countdown_done', 'deadline', 'background', 'countdown_type'];


    public function parseData($data)
    {
        $data = parent::parseData($data);
        $data['deadline'] = date('Y-m-d H:i:s', strtotime($data['deadline']));

        return $data;
    }

    public function validateRequest($request)
    {
        return (parent::validateRequest($request)) && ($request->validate([
            'header' => 'string',
            'description_left' => 'string',
            'description_right' => 'string',
            'deadline' => 'required|date',
            'countdown_done' => 'string',
            'countdown_type' => 'integer',
            'background' => 'required|image',
        ]));
    }

    public function postSave($request)
    {
        if ($request->background) {
            $name = 'countdown'. $this->slideId .'.'. $request->file('background')->extension();
            $request->background->storeAs('/public/uploads', $name);
            $this->background = $name;
            $this->save();

            ini_set('memory_limit', '256M');
            $image = Image::make($request->file('background')->getRealPath());
            $image->fit(150, 85)->save(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() .'public/uploads/thumbs/'. $name);
        }
    }

    public function getPreview(): string
    {
        return "storage/uploads/thumbs/". $this->background;
    }
}