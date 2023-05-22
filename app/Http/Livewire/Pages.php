<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pages extends Component
{
    public $title;
    public $content;
    public $slug;
    public $modalFormVisible = false;

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
     * Render our pages livewire component
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages');
    }
}
