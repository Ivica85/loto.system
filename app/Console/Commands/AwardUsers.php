<?php

namespace App\Console\Commands;

use App\Models\AwardLog;
use App\Models\LottoGames;
use App\Models\Settings;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Console\Command;

class AwardUsers extends Command
{

    const AWARD_MAP = [
        3 => 0.025,
        4 => 0.075,
        5 => 0.10,
        6 => 0.3,
        7 => 0.5,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:award-users';

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
        $winners = [];
       $tickets = Tickets::getAllTicketsForPast7days();
       $lottoGame = LottoGames::orderByDesc('id')->first();

       $awardedNumbers = $lottoGame->numbers;
       $awardedNumbers = explode(',',$awardedNumbers);

       foreach( $tickets as $ticket){
           $userNumbers = explode(',',$ticket->numbers);
            $intersect = array_intersect($awardedNumbers,$userNumbers);
            //dd($intersect,$awardedNumbers,$userNumbers);

           $numbersGuessed = count($intersect);

            if($numbersGuessed >= 3)
            {
                $winners[$numbersGuessed][] = $ticket->user_id;
            }
       }

      $this->awardUsers($winners, $lottoGame);
    }

    private function awardUsers(array $winners, LottoGames $game): void
    {
        $totalAwarded = 0;

        foreach ($winners as $combinationCount => $users){
            $awardSplit = self::AWARD_MAP[$combinationCount] / count($users);

            foreach($users as $user){
                $userAwardedInCredits = $game->award_fund * $awardSplit;
                $awardedUsers[$combinationCount][$user] = $userAwardedInCredits;
                $totalAwarded += $userAwardedInCredits;

                $dbUser = User::where(['id'=> $user])->first();
                $dbUser->credits += $userAwardedInCredits;
                $dbUser->save();

                AwardLog::create([
                    'user_id' => $user,
                    'game_id' => $game->id,
                    'award' => $userAwardedInCredits,
                ]);

            }

        }

        $game->total_awarded = $totalAwarded;
        $game->save();

        $settingBank = Settings::where(['key'=> 'bank'])->first();
        $settingBank->value += $game->award_fund - $totalAwarded;
        $settingBank->save();

    }


}


