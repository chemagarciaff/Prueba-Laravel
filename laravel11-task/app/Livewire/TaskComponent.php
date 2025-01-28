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
        $this->tasks = Task::where('user_id', auth()->id)->get();
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
    
    public function createTask()
    {
        $this->clearFields();
        $this->modal = false;
        $task = new Task();
        $task->title = $this->title;
        $task->description = $this->description;
        // $task->user_id = auth()->user()->id;
    }


    //Aqui van todos los metodos necesarios como por ejemplo los eventos asociados a los botones del task component
}
