<?php
    namespace Main\loginBundle\Modals;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class FBplach
{
    private $id;
    private $cidade;
    private $estado;
    private $nome;
    
    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getNome() {
        return $this->nome;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

        function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
}
    
?>