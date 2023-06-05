<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FrontPage extends Component
{
    public $title;
    public $content;

    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
    }

    public function retrieveContent($urlslug)
    {
        if(empty($urlslug)){
            $data = Page::where('is_default_home', true)->first();
        } else {

            $data = Page::where('slug', $urlslug)->first();

            if(!$data){
                $data = Page::where('is_default_not_found', true)->first();
            }
        }

        $this->title = $data->title;
        $this->content = $data->content;
    }

    public function sideBarLinks()
    {
        return DB::table('navigation_menus')
        ->where('type', '=', 'SidebarNav')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')->get();
    }

    public function topNavLinks()
    {
        return DB::table('navigation_menus')
        ->where('type', '=', 'TopNav')
        ->orderBy('sequence', 'asc')
        ->orderBy('created_at', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.front-page', [
            'topNavLinks' => $this->topNavLinks(),
            'sideBarLinks' => $this->sideBarLinks(),
        ])->layout('layouts.frontpage');
    }
}
