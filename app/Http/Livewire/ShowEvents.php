<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class ShowEvents extends Component
{
    
    public $message = 'Apenas um teste';
    
    public function render()
    {
        $events = Event::get();
        
        return view('livewire.show-events', [
            'events' => $events
        ]);
    }
}
