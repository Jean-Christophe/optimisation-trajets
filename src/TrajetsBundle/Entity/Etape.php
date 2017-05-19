<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 19/05/2017
 * Time: 09:27
 */

namespace TrajetsBundle\Entity;


use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Etape
 * @package TrajetsBundle\Entity
 * @ORM\Entity(repositoryClass="TrajetsBundle\Repository\EtapeRepository")
 * @ORM\Table(name="dpb_etapes")
 */
class Etape implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Trajet", inversedBy="etapes")
     */
    private $trajet;
    /**
     * @ORM\ManyToOne(targetEntity="Lieu")
     */
    private $lieu;
    /**
     * @ORM\Column(type="boolean")
     */
    private $estCompletee;

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
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @return mixed
     */
    public function getEstCompletee()
    {
        return $this->estCompletee;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $trajet
     */
    public function setTrajet($trajet)
    {
        $this->trajet = $trajet;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @param mixed $estCompletee
     */
    public function setEstCompletee($estCompletee)
    {
        $this->estCompletee = $estCompletee;
    }

    function __toString()
    {
        return 'id= ' . $this->getId() . ', trajet= ' . $this->getTrajet() . ', lieu= ' . $this->getLieu() .
            'estCompletee= ' . $this->getEstCompletee();
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