<?php

use Livewire\Component;

new class extends Component
{
    public $message = "Hello world! I am here with livewire 4";
    private $greetingMsg = "I am private MSG";
    public $counter = 0;

    public function increment(){
        $this->counter++;
    }
    public function decrement(){
        $this->counter--;
    }
};
?>

<div>
    <h1>{{ $message }}</h1>
    <h1>Private MSg: {{ $this->greetingMsg }}</h1>
    <h1>Counter: {{ $counter }}</h1>

    <button wire:click="increment">Increment</button>
    <button wire:click="decrement">Decrement</button>
</div>
