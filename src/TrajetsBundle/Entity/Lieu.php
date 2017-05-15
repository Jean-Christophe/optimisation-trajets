<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 19/04/2017
 * Time: 16:22
 */

namespace TrajetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;

/**
 * Class Lieu
 * @package TrajetsBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="dpb_lieux")
 */
class Lieu implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="150")
     * @ORM\Column(type="string", length=150)
     */
    private $nom;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="250")
     * @ORM\Column(type="string", length=250)
     */
    private $adresse;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[0-9]{5}$/")
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $cpo;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="150")
     * @ORM\Column(type="string", length=150)
     */
    private $ville;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="10")
     * @ORM\Column(type="float")
     */
    private $latitude;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="10")
     * @ORM\Column(type="float")
     */
    private $longitude;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="1")
     * @ORM\Column(type="string", length=1)
     */
    private $label;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return mixed
     */
    public function getCpo()
    {
        return $this->cpo;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @param mixed $cpo
     */
    public function setCpo($cpo)
    {
        $this->cpo = $cpo;
        return $this;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    function __toString()
    {
        return 'id= ' . $this->getId() . ', nom= ' . $this->getNom() . ', adresse= ' . $this->getAdresse() . ', cpo= ' . $this->getCpo() .
            ', ville= ' . $this->getVille() . ', latitude= ' . $this->getLatitude() . ', longitude= ' . $this->getLongitude() .
            ', label= ' . $this->getLabel();
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