<div>
    Show Tweets
{{ $message }}
    <form method="post" wire:submit.prevent="create">
        <input type="text" name="message" id="message" wire:model="message">
        @error('content')
        {{ $message }}
        @enderror
        <br>
        <button type="submit">Cadastrar Tweet</button>
    </form>

    <br>
    <br>
    <hr>
    <br>

    <br><br>
    <hr>
    <hr>
    <div>

    </div>
</div>
