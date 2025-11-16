<?php

require_once "Conexao.php";
require_once "NotificacoesModel.php";
require_once "Notificacoes.php";
require_once "AulasAlunos.php";
require_once "AulasAlunosModel.php";

class AulaoEnemModel
{

    private $tabela = "Aulas";
    private $aulasAlunosModel;
    private $notificacoesModel;

    public function __construct() {
        $this->notificacoesModel = new NotificacoesModel();
        $this->aulasAlunosModel = new AulasAlunosModel();
    }

    public function create(Aulas $a)
    {
        try {
            $a->setStatus("Pendente");

            // Cria string SQL
            $sql = "insert into $this->tabela (data, hora_inicio, hora_fim,
                status, tipo, endereco, id_escola) values (?,?,?,?,?,?,?)";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $a->getData());
            $stmt->bindValue(2, $a->getHoraInicio());
            $stmt->bindValue(3, $a->getHoraFim());
            $stmt->bindValue(4, $a->getStatus());
            $stmt->bindValue(5, $a->getTipo());
            $stmt->bindValue(6, $a->getEndereco());
            $stmt->bindValue(7, $a->getIdEscola());

            // Executa código SQL no banco de dados
            $stmt->execute();

            $stmtId = Conexao::getConn()->prepare("SELECT LAST_INSERT_ID() AS id");
            $stmtId->execute();
            $result = $stmtId->fetch(PDO::FETCH_ASSOC);

            return $result['id'];
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function adicionaAlunoEnem($aluno) {
        $aulaoEnem = $this->getAulaoEnemEscola($aluno->getIdEscola());

        $aulaAluno = new AulasAlunos();
        $aulaAluno->setIdAluno($aluno->getId());
        $aulaAluno->setIdAula($aulaoEnem->getId());
        $this->aulasAlunosModel->create($aulaAluno);

        $alunosEnem = $this->getUsuariosAlunosEnem($aluno->getIdEscola());
        if (count($alunosEnem) >= 20) {
            $aulaoEnem->setStatus('Confirmada');
            $this->update($aulaoEnem);

            $this->notificacoesModel->notificaAulaoEnem($aluno->getIdEscola(), $alunosEnem);
        }
    }

    private function getUsuariosAlunosEnem($idEscola) {
        $stmt = Conexao::getConn()->prepare("select u.id
            from Alunos a
            inner join Escolas e on a.id_escola = e.id
            inner join Usuarios u on a.email = u.email
            where a.interesse_aulao_enem = 1
              and e.interesse_aulao_enem = 1
              and e.id = ?");

        $stmt->bindValue(1, $idEscola);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarios');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    private function getAulaoEnemEscola($idEscola)
    {
        $stmt = Conexao::getConn()->prepare("
            select *
            from Aulas
            where id_escola = ?
            and tipo = 'aulao_enem'
        ");
        $stmt->bindValue(1, $idEscola);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Aulas');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function adicionaProfessorAulaoEnem($idEscola, $idProfessor) {
        $aulaoEnem = $this->getAulaoEnemEscola($idEscola);
        $aulaoEnem->setIdProfessor($idProfessor);

        $this->update($aulaoEnem);
    }

    public function update(Aulas $a)
    {
        try {
            $sql = "update $this->tabela set data=?, hora_inicio=?, hora_fim=?,
                  status=?, tipo=?, endereco=?, id_escola=?, id_professor=? where id=?";

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->bindValue(1, $a->getData());
            $stmt->bindValue(2, $a->getHoraInicio());
            $stmt->bindValue(3, $a->getHoraFim());
            $stmt->bindValue(4, $a->getStatus());
            $stmt->bindValue(5, $a->getTipo());
            $stmt->bindValue(6, $a->getEndereco());
            $stmt->bindValue(7, $a->getIdEscola());
            $stmt->bindValue(8, $a->getIdProfessor());
            $stmt->bindValue(9, $a->getId());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }
}
