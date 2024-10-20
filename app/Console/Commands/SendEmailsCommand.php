<?php

namespace App\Console\Commands;

use App\Mail\MailDeNotification;
use App\Models\Reponse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'send:emails';
    

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Envoie des emails à une date donnée';

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
     * @return int
     */
    public function handle()
    {
         // Sélectionner les réponses à envoyer maintenant ou avant maintenant
         $reponses = Reponse::whereNotNull('envoyer_at')
         ->where('envoyer_at', '<=', now())
         ->get();

        foreach ($reponses as $reponse) {
         Mail::to($reponse->user->email) // ou tout autre champ d'email
             ->send(new MailDeNotification($reponse));

         // Optionnel : marquer la réponse comme envoyée (si tu as un champ pour cela)
        //  $reponse->update(['is_sent' => true]); 
        }
    }
}
