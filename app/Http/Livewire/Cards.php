<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cards extends Component
{
    public $card;
    public $card_deck = array();
    public $previous_cards = array();
    public $guesses = 0;

    public $previous_guess;

    public $games_won = 0;
    public $games_lost = 0;

    public $win = false;
    public $lost = false;

    private $card_values = array(
        'A' => '14',
        'K' => '13',
        'Q' => '12',
        'J' => '11',
    );

    /**
     * @brief Call the setup function and generate the card deck
     * @return void
     */
    public function mount()
    {
        $this->setup();
    }

    /**
     * @brief setup the game | this is not a part of the mount function so it can be called when the game is lost/won and retain the wins/losses.
     * @return void
     */
    public function setup()
    {
        $this->guesses = 0;
        $this->card_deck = array();
        $this->previous_cards = array();
        $this->win = false;
        $this->lost = false;

        // We are excluding Jokers as they will not worth higher or lower
        // Ace can be high or low
        $cards = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        // Card suites weren't in the spec but a nice touch for the UI
        // Will complicate things a bit when getting the card value
        $card_suits = array(
            'hearts', 'diamonds', 'spades', 'clubs'
        );

        // Randomise the suits order
        shuffle($card_suits);

        foreach ($card_suits as $suit) {
            // Ensure the order is different to the other suits
            shuffle($cards);

            foreach ($cards as $card) {
                array_push($this->card_deck, $suit . '_' . $card);
            }
        }

        // Shuffle final time for good measure
        shuffle($this->card_deck);
    }

    /**
     * @brief Remove the suit and get the card value
     * @param $card
     * @return int
     */
    private function getCardValue($card)
    {
        $card_components = explode('_', $card);
        $card_value = end($card_components);

        if (isset($this->card_values[$card_value]))
            return (int)$this->card_values[$card_value];

        return (int)$card_value;
    }

    /**
     * @brief Determine whether the player guessed correctly
     * @param $dir
     * @return void
     */
    public function play($dir)
    {
        $this->guesses++;
        $this->previous_guess = $dir == '>' ? 'higher' : 'lower';

        $this_card = $this->getCardValue($this->card);
        $next_card = $this->getCardValue($this->card_deck[0]);

        $win = match ($dir) {
            '<' => ($next_card < $this_card),
            '>' => ($next_card > $this_card)
        };

        // Player lost
        if (!$win) {

            $this->lost = true;
            $this->games_lost++;

        } elseif ($win && $this->guesses == '5') {
            // Player won
            $this->win = true;
            $this->games_won++;
        }


        $this->previous_cards[] = $this->card;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->card = $this->card_deck[0];

        // Remove the card from the deck / ensure card doesn't come up again
        array_splice($this->card_deck, 0, 1);

        return view('livewire.cards');
    }
}
