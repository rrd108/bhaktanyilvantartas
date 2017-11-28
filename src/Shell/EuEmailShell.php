<?php
/**
 * Created by PhpStorm.
 * User: mihaly
 * Date: 2017.11.15.
 * Time: 9:20
 */

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class EuEmailShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Bhaktas');
        $this->loadModel('MyUsers');
    }

    public function main()
    {
        $monthLater = Time::now()->addMonth(1);
        $bhaktas = $this->Bhaktas->find('euCardExpired',['minDate' => Time::now(), 'maxDate' => $monthLater])
            ->select(
                [
                    'Bhaktas.id',
                    'Bhaktas.nev_szuletesi',
                    'Bhaktas.nev_avatott',
                    'Bhaktas.eu_card_expiry'
                ]
            )
            ->all();
        $message = '';
        foreach ($bhaktas as $bhakta) {
            $message .= 'nev_szuletesi: ' . $bhakta->nev_szuletesi
                . ', nev_avatott: ' . $bhakta->nev_avatott
                . ', eu_card_expiry: ' . $bhakta->eu_card_expiry . '\n';
        }
        $superusers = $this->MyUsers->find('superUsers')->select("email")->toArray();
        $email = new Email('default');
        $email->setSubject('bhaktas with experied eu card');
        foreach ($superusers as $superuser){
            $email->addTo($superuser["email"]);
        }
        $email->send($message);
    }
}
