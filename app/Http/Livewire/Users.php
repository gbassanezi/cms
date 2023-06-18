<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $name;
    public $email;
    public $role;

    public $modelId;

    /**
    * Custom public properties here
    */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ];
    }

    public function create()
    {
        $this->validate();
        User::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function read()
    {
        return User::paginate(5);
    }

    public function update()
    {
        $this->validate();
        User::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        User::destroy($this->modelId);
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
        $data = User::find($this->modelId);
        // Assign the variables here
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->role;
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role
        ];
    }

    public function render()
    {
        return view('livewire.users', [
            'data' => $this->read(),
        ]);
    }
}
