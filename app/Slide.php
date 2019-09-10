<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slides';
    protected $caption = "";
    protected $name = "";
    protected $description = "";
    protected $slideId;
    protected $extended = null;


    protected $fillable = [
        'title', 'type', 'from', 'until', 'duration', 'minimal', 'active'
    ];

    /**
     * @return Slide
     */
    public function getExtended()
    {
        if (!$this->extended) {
            $className = "\App\Slides\\". ucfirst($this->type);
            $this->extended = $className::where('slide_id', $this->id)->first();
            if ($this->extended == null) {
                $this->extended = new $className();
            }
            $this->extended->setSlideId($this->id);
        }
        return $this->extended;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        if ($this->type && $this->table == 'slides') {
            return $this->getExtended()->getCaption();
        }
        return $this->caption;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        if ($this->type && $this->table == 'slides') {
            return $this->getExtended()->getName();
        }
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        if ($this->type && $this->table == 'slides') {
            return $this->getExtended()->getDescription();
        }
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        if ($this->type && $this->table == 'slides') {
            return $this->getExtended()->getPreview();
        }
        return "";
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateRequest($request)
    {
        return ($request->validate([
            'title' => 'required|max:191',
            'from' => 'required|date',
            'until' => 'required|date',
            'duration' => 'required|integer',
            'minimal' => 'required|integer',
            'active' => '',
        ]));
    }

    public function parseData($data)
    {
        $data['active'] = (key_exists('active', $data) && $data['active'] == 'on')?1:0;
        $data['type'] = $this->getName();
        $data['from'] = date('Y-m-d H:i:s', strtotime($data['from']));
        $data['until'] = date('Y-m-d H:i:s', strtotime($data['until']));

        return $data;
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public function saveRequest($request)
    {
        if ($this->validateRequest($request)) {
            $data = $this->parseData($request->all());
            $slide = new Slide();
            $slide->fill($data);
            $slide->save();


            $this->slideId = $slide->id;
            $data['slide_id'] = $slide->id;
            $this->fill($data);
            $this->save();
            $this->postSave($request);
            return true;
        }
        $this->errors = $request->errors;
        return false;
    }

    public function postSave($request)
    {}

    public function delete()
    {
        if ($this->table == 'slides') {
            $className = "\\App\\Slides\\" . ucfirst($this->type);
            /** @var Slide $slide */
            $slide = $className::where('slide_id', $this->id)->first();
            $slide->delete();
        }
        parent::delete();
    }

    public function updateRequest($request)
    {
        if ($this->validateRequest($request)) {
            $data = $this->getExtended()->parseData($request->all());
            $this->fill($data);
            $this->save();

            $this->getExtended()->fill($data);
            $this->getExtended()->save();
            $this->getExtended()->postSave($request);
            return true;
        }
        $this->errors = $request->errors;
        return false;
    }

    /**
     * @param mixed $slideId
     * @return Slide
     */
    public function setSlideId($slideId)
    {
        $this->slideId = $slideId;
        return $this;
    }

    public function getHtml()
    {
        return view('slides.'. $this->type, ['slide' => $this]);
    }
}
