<div class="text-center">

    Wins: {{ $games_won }} |
    Losses: {{ $games_lost }}

    <hr>

    <b>Previous Cards : </b>
    <div class="d-flex justify-content-center">
        @foreach($previous_cards as $prev_card)
            <div class="p-2">
                <img src="{{ asset('/images/' . $prev_card . '.png') }}" style="height: 7em;"/>
            </div>
        @endforeach
    </div>

    <br>

    <h2>Your Card</h2>
    <img src="{{ asset('/images/' . $card . '.png') }}" class="w-50"/>

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
