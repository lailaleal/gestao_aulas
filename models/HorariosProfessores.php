<?php

class HorariosProfessores
{
    private string $id;
    private string $data;
    private string $hora_inicio;
    private string $hora_fim;
    private string $id_professor;


    public function getId(): string
    {
      return $this->id;
    }
    public function setId(string $id): void
    {
      $this->id = $id;
    }
    public function getData(): string
    {
      return $this->data;
    }
    public function setData(string $data): void
    {
      $this->data = $data;
    }
    public function getHoraInicio(): string
    {
      return $this->hora_inicio;
    }
    public function setHoraInicio(string $hora_inicio): void
    {
      $this->hora_inicio = $hora_inicio;
    }
    public function getHoraFim(): string
    {
      return $this->hora_fim;
    }
    public function setHoraFim(string $hora_fim): void
    {
      $this->hora_fim = $hora_fim;
    }
    public function getIdProfessor(): string
    {
      return $this->id_professor;
    }
    public function setIdProfessor(string $id_professor): void
    {
      $this->id_professor = $id_professor;
    }
}
