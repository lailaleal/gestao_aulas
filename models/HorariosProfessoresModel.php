<?php

require_once "Conexao.php";
require_once "HorariosProfessores.php";

class HorariosProfessoresModel
{

    private $tabela = "HorariosProfessores";

    public function create(HorariosProfessores $a)
    {
        try {
            // Cria string SQL
            $sql = "insert into $this->tabela (id_professor, data, hora_inicio, hora_fim) values (?,?,?,?)";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $a->getIdProfessor());
            $stmt->bindValue(2, $a->getData());
            $stmt->bindValue(3, $a->getHoraInicio());
            $stmt->bindValue(4, $a->getHoraFim());

            // Executa código SQL no banco de dados
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function read()
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HorariosProfessores');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findId($id)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id=?");
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'HorariosProfessores');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update(HorariosProfessores $a)
    {
        try {
            // Cria string SQL
            $sql = "update $this->tabela set id_professor=?, data=?, hora_inicio=?, hora_fim=? where id=?";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $a->getIdProfessor());
            $stmt->bindValue(2, $a->getData());
            $stmt->bindValue(3, $a->getHoraInicio());
            $stmt->bindValue(4, $a->getHoraFim());
            $stmt->bindValue(5, $a->getId());
            // Executa código SQL no banco de dados
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
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
