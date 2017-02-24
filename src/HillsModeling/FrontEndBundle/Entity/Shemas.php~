<?php


namespace HillsModeling\FrontEndBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributs
 *
 * @ORM\Table(name="shemas")
 * @ORM\Entity(repositoryClass="HillsModeling\FrontEndBundle\Repository\ShemasRepository")
 */

class Shemas
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
     * @ORM\Column(name="valeurE" , type="string")
     */
    protected $valeurE;

    /**
     * @var \string
     * @ORM\Column(name="valeurS" , type="string")
     */
    protected $valeurS;

    /**
     * @var \text
     * @ORM\Column(name="code" , type="text")
     */
    protected $code;

    /**
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="shemas")
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
     * @return Shemas
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
     * Set valeurE
     *
     * @param string $valeurE
     *
     * @return Shemas
     */
    public function setValeurE($valeurE)
    {
        $this->valeurE = $valeurE;

        return $this;
    }

    /**
     * Get valeurE
     *
     * @return string
     */
    public function getValeurE()
    {
        return $this->valeurE;
    }

    /**
     * Set valeurS
     *
     * @param string $valeurS
     *
     * @return Shemas
     */
    public function setValeurS($valeurS)
    {
        $this->valeurS = $valeurS;

        return $this;
    }

    /**
     * Get valeurS
     *
     * @return string
     */
    public function getValeurS()
    {
        return $this->valeurS;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Shemas
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set projet
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Projet $projet
     *
     * @return Shemas
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
