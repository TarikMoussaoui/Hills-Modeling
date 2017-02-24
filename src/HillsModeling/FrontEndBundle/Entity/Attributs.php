<?php


namespace HillsModeling\FrontEndBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributs
 *
 * @ORM\Table(name="Attributs")
 * @ORM\Entity(repositoryClass="HillsModeling\FrontEndBundle\Repository\AttributsRepository")
 */

class Attributs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="nom" , type="string")
     * @Assert\NotBlank()
     */
    protected $nom;

    /**
     * @var \string
     * @ORM\Column(name="type" , type="string")
     * @Assert\NotBlank()
     */
    protected $type;

    /**
     * @var \string
     * @ORM\Column(name="valeur" , type="string")
     */
    protected $valeur;

    /**
     * @var \int
     * @ORM\Column(name="etat" , type="integer")
     */
    protected $Etat;

    /**
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="attributs")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Attributs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Attributs
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set valeur
     *
     * @param string $valeur
     *
     * @return Attributs
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Attributs
     */
    public function setEtat($etat)
    {
        $this->Etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->Etat;
    }

    /**
     * Set projet
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Projet $projet
     *
     * @return Attributs
     */
    public function setProjet(\HillsModeling\FrontEndBundle\Entity\Projet $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \HillsModeling\FrontEndBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
