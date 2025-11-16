<?php

class Aulas
{
    private int $id;
    private string $nome_aluno = "";
    private ?string $id_professor;
    private ?string $id_escola;
    private ?string $nome_professor = "";
    private ?string $disciplina;
    private string $data;
    private string $hora_inicio;
    private string $hora_fim;
    private string $status;
    private string $tipo;
    private ?string $link;
    private ?string $endereco; // ? indica que o campo pode ser nulo
    private ?string $observacoes;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getObservacoes()
    {
        return $this->observacoes;
    }

    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;
    }

    public function getNomeAluno()
    {
        return $this->nome_aluno;
    }

    public function setNomeAluno($nome_aluno)
    {
        $this->nome_aluno = $nome_aluno;
    }

    public function getIdProfessor()
    {
        return $this->id_professor;
    }

    public function setIdProfessor($id_professor)
    {
        $this->id_professor = $id_professor;
    }

    public function getNomeProfessor()
    {
        return $this->nome_professor;
    }

    public function setNomeProfessor($nome_professor)
    {
        $this->nome_professor = $nome_professor;
    }

    public function getDisciplina() {
        return $this->disciplina;
    }

    public function setDisciplina($disciplina) {
        $this->disciplina = $disciplina;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHoraInicio()
    {
        return $this->hora_inicio;
    }
    public function setHoraInicio($hora_inicio)
    {
        $this->hora_inicio = $hora_inicio;
    }
    public function getHoraFim()
    {
        return $this->hora_fim;
    }
    public function setHoraFim($hora_fim)
    {
        $this->hora_fim = $hora_fim;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function getLink()
    {
        return $this->link;
    }
    public function setLink($link)
    {
        $this->link = $link;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
    public function getIdEscola()
    {
        return $this->id_escola;
    }
    public function setIdEscola($id_escola)
    {
        $this->id_escola = $id_escola;
    }
}
