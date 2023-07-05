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
        $messages = [
            'image' => 'O arquivo deve ser do tipo imagem.',
            'max' => 'O arquivo ultrapassou o tamanho máximo de 2MB'
        ];

        $request->validate([
            'event_image' => [
                'nullable',
                'image',
                'max:2048'
            ]
        ], $messages);

        if($request->event_image){
            $extension = $request->event_image->getClientOriginalExtension();
            $img= $request->event_image->storeAs('events', uniqid() . NOW() . ".{$extension}");
        }

        $created = $this->event->create([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'description' => $request->input('description'),
            'status' => 1,
            'user_id' => $request->user()->id,
            'event_image' => $img
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
        $messages = [
            'image' => 'O arquivo deve ser do tipo imagem.',
            'max' => 'O arquivo ultrapassou o tamanho máximo de 2MB'
        ];

        $request->validate([
            'event_image' => [
                'nullable',
                'image',
                'max:2048'
            ]
        ], $messages);

        if($request->event_image){
            $extension = $request->event_image->getClientOriginalExtension();
            $img = $request->event_image->storeAs('events', uniqid() . NOW() . ".{$extension}");
        }

        $updated = $this->event->where('id', $id)->update([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'description' => $request->input('description'),
            'event_image' => $img
        ]);

        if ($updated) {
            return redirect()->route('events')->with('success', 'Atualizado com sucesso!');
        }

        return redirect()->route('events')->with('error', 'Erro ao atualizar!');
    }

    public function destroy(string $id)
    {
        $this->event->where('id', $id)->delete();

        return redirect()->route('events')->with('success', 'Deletado com sucesso!');

    }
}
