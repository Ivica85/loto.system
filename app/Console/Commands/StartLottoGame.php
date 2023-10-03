<?php

namespace App\Console\Commands;

use App\Models\LottoGames;
use App\Models\Tickets;
use Illuminate\Console\Command;

class StartLottoGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lotoNumbers = [];

        while(count($lotoNumbers) < 7){
            $randomNumber = rand(0,100);

            if(in_array($randomNumber,$lotoNumbers)){
                continue;
            }

            $lotoNumbers[] = $randomNumber;
        }

        LottoGames::create([
            'numbers' => implode(',',$lotoNumbers),
            'award_fund' => Tickets::getForPast7Days(),
        ]);

        $this->output->info('Numbers that were picked: '.implode(',',$lotoNumbers));

    }
}
