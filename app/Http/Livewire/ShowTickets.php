<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class ShowTickets extends Component
{
    public function render()
    {
        
        return view('livewire.show-tickets');
    }
}
