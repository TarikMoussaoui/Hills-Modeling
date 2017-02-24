<?php

namespace HillsModeling\FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Admin
 *
 * @ORM\Table(name="Admin")
 * @ORM\Entity(repositoryClass="HillsModeling\FrontEndBundle\Repository\AdminRepository")
 */
class Admin extends User
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
     * @var string
     * @ORM\Column(name="prenom" , type="string")
     * @Assert\NotBlank()
     */
    protected $prenom;

    /**
     * @var string
     * @ORM\Column(name="responsable" , type="string")
     * @Assert\NotBlank()
     */
    protected $responsable;

    /**
     * @var string
     * @ORM\Column(name="civilisation" , type="string")
     * @Assert\NotBlank()
     */
    protected $civilisation;


    /**
     * @var string
     * @ORM\Column(name="telephone" , type="string")
     * @Assert\Regex(pattern="/^^(0)[0-9]{9}$/", message="Numéro de téléphone non valide")
     * @Assert\NotBlank()
     */
    protected $telephone;



    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Admin
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
     * @return Admin
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Admin
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set civilisation
     *
     * @param string $civilisation
     *
     * @return Admin
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Admin
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set nomMagasin
     *
     * @param string $nomMagasin
     *
     * @return Admin
     */
    public function setNomMagasin($nomMagasin)
    {
        $this->nomMagasin = $nomMagasin;

        return $this;
    }

    /**
     * Get nomMagasin
     *
     * @return string
     */
    public function getNomMagasin()
    {
        return $this->nomMagasin;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Admin
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Admin
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Admin
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telMagasin
     *
     * @param string $telMagasin
     *
     * @return Admin
     */
    public function setTelMagasin($telMagasin)
    {
        $this->telMagasin = $telMagasin;

        return $this;
    }

    /**
     * Get telMagasin
     *
     * @return string
     */
    public function getTelMagasin()
    {
        return $this->telMagasin;
    }
}
