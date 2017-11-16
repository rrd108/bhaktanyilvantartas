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

class EuEmailShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Bhaktas');
    }

    public function main()
    {
        $bhaktas = $this->Bhaktas->findEuCardExperiendInCurrentMonth()->select([
            'Bhaktas.id',
            'Bhaktas.nev_szuletesi',
            'Bhaktas.nev_polgari',
            'Bhaktas.eu_card_expiry'
        ])->all();
        $message = '';
        foreach ($bhaktas as $bhakta) {
            $message .= 'id: ' . $bhakta->id . ' nev_szuletesi: ' . $bhakta->nev_szuletesi . ' nev_polgari ' . $bhakta->nev_polgary . ' eu_card_expiry' . $bhakta->eu_card_expiry . '\n';
        }
        debug($message);
        $email = new Email('default');
        $email->setSubject('bhaktas with experied eu card')
            ->setTo('proba@proba.hu');
        $email->send($message);
    }
}