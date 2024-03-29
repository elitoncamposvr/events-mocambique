<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }} <i class="fa-solid fa-chevron-right fa-xs"></i> {{ __('Criar novo evento') }}
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
                    @if($errors->any())
                        <div class="msg-error mb-2">
                            @foreach($errors->all() as $error)      {{ $error }} @endforeach
                        </div>
                    @endif
                    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full py-2">
                            <label class="label-input" for="event_name">Nome do Evento</label>
                            <input class="w-full input" type="text" name="event_name" id="event_name" placeholder="Nome do Evento">
                        </div>
                        <div class="w-full py-2">
                            <label class="label-input" for="event_date">Data do Evento</label>
                            <input class="w-full input" type="date" name="event_date" id="event_date">
                        </div>
                        <div class="w-full py-2">
                            <label class="label-input" for="event_image">Imagem de Divulgação do Evento</label>
                            <input class="w-full input" type="file" name="event_image" id="event_image">
                        </div>
                        <div class="w-full py-2">
                            <label class="label-input" for="description">Descrição do Evento</label>
                            <textarea class="w-full input resize-none" name="description" id="description" rows="5"></textarea>
                        </div>
                        <div class="w-full py-2 text-center">
                            <button class="btn-link" type="submit">Criar Evento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
