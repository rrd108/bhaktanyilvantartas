<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Service Entity
 *
 * @property int $id
 * @property int $bhakta_id
 * @property int $osztaly_id
 * @property string $szolgalat
 * @property \Cake\I18n\Time $szolgalat_kezdete
 * @property \Cake\I18n\Time $szolgalat_vege
 * @property string $szolg_megjegyzes
 *
 * @property \App\Model\Entity\Bhakta $bhakta
 * @property \App\Model\Entity\Osztaly $osztaly
 */
class Service extends Entity
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
        'id' => false
    ];
}
