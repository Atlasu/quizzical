<?php

namespace Main\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade
 */
class Entidade
{
    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $cidade;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $idfacebook;

    /**
     * @var string
     */
    private $cnpj;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set password
     *
     * @param string $password
     * @return Entidade
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Entidade
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Entidade
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     * @return Entidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Entidade
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
     * Set idfacebook
     *
     * @param string $idfacebook
     * @return Entidade
     */
    public function setIdfacebook($idfacebook)
    {
        $this->idfacebook = $idfacebook;

        return $this;
    }

    /**
     * Get idfacebook
     *
     * @return string 
     */
    public function getIdfacebook()
    {
        return $this->idfacebook;
    }

    /**
     * Set cnpj
     *
     * @param string $cnpj
     * @return Entidade
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string 
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Entidade
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
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
