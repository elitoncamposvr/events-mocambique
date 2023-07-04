<div class="w-64 fixed h-screen bg-white shadow-sm">
    <div class="py-6 flex justify-center items-center font-semibold text-slate-600">
        [ LOGO ]
    </div>
    <div class="ml-4">
        <a href="{{ route('dashboard') }}">
            <div class="w-full p-3 rounded-l-md flex items-center text-slate-600 hover:bg-slate-200">
                <i class="fa-solid fa-house-user fa-lg w-7"></i>
                Dashboard
            </div>
        </a>
    </div>
    <div class="ml-4">
        <a href="{{ route('events') }}">
            <div class="w-full p-3 rounded-l-md flex items-center text-slate-600 hover:bg-slate-200">
                <i class="fa-solid fa-people-group fa-lg w-8"></i>
                Eventos
            </div>
        </a>
    </div>
    <div class="ml-4">
        <a href="{{ route('tickets') }}">
            <div class="w-full p-3 rounded-l-md flex items-center text-slate-600 hover:bg-slate-200">
                <i class="fa-solid fa-ticket fa-lg w-8"></i>
                Bilhetes
            </div>
        </a>
    </div>
    <div class="ml-4">
        <a href="{{ route('users') }}">
            <div class="w-full p-3 rounded-l-md flex items-center text-slate-600 hover:bg-slate-200">
                <i class="fa-solid fa-users fa-lg w-8"></i>
                Usuários
            </div>
        </a>
    </div>
</div>
