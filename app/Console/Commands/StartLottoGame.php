<?php

namespace App\Console\Commands;

use App\Models\LottoGames;
use App\Models\Settings;
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

        $award = Tickets::getTotalPriceForPast7Days();
        $houseCut = $award * env('HOUSE_CUT');
        $award = $award - $houseCut;

        LottoGames::create([
            'numbers' => implode(',',$lotoNumbers),
            'award_fund' => Tickets::getTotalPriceForPast7Days(),
        ]);


        $settingBank = Settings::where(['key'=>'bank'])->first();
        $settingBank->value += $houseCut;
        $settingBank->save();

        $this->output->info("Numbers that were picked: ".implode(',',$lotoNumbers));
        $this->output->info("The award winning fund was $award and house kept $houseCut");
    }



}
