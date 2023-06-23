<?php

namespace App\Http\Livewire;

use App\Models\UserPermissions;
use Livewire\Component;
use Livewire\WithPagination;

class UserPermission extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;

    public $modelId;

    /**
    * Custom public properties here
    */
    public $role;
    public $routeName;

    /**
     * Our validation rules
     */
    public function rules()
    {
        return [
            'role' => 'required',
            'routeName' => 'required'
        ];
    }

    public function create()
    {
        $this->validate();
        UserPermissions::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function read()
    {
        return UserPermissions::paginate(10);
    }

    public function update()
    {
        $this->validate();
        UserPermissions::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        UserPermissions::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function loadModel()
    {
        $data = UserPermissions::find($this->modelId);
        // Assign the variables here
        $this->role = $data->role;
        $this->routeName = $data->route_name;
    }

    public function modelData()
    {
        return [
            'role' => $this->role,
            'route_name' => $this->routeName
        ];
    }

    public function render()
    {
        return view('livewire.user-permission', [
            'data' => $this->read(),
        ]);
    }
}
