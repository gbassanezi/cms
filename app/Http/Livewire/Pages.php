<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Validation\Rule;

class Pages extends Component
{
    public $modelId;
    public $title;
    public $slug;
    public $content;
    public $modalFormVisible = false;

    /**
     * Our validation rules when receveing the data from the modal
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required'
        ];
    }

    /**
     * Generate the slug using the title as base
     *
     * @param $value $value [explicite description]
     *
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->generateSlug($value);
    }

    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function read()
    {
        return Page::paginate(10);
    }

    public function updateShowModal($id)
    {
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**
     * Show the modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->modalFormVisible = true;
    }

    /**
     * Get the data from the modal
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }

    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $this->content;
    }

    /**
     * Treating our slug value replacing the spaces
     *
     * @param $value $first $second [explicite description]
     *
     * @return void
     */
    public function generateSlug($value)
    {
        $first = str_replace(' ', '-', $value);
        $second = strtolower($first);
        $this->slug = $second;
    }

    /**
     * Reset the variables in the form
     *
     * @return void
     */
    public function resetVars()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }

    /**
     * Render our pages livewire component
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read()
        ]);
    }
}
