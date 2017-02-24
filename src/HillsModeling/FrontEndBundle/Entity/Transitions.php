<?php


namespace HillsModeling\FrontEndBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributs
 *
 * @ORM\Table(name="transitions")
 * @ORM\Entity(repositoryClass="HillsModeling\FrontEndBundle\Repository\TransitionsRepository")
 */

class Transitions
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
     * @ORM\Column(name="valeur" , type="string")
     */
    protected $valeur;

    /**
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="transitions")
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
     * Set valeur
     *
     * @param string $valeur
     *
     * @return Transitions
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
     * Set projet
     *
     * @param \HillsModeling\FrontEndBundle\Entity\Projet $projet
     *
     * @return Transitions
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
