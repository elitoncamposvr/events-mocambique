<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
        </div>
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Sair') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </x-slot>

    <div class="py-4">
        <div class="ml-64 mx-auto sm:px-4 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                @foreach($events as $event)
                    <div class="w-full flex mb-4 bg-slate-200 rounded-md p-2">
                        <div class="w-2/5">
                            @if($event->event_image)
                                <img src="{{ url("storage/{$event->event_image}") }}" alt="Imagem do evento {{ $event->event_name }}" class="object-cover w-72 rounded-md">
                            @else
                                <img src="{{ url("storage/events/img-default.jpg") }}" alt="Imagem do evento {{ $event->event_name }}" class="object-cover w-72 rounded-md">
                            @endif
                        </div>
                        <div class="w-3/5">
                            <div class="w-full flex py-1.5">
                                <div class="w-2/6 font-semibold">Nome do Evento</div>
                                <div class="w-4/6">{{ $event->event_name }}</div>
                            </div>
                            <div class="w-full flex py-1.5">
                                <div class="w-2/6 font-semibold">Data do Evento</div>
                                <div class="w-4/6">{{ date('d/m/Y', strtotime($event->event_date)) }}</div>
                            </div>
                            <div class="w-full flex py-1.5 mb-5">
                                <div class="w-2/6 font-semibold">Descrição do Evento</div>
                                <div class="w-4/6">{{ $event->description }}</div>
                            </div>
                            <div class="w-full">
                                <a class="btn-link hover:btn-link--hover" href="{{ route('tickets', ['event' => $event->id]) }}">
                                    Ver Bilhetes
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="w-full flex justify-center pt-2">
                    <a class="mr-2 btn-link" href="{{ $events->previousPageUrl() }}">Anterior</a>
                    <a class="ml-2 btn-link" href="{{ $events->nextPageUrl() }}">Proxima</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
