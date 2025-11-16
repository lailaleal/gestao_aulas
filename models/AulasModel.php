<?php

require_once "Conexao.php";
require_once "Aulas.php";

require_once "ProfessoresModel.php";
require_once "AlunosModel.php";
require_once "UsuarioModel.php";
require_once "AulasAlunos.php";
require_once "AulasAlunosModel.php";

class AulasModel
{

    private $tabela = "Aulas";
    private $professoresModel;
    private $alunosModel;
    private $notificacoesModel;
    private $usuarioModel;
    private $aulasAlunosModel;

    function __construct()
    {
        $this->professoresModel = new ProfessoresModel();
        $this->alunosModel = new AlunosModel();
        $this->notificacoesModel = new NotificacoesModel();
        $this->usuarioModel = new UsuarioModel();
        $this->aulasAlunosModel = new AulasAlunosModel();
    }

    public function create(Aulas $a)
    {
        try {
            $a->setStatus("Pendente");

            $stmt = Conexao::getConn()->prepare("select * from Professores where id=?");
            $stmt->bindValue(1, $a->getIdProfessor());
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Professores');
            $stmt->execute();
            $professor = $stmt->fetch();

            // Cria string SQL
            $sql = "insert into $this->tabela (id_professor, disciplina, data, hora_inicio, hora_fim,
                status, tipo, link, endereco, observacoes) values (?,?,?,?,?,?,?,?,?,?)";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $a->getIdProfessor());
            $stmt->bindValue(2, $professor->getEspecialidade());
            $stmt->bindValue(3, $a->getData());
            $stmt->bindValue(4, $a->getHoraInicio());
            $stmt->bindValue(5, $a->getHoraFim());
            $stmt->bindValue(6, $a->getStatus());
            $stmt->bindValue(7, $a->getTipo());
            $stmt->bindValue(8, $a->getLink());
            $stmt->bindValue(9, $a->getEndereco());
            $stmt->bindValue(10, $a->getObservacoes());

            // Executa código SQL no banco de dados
            $stmt->execute();

            $stmtId = Conexao::getConn()->prepare("SELECT LAST_INSERT_ID() AS id");
            $stmtId->execute();
            $result = $stmtId->fetch(PDO::FETCH_ASSOC);

            $usuario = unserialize($_SESSION[SessionConf::$sessionObj]);
            $aluno = $this->alunosModel->findEmail($usuario->getEmail());

            $aulasAlunos = new AulasAlunos();
            $aulasAlunos->setIdAluno($aluno->getId());
            $aulasAlunos->setIdAula($result['id']);
            $this->aulasAlunosModel->create($aulasAlunos);

            $professor = $this->professoresModel->findId($a->getIdProfessor());
            $usuarioProf = $this->usuarioModel->findEmail($professor->getEmail());

            $notificacao = new Notificacoes();
            $notificacao->setIdUsuario($usuarioProf->getId());
            $notificacao->setTipo("solicitacao_aula");
            $notificacao->setMensagem("Uma nova aula foi solicitada por " . $usuario->getNome() . " para " . $a->getData() . " às " . $a->getHoraInicio() . ".");
            $notificacao->setLida(0);
            $notificacao->setDataCriacao(date("Y-m-d H:i:s"));
            $this->notificacoesModel->create($notificacao);

            return $result['id'];
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function confirmarAula($id) {
        $aula = $this->findId($id);
        $aula->setStatus("Confirmada");
        $this->update($aula);

        $usuario = unserialize($_SESSION[SessionConf::$sessionObj]);

        $aulaAlunos = $this->aulasAlunosModel->findByAulaId($aula->getId());
        $aluno = $this->alunosModel->findId($aulaAlunos->getIdAluno());
        $usuarioAluno = $this->usuarioModel->findEmail($aluno->getEmail());

        $notificacao = new Notificacoes();
        $notificacao->setIdUsuario($usuarioAluno->getId());
        $notificacao->setTipo("confirmacao_aula");
        $notificacao->setMensagem("O(A) professor(a) " . $usuario->getNome() . " confirmou sua aula");
        $notificacao->setLida(0);
        $notificacao->setDataCriacao(date("Y-m-d H:i:s"));
        $this->notificacoesModel->create($notificacao);

        return $aula;
    }

    public function read()
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Aulas');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAulasDoAluno($email)
    {
        $stmt = Conexao::getConn()->prepare("
            SELECT a.*
            FROM Aulas a
            INNER JOIN AulasAlunos aa ON aa.id_aula = a.id
            INNER JOIN Alunos al ON al.id = aa.id_aluno
            where al.email = ?
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Aulas');
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $aulas = $stmt->fetchAll();

        $this->getProfessor($aulas);

        return $aulas;
    }

    private function getProfessor($aulas) {
      $professores = $this->professoresModel->read();
      foreach($aulas as $aula) {
          foreach($professores as $professor) {
              if($aula->getIdProfessor() == $professor->getId()) {
                  $aula->setNomeProfessor($professor->getNome());
              }
          }
      }
    }

    public function getAulasDoProfessor($email)
    {
        $stmt = Conexao::getConn()->prepare("select a.* from Aulas a inner join Professores p on a.id_professor = p.id where p.email = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Aulas');
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $aulas = $stmt->fetchAll();

        $this->setNomeAlunosAula($aulas);

        return $aulas;
    }

    public function getAulasDaEscola($email)
    {
        $stmt = Conexao::getConn()->prepare("select a.* from Aulas a inner join Escolas p on a.id_escola = p.id where p.email = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Aulas');
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $aulas = $stmt->fetchAll();

        $this->setNomeAlunosAula($aulas);

        return $aulas;
    }

    private function setNomeAlunosAula($aulas) {
      $alunos = $this->alunosModel->read();
      $alunosAulas = $this->aulasAlunosModel->read();

      foreach ($aulas as $aula) {

        $aulaId = $aula->getId();

        // filtra registros da relação
        $matches = array_filter($alunosAulas, function($item) use ($aulaId) {
          return $item->getIdAula() == $aulaId;
        });

        // pega o primeiro registro encontrado
        $alunoAula = reset($matches); // reset() é mais seguro que current()

        // se não houver resultado, pula
        if (!$alunoAula || !is_object($alunoAula)) {
          continue;
        }

        foreach ($alunos as $aluno) {
          if ($alunoAula->getIdAluno() == $aluno->getId()) {
            $aula->setNomeAluno($aluno->getNome());
            break;
          }
        }
      }
    }

    public function findId($id)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id=?");
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Aulas');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update(Aulas $a)
    {
        try {
            // Cria string SQL
            $sql = "update $this->tabela set id_professor=?, data=?, hora_inicio=?, hora_fim=?,
            status=?, tipo=?, link=?, endereco=?, observacoes=? where id=?";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $a->getIdProfessor());
            $stmt->bindValue(2, $a->getData());
            $stmt->bindValue(3, $a->getHoraInicio());
            $stmt->bindValue(4, $a->getHoraFim());
            $stmt->bindValue(5, $a->getStatus());
            $stmt->bindValue(6, $a->getTipo());
            $stmt->bindValue(7, $a->getLink());
            $stmt->bindValue(8, $a->getEndereco());
            $stmt->bindValue(9, $a->getObservacoes());
            $stmt->bindValue(10, $a->getId());
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
