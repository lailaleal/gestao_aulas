<?php

require_once "Conexao.php";
require_once "Escolas.php";
require_once "AulaoEnemModel.php";
require_once "Aulas.php";

class EscolasModel
{
    private $tabela = "Escolas";
    private $aulaoEnemModel;

    function __construct()
    {
        $this->aulaoEnemModel = new AulaoEnemModel();
    }

    public function create(Escolas $e)
    {
        try {
            $sql = "insert into $this->tabela (nome, email, endereco, interesse_aulao_enem) values (?, ?, ?, ?)";
            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->bindValue(1, $e->getNome());
            $stmt->bindValue(2, $e->getEmail());
            $stmt->bindValue(3, $e->getEndereco());
            $stmt->bindValue(4, $e->getInteresseAulaoEnem());

            $stmt->execute();

            if ($e->getInteresseAulaoEnem() == 1) {
                $stmtId = Conexao::getConn()->prepare("SELECT LAST_INSERT_ID() AS id");
                $stmtId->execute();
                $result = $stmtId->fetch(PDO::FETCH_ASSOC);

                $aula = new Aulas();
                $aula->setData($e->getDataAulaoEnem());
                $aula->setHoraInicio($e->getHoraInicioAulaoEnem());
                $aula->setHoraFim($e->getHoraFimAulaoEnem());
                $aula->setEndereco($e->getEndereco());
                $aula->setTipo("aulao_enem");
                $aula->setIdEscola($result['id']);

                $this->aulaoEnemModel->create($aula);
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function read()
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Escolas');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findId($id )
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id = ?");

        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Escolas');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update (Escolas $e)
    {
        try {
            $sql = "update $this->tabela set nome = ?, email = ?, endereco = ?, interesse_aulao_enem = ? where id = ?";

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->bindValue(1, $e->getNome());
            $stmt->bindValue(2, $e->getEmail());
            $stmt->bindValue(3, $e->getEndereco());
            $stmt->bindValue(4, $e->getInteresseAulaoEnem());
            $stmt->bindValue(5, $e->getId());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function delete ($id)
    {
        try {
            $sql = "delete from $this->tabela where id = ?";
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }
}
