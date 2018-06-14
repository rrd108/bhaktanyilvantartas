<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bhakta Entity
 *
 * @property int $id
 * @property bool $neme
 * @property string $nev_szuletesi
 * @property string $nev_polgari
 * @property string $nev_avatott
 * @property int $guru_id
 * @property string $cim_allando
 * @property string $cim_ideiglenes
 * @property string $cim_szallas
 * @property string $szig
 * @property string $utlevel
 * @property string $adoazonosito
 * @property string $taj
 * @property string $szul_hely
 * @property \Cake\I18n\Time $szul_date
 * @property \Cake\I18n\Time $szul_time
 * @property string $allampolgarsag
 * @property int $katonasag
 * @property string $haziorvos_nev
 * @property string $haziorvos_cim
 * @property string $haziorvos_telefon
 * @property string $datum_elsotalalkozas
 * @property string $datum_elfogadas
 * @property string $datum_elsoavatas
 * @property string $datum_masodikavatas
 * @property int $asram
 * @property int $hazastars_id
 * @property string $tb
 * @property string $legalstatus_id
 * @property string $communityrole_id
 * @property string $vegzettseg
 * @property string $szakma
 * @property string $vegakarat
 * @property string $halalertesitendo
 * @property string $bhsastri_datum
 * @property string $bhsastri_eredmeny
 * @property string $nyelv
 * @property string $csalad_nev_anya
 * @property string $csalad_nev_apa
 * @property string $csalad_hozzaallas
 * @property string $india
 * @property string $rs_szerz
 * @property bool $active
 * @property string $bizalmas_info
 * @property string $megjegyzes
 * @property string $kep
 *
 * @property \App\Model\Entity\Gurus $gurus
 * @property \App\Model\Entity\Hazastar $hazastar
 * @property \App\Model\Entity\Service[] $services
 */
class Bhakta extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'kep' => true
    ];
}
