<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Cards;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CardsTest extends TestCase
{
    /**
     * @breif very basic testing module to verify the component renders
     * @return void
     */
    public function the_component_can_render()
    {
        $component = Livewire::test(Cards::class);

        $component->assertStatus(200);
    }
}
