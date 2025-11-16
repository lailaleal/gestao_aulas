<?php

class Escolas
{
    private int $id;
    private string $nome;
    private string $email;
    private ?string $endereco;           // pode ser nulo
    private ?int $interesse_aulao_enem;  // 0 ou 1, pode ser nulo
    protected string $senha;
    private string $dataAulaoEnem;
    private string $horaInicioAulaoEnem;
    private string $horaFimAulaoEnem;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): void
    {
        $this->endereco = $endereco;
    }

    public function getInteresseAulaoEnem(): ?int
    {
        return $this->interesse_aulao_enem;
    }

    public function setInteresseAulaoEnem(?int $interesse_aulao_enem): void
    {
        $this->interesse_aulao_enem = $interesse_aulao_enem;
    }

    public function getSenha()
    {
      return $this->senha;
    }

    public function setSenha($senha)
    {
      $this->senha = $senha;
    }

    public function getDataAulaoEnem()
    {
      return $this->dataAulaoEnem;
    }
    public function setDataAulaoEnem($dataAulaoEnem)
    {
      $this->dataAulaoEnem = $dataAulaoEnem;
    }
    public function getHoraInicioAulaoEnem()
    {
      return $this->horaInicioAulaoEnem;
    }
    public function setHoraInicioAulaoEnem($horaInicioAulaoEnem)
    {
      $this->horaInicioAulaoEnem = $horaInicioAulaoEnem;
    }
    public function getHoraFimAulaoEnem()
    {
      return $this->horaFimAulaoEnem;
    }
    public function setHoraFimAulaoEnem($horaFimAulaoEnem)
    {
      $this->horaFimAulaoEnem = $horaFimAulaoEnem;
    }

}
