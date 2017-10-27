<?php

namespace Main\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Quizz
 */
class Quizz
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var integer
     */
    private $id;
    
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Questao", cascade={"persist"})
     */
    protected $questoes;


    public function __construct()
    {
        $this->questoes = new ArrayCollection();
    }
    
    /**
     * Set nome
     *
     * @param string $nome
     * @return Quizz
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
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
    
    public function getQuestoes()
    {
        return $this->questoes;
    }

    public function setQuestoes(ArrayCollection $questoes)
    {
        $this->questoes = $questoes;
    }
    
    public function addQuestao(Questao $questao)
    {
        $this->questoes->add($questao);
    }
    
    public function removeQuestao(Questao $questao)
    {
        // ...
    }
}
