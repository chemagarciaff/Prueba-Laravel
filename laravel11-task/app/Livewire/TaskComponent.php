<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $title;
    public $description;
    public $modal = false;

    public function mount()
    {
        $this->tasks = Task::where('user_id', auth()->user()->id)->get();
    }
    
    public function render()
    {
        return view('livewire.task-component');
    }
    
    private function clearFields()
    {
        $this->title = '';
        $this->description = '';
    }
    
    public function openCreateModal()
    {
        $this->clearFields();
        $this->modal = true;
    }
    
    public function closeCreateModal()
    {
        $this->clearFields();
        $this->modal = false;
    }

    public function createTask ()  {
        $newtask = new Task();
        $newtask->title = $this->title;
        $newtask->description = $this->description;
        $newtask->user_id = auth()->user()->id;
        $newtask->save();
        $this->clearFields();
        $this->modal = false;
    }
    


    //Aqui van todos los metodos necesarios como por ejemplo los eventos asociados a los botones del task component
}
