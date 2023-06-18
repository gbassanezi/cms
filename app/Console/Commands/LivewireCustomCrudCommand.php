<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

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
    protected $file;

    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creates a custom livewire command to generate crud' . "\n \n");


        //Get all the parameters
        $this->info('Getting the parameters...');
        $this->getParamethers();

        //Generate the Livewire Class File
        $this->info('Generating the Livewire Crud Class File...' . "\n \n");
        $this->generateLivewireCrudClassFile();

        //Generate the Livewire View File
        $this->info('Generating the View File...' . "\n");
        $this->generateLivewireCrudViewFile();
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
    }

    /**
     * Generate our livewire class file
     */
    protected function generateLivewireCrudClassFile()
    {
        //Set the origin and destination for the livewire class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/Livewire/' . $this->nameOfTheClass . '.php');

        if($this->file->exists($fileDestination)){
            $this->info('This class file alredy exists: ' . $this->nameOfTheClass . '.php');
            $this->info('!!! Aborting class file creation !!!' . "\n \n");
            return false;
        }

        $fileOriginalString = $this->file->get($fileOrigin);

        // $this->info($fileOriginalString); // write the content of the file on the cli

        $replaceFileOriginalString = Str::replaceArray('{{}}',
            [
                $this->nameOfTheModelClass,
                $this->nameOfTheClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                $this->nameOfTheModelClass,
                Str::kebab($this->nameOfTheClass),
            ],
            $fileOriginalString
        );


        $this->file->put($fileDestination, $replaceFileOriginalString);
        $this->info('Make your wishes come true *-*.'
        . "\n \n" .
        'As you wanted the livewire class file ' . $fileDestination . ' was created.');
    }

    protected function generateLivewireCrudViewFile()
    {
        //Set the origin and destination for the livewire class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/' . Str::kebab($this->nameOfTheClass) . '.blade.php');

        if($this->file->exists($fileDestination)){
            $this->info('This view file alredy exists: ' . Str::kebab($this->nameOfTheClass) . '.php');
            $this->info('!!! Aborting view creation !!!' ."\n \n");
            return false;
        }

        $this->file->copy($fileOrigin, $fileDestination);
        $this->info('As you wish O.O' . "\n \n" . 'Laravel view file created:' . $fileDestination);
    }
}
