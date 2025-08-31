<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Acte;
use Illuminate\Support\Str;

class AddTokensToExistingCopies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copies:add-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ajouter des tokens aux copies d\'actes existantes qui n\'en ont pas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Recherche des copies d\'actes sans token...');
        
        $copiesWithoutToken = Acte::where('type', 'copie')
            ->whereNull('token')
            ->get();
        
        $this->info('Trouvé ' . $copiesWithoutToken->count() . ' copies sans token.');
        
        if ($copiesWithoutToken->count() > 0) {
            $bar = $this->output->createProgressBar($copiesWithoutToken->count());
            $bar->start();
            
            foreach ($copiesWithoutToken as $copie) {
                $copie->token = Str::random(32);
                $copie->save();
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();
            $this->info('Tokens ajoutés avec succès !');
        } else {
            $this->info('Toutes les copies ont déjà un token.');
        }
        
        return 0;
    }
}
