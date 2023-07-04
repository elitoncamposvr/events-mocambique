<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    public readonly Event $event;

    public function __construct(){
        $this->event = new Event();
    }

    public function index()
    {
        return view('events', [
            'events' => DB::table('events')->paginate(15)
        ]);
    }

    public function create()
    {
        return view('events_create');
    }

    public function store(Request $request)
    {

        $created = $this->event->create([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'description' => $request->input('description'),
            'status' => 1,
            'user_id' => $request->user()->id
        ]);

        if ($created) {
            return redirect()->route('events')->with('success', 'Evento criado com sucesso!');
        }

        return redirect()->route('events')->with('error', 'Erro ao criar evento!');

    }

    public function show(Event $event)
    {
        return view('events_show', ['event' => $event]);
    }

    public function edit(Event $event)
    {
        return view('events_edit', ['event' => $event]);
    }

    public function update(Request $request, string $id)
    {
        $updated = $this->event->where('id', $id)->update($request->except(['_token', '_method']));

        if ($updated) {
            return redirect()->route('users')->with('success', 'Atualizado com sucesso!');
        }

        return redirect()->route('users')->with('error', 'Erro ao atualizar!');
    }

    public function destroy(string $id)
    {
        $this->event->where('id', $id)->delete();

        return redirect()->route('events')->with('success', 'Deletado com sucesso!');

    }
}
