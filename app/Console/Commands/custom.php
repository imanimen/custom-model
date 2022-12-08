<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class custom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:model {first-model} {second-model} {relation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $firstModel  = $this->argument('first-model');
        $secondModel = $this->argument('second-model');
        $relation    = $this->argument('relation');
        $check1 = base_path() . '../../../app/Models/' . $firstModel;
        $check2 = base_path() . '../../../app/Models/' . $secondModel;
        if (file_exists($check1))
        {
            $this->error('Model ' . $firstModel . ' exists!');
            return 0;
        }
        if (file_exists($check2))
        {
            $this->error('Model ' . $secondModel . ' exists!');
            return 0;
        }

        $stubPath = base_path() . '/' . '/stubs/default.stub';
        $this->info($stubPath);
        $stub     = file_get_contents($stubPath);

        $stub     = str_replace('{{class_name}}', $firstModel, $stub);
        $stub     = str_replace('{{second_model}}', strtolower($secondModel).'s', $stub);
        if ($relation == '11')
        {
            $relation = 'BelongsTo';
        }
        $stub     = str_replace('{{relation}}', $relation, $stub);
        $stub     = str_replace('{{sec_model}}', $secondModel, $stub);
        $writePath1= base_path()  . '/' . 'app/Models/' . $firstModel  .'.php';
        $writePath2= base_path()  . '/' .  'app/Models/' . $secondModel .'.php';
        // write the first model
        file_put_contents($writePath1, $stub);
        // wirite the second model
        file_put_contents($writePath2, $stub);

        //TODO: Implement Migrations

    }
}
