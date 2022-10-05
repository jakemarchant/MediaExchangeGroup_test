<div class="text-center">

    Wins: {{ $games_won }} |
    Losses: {{ $games_lost }}

    <hr>

    <b>Previous Cards : </b>
    <div class="d-flex justify-content-center">
        @foreach($previous_cards as $prev_card)
            <div class="card m-1">
                <div class="card-body">
                    {{ $prev_card }}
                </div>
            </div>
        @endforeach
    </div>

    <br>

    <h2>Your Card</h2>
    <div class="card">
        <div class="card-body">
            <h1>{{ $card }}</h1>
        </div>
    </div>

    @if($previous_guess)
        <br>
        Previous guess:
        {{ ucwords($previous_guess) }}
    @endif

    <hr>

    @if($lost)
        <p>You have lost the game.</p>
        <button wire:click="setup" class="btn btn-primary">Retry</button>
    @elseif($win)
        <p>Congrats! You have won the game.</p>
        <button wire:click="setup" class="btn btn-primary">Play again</button>
    @else
        <p>Will the next card be...</p>

        <button wire:click="play('<')" class="btn btn-primary">Lower</button>
        <button wire:click="play('>')" class="btn btn-secondary">Higher</button>
    @endif
</div>
