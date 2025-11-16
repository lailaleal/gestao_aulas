<?php

require_once "Conexao.php";
require_once "Usuario.php";

class UsuarioModel
{

    private $tabela = "Usuarios";

    public function create(Usuarios $u)
    {
        try {
            // Cria string SQL
            $sql = "insert into $this->tabela 
                    (nome, email, senha, tipo) 
                    values (?,?,?,?)"; // O Xampp já aplica MD5 na senha, não é necessário aplicar novamente
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $u->getNome());
            $stmt->bindValue(2, $u->getEmail());
            $stmt->bindValue(3, $u->getSenha()); 
            $stmt->bindValue(4, $u->getTipo()); 

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

    public function read()
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarios');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findId($id)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where id=?");
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarios');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findEmail($email)
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela where email=?");
        $stmt->bindValue(1, $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarios');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update(Usuarios $u)
    {
        try {
            // Cria string SQL
            $sql = "update $this->tabela set nome=?, email=? where id=?";
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $u->getNome());
            $stmt->bindValue(2, $u->getEmail());
            $stmt->bindValue(3, $u->getId());
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

    // Verificar se a senha informada pelo usuário é válida para permitir a troca da senha
    /*public function updatePass(Usuario $u)
    {
        try {
            // Verificar se a senha informada pelo usuário é válida para permitir a troca da senha

            // Cria string SQL
            $sql = "update $this->tabela set senha=? where id=?"; 
            // Prepara conexão com banco de dados
            $stmt = Conexao::getConn()->prepare($sql);
            // Insere dados na consulta
            $stmt->bindValue(1, $u->getSenha());
            $stmt->bindValue(2, $u->getId());
            // Executa código SQL no banco de dados
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }*/

    public function login(Usuarios $user) 
    {
        $stmt = Conexao::getConn()->prepare("select * from $this->tabela 
            where email=? and senha=?"); 
        $stmt->bindValue(1, $user->getEmail());
        $stmt->bindValue(2, $user->getSenha());
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarios');
        $stmt->execute();
        return $stmt->fetch();
    }
}
