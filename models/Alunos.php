<?php

require_once "Pessoas.php";

class Alunos extends Pessoas
{
    private string $serie;
    private ?int $id_escola;

    public function getIdEscola(): ?int
    {
        return $this->id_escola;
    }

    public function setIdEscola(?int $id_escola)
    {
        $this->id_escola = $id_escola;
    }

    public function getSerie()
    {
        return $this->serie;
    }

    public function setSerie($serie)
    {
        $this->serie = $serie;
    }
}
