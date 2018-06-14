<?php
namespace App\Test\Fixture;

use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * BhaktasFixture
 *
 */
class BhaktasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'neme' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'nev_szuletesi' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nev_polgari' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nev_avatott' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'guru_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cim_allando' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cim_ideiglenes' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cim_szallas' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'szig' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'utlevel' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'adoazonosito' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'taj' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'szul_hely' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'szul_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'szul_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'allampolgarsag' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'katonasag' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'haziorvos_nev' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'haziorvos_cim' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'haziorvos_telefon' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'datum_elsotalalkozas' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'datum_elfogadas' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'datum_elsoavatas' => ['type' => 'string', 'length' => 30, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'datum_masodikavatas' => ['type' => 'string', 'length' => 30, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'asram_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'hazastars_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tb_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'eu_card_expiry' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'legalstatus_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'communityrole_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'vegzettseg' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'szakma' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'vegakarat' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'halalertesitendo' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bhsastri_datum' => ['type' => 'string', 'length' => 30, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bhsastri_eredmeny' => ['type' => 'string', 'length' => 30, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nyelv' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'csalad_nev_anya' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'csalad_nev_apa' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'csalad_hozzaallas' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'india' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'rs_szerz' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'bizalmas_info' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null],
        'megjegyzes' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null],
        'kep' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_bhaktas_asrams' => ['type' => 'index', 'columns' => ['asram_id'], 'length' => []],
            'fk_bhaktas_gurus' => ['type' => 'index', 'columns' => ['guru_id'], 'length' => []],
            'fk_bhaktas_tbs' => ['type' => 'index', 'columns' => ['tb_id'], 'length' => []],
            'fk_bhaktas_legalstatuses' => ['type' => 'index', 'columns' => ['legalstatus_id'], 'length' => []],
            'fk_bhaktas_communityroles' => ['type' => 'index', 'columns' => ['communityrole_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_bhaktas_asrams' => ['type' => 'foreign', 'columns' => ['asram_id'], 'references' => ['asrams', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_bhaktas_communityroles' => ['type' => 'foreign', 'columns' => ['communityrole_id'], 'references' => ['communityroles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_bhaktas_gurus' => ['type' => 'foreign', 'columns' => ['guru_id'], 'references' => ['gurus', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_bhaktas_legalstatuses' => ['type' => 'foreign', 'columns' => ['legalstatus_id'], 'references' => ['legalstatuses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_bhaktas_tbs' => ['type' => 'foreign', 'columns' => ['tb_id'], 'references' => ['tbs', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    public function init()
    {
        parent::init();
        $this->records = [
            [
                'id' => 1,
                'neme' => 1,
                'nev_szuletesi' => 'Fekete Péter',
                'nev_polgari' => 'Fekete Péter',
                'nev_avatott' => 'Krisna Dasa',
                'guru_id' => 1,
                'cim_allando' => '8699 Somogyvámos Gauranga tér 1',
                'cim_ideiglenes' => '',
                'cim_szallas' => '',
                'szig' => '123456AB',
                'utlevel' => 'AB987654',
                'adoazonosito' => '80123456789',
                'taj' => '012345678',
                'szul_hely' => 'Kecskemét',
                'szul_date' => '1977-11-26',
                'szul_time' => '18:08:55',
                'allampolgarsag' => 'magyar',
                'katonasag' => 0,
                'haziorvos_nev' => 'Dr Bubu Bubo',
                'haziorvos_cim' => '',
                'haziorvos_telefon' => '',
                'datum_elsotalalkozas' => 1999,
                'datum_elfogadas' => 2000,
                'datum_elsoavatas' => '2001-01-12',
                'datum_masodikavatas' => '',
                'asram_id' => 1,
                'hazastars_id' => 2,
                'tb_id' => 1,
                'eu_card_expiry' => (new Date())->modify('+3 months'),
                'legalstatus_id' => 1,
                'communityrole_id' => 1,
                'vegzettseg' => '',
                'szakma' => '',
                'vegakarat' => '',
                'halalertesitendo' => '',
                'bhsastri_datum' => '',
                'bhsastri_eredmeny' => '',
                'nyelv' => 'angol',
                'csalad_nev_anya' => '',
                'csalad_nev_apa' => '',
                'csalad_hozzaallas' => '',
                'india' => '2010, 2015',
                'rs_szerz' => '',
                'active' => 1,
                'bizalmas_info' => '',
                'megjegyzes' => '',
                'kep' => ''
            ],
            [
                'id' => 2,
                'neme' => 0,
                'nev_szuletesi' => 'Fehér Erzsébet',
                'nev_polgari' => 'Fekete Péterné',
                'nev_avatott' => 'Radha Devi Dasi',
                'eu_card_expiry' => (new Date())->modify('-3 months'),
                'active' => 1,

            ],
        ];
    }
}
