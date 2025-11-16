<?php

require_once "Conexao.php";
require_once "Notificacoes.php";

class NotificacoesModel
{
    private $tabela = "Notificacoes";

    // Cria uma notificação
    public function create(Notificacoes $n)
    {
        try {
            $sql = "INSERT INTO $this->tabela (id_usuario, tipo, mensagem, lida, data_criacao) VALUES (?, ?, ?, ?, ?)";
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $n->getIdUsuario());
            $stmt->bindValue(2, $n->getTipo());
            $stmt->bindValue(3, $n->getMensagem());
            $stmt->bindValue(4, $n->getLida());
            $stmt->bindValue(5, $n->getDataCriacao());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function read()
    {
        $stmt = Conexao::getConn()->prepare("SELECT * FROM $this->tabela ORDER BY data_criacao DESC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Notificacoes');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findId($id)
    {
        $stmt = Conexao::getConn()->prepare("SELECT * FROM $this->tabela WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Notificacoes');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update(Notificacoes $n)
    {
        try {
            $sql = "UPDATE $this->tabela SET id_professor=?, id_aluno=?, tipo=?, mensagem=?, lida=?, data_criacao=? WHERE id=?";
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $n->getIdProfessor());
            $stmt->bindValue(2, $n->getIdAluno());
            $stmt->bindValue(3, $n->getTipo());
            $stmt->bindValue(4, $n->getMensagem());
            $stmt->bindValue(5, $n->getLida());
            $stmt->bindValue(6, $n->getDataCriacao());
            $stmt->bindValue(7, $n->getId());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM $this->tabela WHERE id = ?";
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            echo " Número: " . (int)$e->getCode();
        }
    }

    public function listarNaoLidas($id_usuario)
    {
        $stmt = Conexao::getConn()->prepare("
            SELECT * FROM $this->tabela
            WHERE id_usuario = ? AND lida = 0
            ORDER BY data_criacao DESC
        ");
        $stmt->bindValue(1, $id_usuario);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Notificacoes');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function marcarComoLida($id)
    {
        $stmt = Conexao::getConn()->prepare("
            UPDATE $this->tabela SET lida = 1 WHERE id = ?
        ");
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function notificaAulaoEnem($idEscola, $usuariosAlunosEnem) {
        foreach ($usuariosAlunosEnem as $usuarioAlunoEnem) {
            $this->notificaParticipacaoEnem($usuarioAlunoEnem->getId());
        }

        $usuariosProfessoresEnem = $this->getProfessoresEnem($idEscola);
        foreach ($usuariosProfessoresEnem as $usuarioProfessorEnem) {
            $this->notificaParticipacaoEnem($usuarioProfessorEnem->getId());
        }

        $usuarioEsc = $this->getUsuarioEscolaEnem($idEscola);
        $this->notificaParticipacaoEnem($usuarioEsc->getId());
    }

    private function notificaParticipacaoEnem($usuarioId) {
        $notificacao = new Notificacoes();
        $notificacao->setIdUsuario($usuarioId);
        $notificacao->setTipo("aulao_enem");
        $notificacao->setMensagem("Parabéns! Sua escola agora está participando do Aulão do ENEM");
        $notificacao->setDataCriacao(date('Y-m-d H:i:s'));
        $notificacao->setLida(0);

        $this->create($notificacao);
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

    private function getProfessoresEnem($idEscola) {
        $stmt = Conexao::getConn()->prepare("select u.id
                  from Professores a
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

    public function getUsuarioEscolaEnem($idEscola)
    {
        $stmt = Conexao::getConn()->prepare("
            select u.id
            from Escolas e
            inner join Usuarios u on e.email = u.email
            where e.interesse_aulao_enem = 1
              and e.id = ?
        ");
        $stmt->bindValue(1, $idEscola);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarios');
        $stmt->execute();
        return $stmt->fetch();
    }
}
