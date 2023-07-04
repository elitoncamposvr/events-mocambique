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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session()->has('success'))
                        <div class="msg-success mb-2">
                        {{ session()->get('success') }}
                        </div>
                    @endif
                        @if(session()->has('error'))
                            <div class="msg-error mb-2">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    <div class="w-full flex justify-end">
                        <a class="btn-link" href="{{ route('events.create') }}">Criar novo evento</a>
                    </div>
                    <div class="w-full flex text-sm font-semibold py-2">
                        <div class="w-3/6">Nome do evento</div>
                        <div class="w-1/6 text-center">Data</div>
                        <div class="w-1/6 text-center">Status</div>
                    </div>
                    @foreach($events as $event)
                        <div class="w-full flex bg-slate-100 rounded-md px-1.5 py-2 mb-1.5">
                            <div class="w-3/6">
                                {{ $event->event_name }}
                            </div>
                            <div class="w-1/6 text-center">
                                {{ date('d/m/Y', strtotime($event->event_date)) }}
                            </div>
                            <div class="w-1/6 text-center">
                                {{ $event->status }}
                            </div>
                            <div class="w-1/6 text-center">
                                <a href="{{ route('events.edit', ['event' => $event->id]) }}">
                                    <i class="fa-solid fa-pen-to-square px-1.5"></i>
                                </a>
                                <a href="{{ route('events.show', ['event' => $event->id]) }}">
                                    <i class="fa-solid fa-eye px-1.5"></i>
                                </a>

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
    </div>
</x-app-layout>
