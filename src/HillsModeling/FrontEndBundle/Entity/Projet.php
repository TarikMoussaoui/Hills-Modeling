<?php


namespace HillsModeling\FrontEndBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="Projet")
 * @ORM\Entity(repositoryClass="HillsModeling\FrontEndBundle\Repository\ProjetRepository")
 */

class Projet
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
     * @var \DateTime
     * @ORM\Column(name="dateCreation" , type="date")
     * @Assert\NotBlank()
     */
    protected $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="Membre", inversedBy="projet")
     * @ORM\JoinColumn(name="membre_id", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;



    /**
     * @ORM\OneToMany(targetEntity="Attributs", mappedBy="projet")
     */
    private $attributs;
    /**
     * @ORM\OneToMany(targetEntity="Shemas", mappedBy="projet")
     */
    private $shemas;
    /**
     * @ORM\OneToMany(targetEntity="Transitions", mappedBy="projet")
     */
    private $transitions;

    public function __construct() {
        $this->attributs = new ArrayCollection();
        $this->shemas = new ArrayCollection();
        $this->transitions = new ArrayCollection();
    }




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
     * @return Projet
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Projet
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set membre
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Membre $membre
     *
     * @return Projet
     */
    public function setMembre(\HillsModeling\FrontEndBundle\Entity\Membre $membre = null)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Get membre
     *
     * @return \HillsModeling\FrontEndBundle\Entity\Membre
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * Add attribut
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Attributs $attribut
     *
     * @return Projet
     */
    public function addAttribut(\HillsModeling\FrontEndBundle\Entity\Attributs $attribut)
    {
        $this->attributs[] = $attribut;

        return $this;
    }

    /**
     * Remove attribut
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Attributs $attribut
     */
    public function removeAttribut(\HillsModeling\FrontEndBundle\Entity\Attributs $attribut)
    {
        $this->attributs->removeElement($attribut);
    }

    /**
     * Get attributs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributs()
    {
        return $this->attributs;
    }

    /**
     * Add shema
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Shemas $shema
     *
     * @return Projet
     */
    public function addShema(\HillsModeling\FrontEndBundle\Entity\Shemas $shema)
    {
        $this->shemas[] = $shema;

        return $this;
    }

    /**
     * Remove shema
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Shemas $shema
     */
    public function removeShema(\HillsModeling\FrontEndBundle\Entity\Shemas $shema)
    {
        $this->shemas->removeElement($shema);
    }

    /**
     * Get shemas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShemas()
    {
        return $this->shemas;
    }

    /**
     * Add transition
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Transitions $transition
     *
     * @return Projet
     */
    public function addTransition(\HillsModeling\FrontEndBundle\Entity\Transitions $transition)
    {
        $this->transitions[] = $transition;

        return $this;
    }

    /**
     * Remove transition
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Transitions $transition
     */
    public function removeTransition(\HillsModeling\FrontEndBundle\Entity\Transitions $transition)
    {
        $this->transitions->removeElement($transition);
    }

    /**
     * Get transitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransitions()
    {
        return $this->transitions;
    }
}
