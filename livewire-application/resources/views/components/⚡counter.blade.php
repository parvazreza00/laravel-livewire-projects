<?php

use Livewire\Component;

new class extends Component
{
    public $counter;
    public $message;
    public $userName;

    public function mount($message)
    {
    echo "mount method called : ";
    echo "Upate the counter value : ". $this->counter;
    $this->counter = 2;
    $this->message = $message;
    }

    public function hydrate(){
    dump("hydrate method called");
    }

    public function Increment(){
        $this->counter++;

        if($this->counter == 5){
            $this->counter = 0;
        }
    }
    
    public function boot(){
        dump("boot method" , $this->counter);
        $this->counter = 12;
    }

    public function updated($userName){
        dump("Updated:".$userName);
    }

    public function updating($userName, $value){
        dump($userName , $value);
    }

    public function rendered(){
        dump("rendered view");
    }

    public function rendering(){
        dump("rendering view");
    }

    public function dehydrate(){
        dump($this->counter);
    }



};
?>

<div>
    <h1>Hi I am counter component </h1>
    current counter value is : {{ $counter }}
    provided message is : {{ $message }} <br>

    <button wire:click="Increment" type="button">Increment</button>

    <br>
    <input type="text" wire:model="userName" name="userName">



</div>
