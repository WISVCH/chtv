<?php
/**
 * Created by PhpStorm.
 * User: thomasoomens
 * Date: 28/03/2018
 * Time: 18:19
 */

namespace App\Slides;

class Video extends \App\Slide
{
    protected $table = 'videos';
    protected $caption = "Video";
    protected $name = "video";
    protected $description = "Upload a video that is displayed over the entire screen.";

    protected $fillable = ['slide_id', 'filename'];

    /**
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public function validateRequest($request)
    {
        return (parent::validateRequest($request)) && ($request->validate([
                'video' => 'required'
            ]));
    }

    public function postSave($request)
    {
        if ($request->video) {
            $name = 'video'. $this->slideId .'.'. $request->file('video')->extension();
            $request->video->storeAs('/public/uploads', $name);
            $this->filename = $name;
            $this->save();
        }
    }

    public function getPreview(): string
    {
        return "images/video.jpg";
    }

}