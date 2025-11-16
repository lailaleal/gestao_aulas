<?php

class AulasAlunos
{
    private int $id;
    private int $id_aluno;
    private int $id_aula;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getIdAluno(): int
    {
        return $this->id_aluno;
    }

    public function getIdAula(): int
    {
        return $this->id_aula;
    }

    public function setIdAluno(int $id_aluno): void
    {
        $this->id_aluno = $id_aluno;
    }
    public function setIdAula(int $id_aula): void
    {
        $this->id_aula = $id_aula;
    }
}
