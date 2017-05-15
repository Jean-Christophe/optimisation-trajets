<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/05/2017
 * Time: 15:38
 */

namespace TrajetsBundle\Entity;


use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Lieu
 * @package TrajetsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="dpb_trajets")
 */
class Trajet implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Lieu")
     */
    private $origine;
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Lieu")
     */
    private $destination;
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToMany(targetEntity="Lieu")
     * @ORM\JoinTable(name="trajet_etape",
     *     joinColumns={@ORM\JoinColumn(name="trajet_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="etape_id", referencedColumnName="id")}
     *     )
     */
    private $etapes;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateDepart;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateArriveePrevue;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateArrivee;
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     */
    private $utilisateur;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean")
     */
    private $estActif;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean")
     */
    private $estEffectue;

    public function __construct()
    {
        $this->setEtapes(new \Doctrine\Common\Collections\ArrayCollection());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return mixed
     */
    public function getEtapes()
    {
        return $this->etapes;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @return mixed
     */
    public function getDateArriveePrevue()
    {
        return $this->dateArriveePrevue;
    }

    /**
     * @return mixed
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @return mixed
     */
    public function getEstActif()
    {
        return $this->estActif;
    }

    /**
     * @return mixed
     */
    public function getEstEffectue()
    {
        return $this->estEffectue;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @param mixed $etapes
     */
    public function setEtapes($etapes)
    {
        $this->etapes = $etapes;
    }

    /**
     * @param mixed $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @param mixed $dateArriveePrevue
     */
    public function setDateArriveePrevue($dateArriveePrevue)
    {
        $this->dateArriveePrevue = $dateArriveePrevue;
    }

    /**
     * @param mixed $dateArrivee
     */
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @param mixed $estActif
     */
    public function setEstActif($estActif)
    {
        $this->estActif = $estActif;
    }

    /**
     * @param mixed $estEffectue
     */
    public function setEstEffectue($estEffectue)
    {
        $this->estEffectue = $estEffectue;
    }

    function __toString()
    {
        $etapes = '';
        foreach ($this->getEtapes() as $etape)
        {
            $etapes .= $etape . ' - ';
        }
        return 'Trajet ' . $this->getId() . ' de ' . $this->getOrigine() . ' à ' . $this->getDestination() . ', étapes : ' .
            $etapes . ' Date départ : ' . $this->getDateDepart() . ', date d\'arrivée prévue ' . $this->getDateArriveePrevue() .
            ', date d\arrivée : ' . $this->getDateArrivee() . ', utilisateur : '  .$this->getUtilisateur() .
            ', effectué : ' . $this->getEstEffectue() . ', est actif : ' . $this->getEstActif();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}