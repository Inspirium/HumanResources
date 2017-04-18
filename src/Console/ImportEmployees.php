<?php

namespace Inspirium\HumanResources\Console;

use Illuminate\Console\Command;

class ImportEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspirium:import_employees 
    {file : Path of the file to import} 
    {--sheet= : Sheet name to load}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import employees from Excel file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file_path = $this->argument('file');
        $sheet = $this->argument('sheet');
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_path);
        $reader->setReadDataOnly(true);
        if ($sheet) {
            $reader->setLoadSheetsOnly($sheet);
        }
        $spreadsheet = $reader->load($file_path);
        //iterate over first row to find all columns

        //iterate over other rows to copy data

    }
}
