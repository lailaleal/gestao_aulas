<?php

require_once "Conexao.php";
require_once "AulasAlunos.php";

class AulasAlunosModel
{

  private $tabela = "AulasAlunos";

  public function create(AulasAlunos $a)
  {
    try {
      $sql = "insert into $this->tabela (id_aluno, id_aula) values (?,?)";
      $stmt = Conexao::getConn()->prepare($sql);
      $stmt->bindValue(1, $a->getIdAluno());
      $stmt->bindValue(2, $a->getIdAula());
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
      echo " Número: " . (int)$e->getCode();
    }
  }

  public function read()
  {
    $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'AulasAlunos');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findId($id)
  {
    $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id=?");
    $stmt->bindValue(1, $id);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'AulasAlunos');
    $stmt->execute();
    return $stmt->fetch();
  }

  public function findByAulaId($aulaId)
  {
    $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id_aula=?");
    $stmt->bindValue(1, $aulaId);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'AulasAlunos');
    $stmt->execute();
    return $stmt->fetch();
  }

  public function delete($id)
  {
    try {
      // Cria string SQL
      $sql = "delete from $this->tabela where id=?";
      // Prepara conexão com banco de dados
      $stmt = Conexao::getConn()->prepare($sql);
      // Insere dados na consulta
      $stmt->bindValue(1, $id);
      // Executa código SQL no banco de dados
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
      echo " Número: " . (int)$e->getCode();
    }
  }
}
