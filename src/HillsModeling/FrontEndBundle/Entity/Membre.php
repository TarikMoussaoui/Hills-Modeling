<?php

namespace HillsModeling\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Membre
 *
 * @ORM\Table(name="Membre")
 * @ORM\Entity(repositoryClass="HillsModeling\FrontEndBundle\Repository\MembreRepository")
 */
class Membre extends User
{
    /**
     * @var int
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
     * @var string
     * @ORM\Column(name="prenom" , type="string")
     * @Assert\NotBlank()
     */
    protected $prenom;


    /**
     * @var string
     * @ORM\Column(name="civilisation" , type="string")
     * @Assert\NotBlank()
     */
    protected $civilisation;


    /**
     * @ORM\OneToMany(targetEntity="Projet", mappedBy="membre")
     */
    private $projet;

    public function __construct() {
        $this->projet = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Membre
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Membre
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Membre
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set civilisation
     *
     * @param string $civilisation
     *
     * @return Membre
     */
    public function setCivilisation($civilisation)
    {
        $this->civilisation = $civilisation;

        return $this;
    }

    /**
     * Get civilisation
     *
     * @return string
     */
    public function getCivilisation()
    {
        return $this->civilisation;
    }




    /**
     * Add projet
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Projet $projet
     *
     * @return Membre
     */
    public function addProjet(\HillsModeling\FrontEndBundle\Entity\Projet $projet)
    {
        $this->projet[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Projet $projet
     */
    public function removeProjet(\HillsModeling\FrontEndBundle\Entity\Projet $projet)
    {
        $this->projet->removeElement($projet);
    }

    /**
     * Get projet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
