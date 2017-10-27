<?php

namespace Main\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questao
 */
class Questao
{
    /**
     * @var string
     */
    private $idquizz;

    /**
     * @var string
     */
    private $enunciado;

    /**
     * @var string
     */
    private $alta;

    /**
     * @var string
     */
    private $altb;

    /**
     * @var string
     */
    private $altc;

    /**
     * @var string
     */
    private $altd;

    /**
     * @var string
     */
    private $answer;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set idquizz
     *
     * @param string $idquizz
     * @return Questao
     */
    public function setIdquizz($idquizz)
    {
        $this->idquizz = $idquizz;

        return $this;
    }

    /**
     * Get idquizz
     *
     * @return string 
     */
    public function getIdquizz()
    {
        return $this->idquizz;
    }

    /**
     * Set enunciado
     *
     * @param string $enunciado
     * @return Questao
     */
    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;

        return $this;
    }

    /**
     * Get enunciado
     *
     * @return string 
     */
    public function getEnunciado()
    {
        return $this->enunciado;
    }

    /**
     * Set alta
     *
     * @param string $alta
     * @return Questao
     */
    public function setAlta($alta)
    {
        $this->alta = $alta;

        return $this;
    }

    /**
     * Get alta
     *
     * @return string 
     */
    public function getAlta()
    {
        return $this->alta;
    }

    /**
     * Set altb
     *
     * @param string $altb
     * @return Questao
     */
    public function setAltb($altb)
    {
        $this->altb = $altb;

        return $this;
    }

    /**
     * Get altb
     *
     * @return string 
     */
    public function getAltb()
    {
        return $this->altb;
    }

    /**
     * Set altc
     *
     * @param string $altc
     * @return Questao
     */
    public function setAltc($altc)
    {
        $this->altc = $altc;

        return $this;
    }

    /**
     * Get altc
     *
     * @return string 
     */
    public function getAltc()
    {
        return $this->altc;
    }

    /**
     * Set altd
     *
     * @param string $altd
     * @return Questao
     */
    public function setAltd($altd)
    {
        $this->altd = $altd;

        return $this;
    }

    /**
     * Get altd
     *
     * @return string 
     */
    public function getAltd()
    {
        return $this->altd;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Questao
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
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
}
