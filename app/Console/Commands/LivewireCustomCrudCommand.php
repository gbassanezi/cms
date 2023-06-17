<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud {nameOfTheClass? : The name of the class.}, {nameOfTheModelClass? :  The name of the model Class.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a custom livewire Crud';

    /**
     * Our custom properties
     */
    protected $nameOfTheClass;
    protected $nameOfTheModelClass;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creates a custom livewire commando to generate crud');


        //Get all the parameters
        $this->getParamethers();

        //Generate the Livewire Class File
        $this->generateLivewireCrudClassFile();

        //Generate the Livewire View File
    }

    /**
     * Get the parameters for the function
     *
     * @return void
     */
    protected function getParamethers()
    {
        $this->info($this->argument('nameOfTheClass'));
        $this->info($this->argument('nameOfTheModelClass'));

        // If the user dont input in the cli
        if(!$this->nameOfTheClass){
            $this->nameOfTheClass = $this->ask('Enter the class name');
        }

        if(!$this->nameOfTheModelClass){
            $this->nameOfTheModelClass = $this->ask('Enter the model name');
        }

        $this->nameOfTheClass = Str::studly($this->nameOfTheClass);
        $this->nameOfTheModelClass = Str::studly($this->nameOfTheModelClass);


        $this->info($this->nameOfTheClass . ' ' . $this->nameOfTheModelClass);
    }

    /**
     * Generate our livewire class file
     */
    protected function generateLivewireCrudClassFile()
    {

    }
}
