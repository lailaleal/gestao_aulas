<?php

require_once "Conexao.php";
require_once "Alunos.php";
require_once "UsuarioModel.php";
require_once "Usuario.php";
require_once "AulaoEnemModel.php";
//require_once "EscolasModel.php";

// Classe AlunosModel que manipula os dados dos alunos no banco de dados
class AlunosModel
{
    private $tabela = "Alunos";
    private $usuarioModel;
    private $aulaoEnemModel;

    private Alunos $aluno;

    function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->aulaoEnemModel = new AulaoEnemModel();
    }

    public function create(Alunos $a)
    {
        try {
            // Cria string SQL
            $sql = "insert into $this->tabela (nome, email, telefone, serie, senha, interesse_aulao_enem, id_escola) values (?,?,?,?,?,?,?)";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados no SQL
            $stmt->bindValue(1, $a->getNome());
            $stmt->bindValue(2, $a->getEmail());
            $stmt->bindValue(3, $a->getTelefone());
            $stmt->bindValue(4, $a->getSerie());
            $stmt->bindValue(5, $a->getSenha());
            $stmt->bindValue(6, $a->getInteresseAulaoEnem());
            $stmt->bindValue(7, $a->getidEscola());

            // Executa código SQL no banco de dados
            $stmt->execute();

            $stmtId = Conexao::getConn()->prepare("SELECT LAST_INSERT_ID() AS id");
            $stmtId->execute();
            $result = $stmtId->fetch(PDO::FETCH_ASSOC);

            $usuario = new Usuarios();
            $usuario->setNome($a->getNome());
            $usuario->setEmail($a->getEmail());
            $usuario->setSenha($a->getSenha());
            $usuario->setTipo("aluno");
            $usuarioId = $this->usuarioModel->create($usuario);

            if($usuarioId) {
                $usuario->setId($usuarioId);
                $_SESSION[SessionConf::$sessionObj] = serialize($usuario);
            }

            if ($a->getInteresseAulaoEnem()) {
                $a->setId($result['id']);
                $this->aulaoEnemModel->adicionaAlunoEnem($a);
            }

            return $result['id'];
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    // Busca todos os alunos
    public function read()
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Alunos');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Busca um aluno pelo ID
    public function findId($id)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id=?");
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Alunos');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findEmail($email)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where email=?");
        $stmt->bindValue(1, $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Alunos');
        $stmt->execute();
        return $stmt->fetch();
    }

    // Atualizo os dados de um aluno
    public function update(Alunos $a)
    {
        try {
            // Cria string SQL
            $sql = "update $this->tabela set nome=?, email=?, telefone=?, serie=?, interesse_aulao_enem=?, id_escola=? where id=?";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $a->getNome());
            $stmt->bindValue(2, $a->getEmail());
            $stmt->bindValue(3, $a->getTelefone());
            $stmt->bindValue(4, $a->getSerie());
            $stmt->bindValue(5, $a->getId());
            $stmt->bindValue(6, $a->getInteresseAulaoEnem());
            $stmt->bindValue(7, $a->getidEscola());
            // Executa código SQL no banco de dados
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    // Função que deleta um aluno pelo ID
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
