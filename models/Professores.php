<?php

require_once "Pessoas.php";

// Classe Professores que herda de Pessoas
// A classe Professores é uma extensão da classe Pessoas, que contém atributos e métodos comuns a todos os professores.
class Professores extends Pessoas
{
    private string $especialidade;
    private string $biografia;
    private float $valor_hora_aula;
    private ?int $id_escola;
    private ?array $horarios;

    public function getIdEscola(): ?int
    {
        return $this->id_escola;
    }

    public function setIdEscola(?int $id_escola)
    {
        $this->id_escola = $id_escola;
    }

    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;
    }

    public function getBiografia()
    {
        return $this->biografia;
    }

    public function setBiografia($biografia)
    {
        $this->biografia = $biografia;
    }
    public function setValorHoraAula($valor) {
        $this->valor_hora_aula = $valor;
    }

    public function getValorHoraAula() {
        return $this->valor_hora_aula;
    }

    public function getHorarios() {
        return $this->horarios;
    }
    public function setHorarios($horarios) {
        $this->horarios = $horarios;
    }
}
