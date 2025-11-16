<?php

class Notificacoes
{
    private $id;
    private $id_usuario;
    private $tipo;
    private $mensagem;
    private $lida;
    private $data_criacao;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function getLida()
    {
        return $this->lida;
    }

    public function setLida($lida)
    {
        $this->lida = $lida;
    }

    public function getDataCriacao()
    {
        return $this->data_criacao;
    }

    public function setDataCriacao($data_criacao)
    {
        $this->data_criacao = $data_criacao;
    }
}