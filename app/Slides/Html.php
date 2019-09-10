<?php
/**
 * Created by PhpStorm.
 * User: thomasoomens
 * Date: 28/03/2018
 * Time: 18:19
 */

namespace App\Slides;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Html extends \App\Slide
{
    protected $table = 'htmls';
    protected $caption = "HTML";
    protected $name = "html";
    protected $description = "Upload your own HTML page with your own styling and javascript.";

    protected $fillable = ['slide_id', 'indexname'];

    /**
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public function validateRequest($request)
    {
        return (parent::validateRequest($request)) && ($request->validate([
            'indexname' => 'required',
            'zipfile' => 'required'
        ]));
    }

    public function postSave($request)
    {
        if ($request->zipfile) {
            $dirname = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . 'public/uploads/html'. $this->slideId;
            $src = $request->file('zipfile')->getRealPath();

            if (file_exists($dirname)) {
                array_map('unlink', glob("$dirname/*.*"));
                rmdir($dirname);
            }

            mkdir($dirname);

            $zip = new ZipArchive();
            $x = $zip->open($src);  // open the zip file to extract
            if ($x === true) {
                $zip->extractTo($dirname); // place in the directory with same name
                $zip->close();
                unlink($src); //Deleting the Zipped file
            }
        }
    }

    public function getPreview(): string
    {
        return "images/html.jpg";
    }
}