<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Mailer\Email;
use Cake\Console\ConsoleOptionParser;

class BhaktasCommand extends Command
{
	
	Const ONKENTES_TAMOGATO = 2;
	/**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
	public function initialize()
    {
        parent::initialize();
        $this->loadModel('Bhaktas');
    }
	public function getOptionParser()
	{
		$parser = parent::getOptionParser();
		$parser->addArgument('year', [
			'help' => 'Input The Year Here First.',
			'required' => true
		]);
		$this->abc = $parser;
		return $parser;
	}

    public function execute(Arguments $args, ConsoleIo $io)
    {
		$years = $args->getArgument('year');
		//check the INPUT validity
		if(filter_var($years, FILTER_VALIDATE_INT) !== false){
			$bhaktas = $this->Bhaktas->find()
				->select(['Bhaktas.id', 'Bhaktas.nev_szuletesi', 'services.szolgalat_kezdete'])
				->where([
					'Bhaktas.communityrole_id' => BhaktasCommand::ONKENTES_TAMOGATO,
					'services.szolgalat_kezdete <' => new Time($years.'years ago')
				])
				->join([
						'table' => 'services',
						'type' => 'LEFT',
						'conditions' => 'Bhaktas.id = services.bhakta_id'
				])
				->group('Bhaktas.nev_szuletesi')
				->order('services.szolgalat_kezdete');
				
			// Create Email Body and Send in mailFunction
			if(!$bhaktas->isEmpty()){
					$message = '<html><body>';
					$message .= '<h1 style="color:#f40;">Volunter List!</h1>';
					foreach($bhaktas as $ba){
						$message .= '<p style="color:#080;font-size:18px;">'.$ba->nev_szuletesi.'.'.$ba->services['szolgalat_kezdete'].'</p>';
					}
					$message .= '</body></html>';
					// Send Email to Concerned User
					BhaktasCommand::mailFunction($message);	
				}
			else{
					echo "Data Not Found!";
			}
		}
		else{
				echo "Please Input the Integer Number!";
			}
			
    }
	
	protected function mailFunction($message = null){
		
		if(func_num_args() === 1){
			$email = new Email('default');
			$email->from(['rrd@1108.cc' => 'My Site'])
			->to('rrd@1108.cc')
			->subject('About')
			->send($message);
		}
				
	}
	
}