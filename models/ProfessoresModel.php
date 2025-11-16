<?php

require_once "Conexao.php";
require_once "Professores.php";
require_once "HorariosProfessoresModel.php";
require_once "AulaoEnemModel.php";

class ProfessoresModel
{

    private $tabela = "Professores";
    private $horariosProfessoresModel;
    private $aulaoEnemModel;

    function __construct()
    {
      $this->horariosProfessoresModel = new HorariosProfessoresModel();
      $this->aulaoEnemModel = new AulaoEnemModel();
    }

    public function create(Professores $p)
    {
        try {
            // Cria string SQL
            $sql = "insert into $this->tabela (nome, email, telefone, especialidade, biografia, valor_hora_aula,
                senha, interesse_aulao_enem, id_escola) values (?,?,?,?,?,?,?,?,?)";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $p->getNome());
            $stmt->bindValue(2, $p->getEmail());
            $stmt->bindValue(3, $p->getTelefone());
            $stmt->bindValue(4, $p->getEspecialidade());
            $stmt->bindValue(5, $p->getBiografia());
            $stmt->bindValue(6, $p->getValorHoraAula());
            $stmt->bindValue(7, $p->getSenha());
            $stmt->bindValue(8, $p->getInteresseAulaoEnem());
            $stmt->bindValue(9, $p->getIdEscola());

            // Executa código SQL no banco de dados
            $stmt->execute();

            $stmtId = Conexao::getConn()->prepare("SELECT LAST_INSERT_ID() AS id");
            $stmtId->execute();
            $result = $stmtId->fetch(PDO::FETCH_ASSOC);

            foreach ($p->getHorarios() as $horario) {
                $horariosProfessores = new HorariosProfessores();

                $horariosProfessores->setData($horario['data']);
                $horariosProfessores->setHoraInicio($horario['horaInicio']);
                $horariosProfessores->setHoraFim($horario['horaFim']);
                $horariosProfessores->setIdProfessor($result['id']);

                $this->horariosProfessoresModel->create($horariosProfessores);
            }

            if ($p->getInteresseAulaoEnem()) {
                $this->aulaoEnemModel->adicionaProfessorAulaoEnem($p->getIdEscola(), $result['id']);
            }

            return $result['id'];
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function read()
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Professores');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findId($id)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id=?");
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Professores');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update(Professores $p)
    {
        try {
            // Cria string SQL
            $sql = "update $this->tabela set nome=?, email=?, telefone=?, especialidade=?, biografia=?, valor_hora_aula=?,
                , interesse_aulao_enem=?, id_escola=? where id=?";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);

            // Insere dados na consulta
            $stmt->bindValue(1, $p->getNome());
            $stmt->bindValue(2, $p->getEmail());
            $stmt->bindValue(3, $p->getTelefone());
            $stmt->bindValue(4, $p->getEspecialidade());
            $stmt->bindValue(5, $p->getBiografia());
            $stmt->bindValue(6, $p->getValorHoraAula());
            $stmt->bindValue(7, $p->getId());
            $stmt->bindValue(8, $p->getInteresseAulaoEnem());
            $stmt->bindValue(9, $p->getidEscola());

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
