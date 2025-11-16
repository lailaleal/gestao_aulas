<?php

abstract class Pessoas
{
    protected int $id; // protected permite que a variável seja acessada apenas dentro da classe e suas subclasses (Professores, Alunos, etc.)
    protected string $nome; // private foi removido para permitir que as subclasses acessem diretamente o nome
    protected string $email = '';
    protected string $telefone;
    protected string $senha;
    protected ?int $interesse_aulao_enem;  // 0 ou 1, pode ser nulo

    public function getInteresseAulaoEnem(): ?int
    {
        return $this->interesse_aulao_enem;
    }

    public function setInteresseAulaoEnem(?int $interesse_aulao_enem)
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        // Exemplo de uso de encapsulamento: validação do email
        if (strpos($email, '@') == false || strpos($email, '.com') == false) {
            echo "Erro: Email inválido";
        } else {
            $this->email = $email;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
}