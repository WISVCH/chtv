<?php

namespace App\Http\Controllers;

use App\Slide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::whereDate('until', '>', Carbon::today()->toDateTimeString())->get();

        return view('slides.index', compact('slides') );
    }

    public function slideShow()
    {
        $slides = Slide::whereDate('from', '<', Carbon::now()->toDateTimeString())->whereDate('until', '>', Carbon::now()->toDateTimeString())->where('active', 1)->get();

        if($slides->isEmpty()) {
            return view('slides.noslides');
        }

        $slideList = [];
        $slideTimes = [];
        $slideMin = [];
        $order = [];
        $totalTime = 0;
        foreach ($slides as $slide) {
            $slideList[$slide->id] = $slide;
            $order[] = $slide->id;
            $totalTime += $slide->duration;
            $slideTimes[$slide->id] = $slide->duration;
            $slideMin[$slide->id] = $slide->minimal - $slide->duration;
        }
        shuffle($order);

        while ($totalTime < 3600) {
            $slide = array_values($slideList)[0];
            $maxPriority = 0;
            $lowestTotal = 99999999;
            foreach ($slideList as $s) {
                $priority = $slideMin[$s->id]/$s->duration - 3600 / $totalTime;
                if ($priority > $maxPriority) {
                    $slide = $s;
                    $maxPriority = $priority;
                } elseif ($maxPriority == 0 && $slideTimes[$s->id] < $lowestTotal) {
                    $lowestTotal = $slideTimes[$s->id];
                    $slide = $s;
                }
            }
            $order[] = $slide->id;
            $slideTimes[$slide->id] += $slide->duration;
            $totalTime += $slide->duration;
            $slideMin[$slide->id] -= $slide->duration;
        }

        return view('slideshow', ['slides' => $slideList, 'order' => $order] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $typeName
     * @return \Illuminate\Http\Response
     */
    public function create($typeName = null)
    {
        if ($typeName) {
            $className = "\\App\\Slides\\" . ucfirst($typeName);
            /** @var Slide $slide */
            $slide = new $className();
            $slide->type = $typeName;

            return view('types.'. $typeName, compact('slide'));
        } else {
            $types = [];
            $files = scandir(__DIR__ .'/../../Slides');
            foreach($files as $file) {
                if ($file != '.' && $file != '..') {
                    $className = "\\App\\Slides\\" . str_replace('.php', '', $file);
                    $types[] = new $className();
                }
            }
            return view('slides.create', compact('types'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($typeName, Request $request)
    {
        $className = "\\App\\Slides\\" . ucfirst($typeName);
        /** @var Slide $slide */
        $slide = new $className();

        if ($slide->saveRequest($request)) {
            return redirect()->route('overview');
        } else {
            return view('types.'. $typeName, compact('slide'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('types.'. $slide->type, compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        if ($slide->updateRequest($request)) {
            return redirect()->route('overview');
        } else {
            return view('types.'. $slide->type, compact('slide'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return response()->json([ 'success' => true ]);
    }

    public function activate(Slide $slide)
    {
        $slide->active = Input::get('active');
        $slide->save();
        return response()->json([ 'success' => true ]);
    }
}
