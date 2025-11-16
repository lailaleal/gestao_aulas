<?php

require_once('../../vendors/phpThumb/ThumbLib.inc.php');
require_once('../../vendors/FlashMessage/FlashMessage.php');
require_once("../../vendors/Redirect/Redirect.php");

class FileUpload {


    public function __construct(String $campo, String $pasta, int $id, $extensoes, $thumbs)
    {

        $redirect = "../../views/$pasta/";

        if (!file_exists("../../uploads/$pasta/"))
            mkdir("../../uploads/$pasta/", 0777);

        if (!file_exists("../../uploads/$pasta/$id/"))
            mkdir("../../uploads/$pasta/$id/", 0777);

        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = "../../uploads/$pasta/$id/";

        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 10; // 10Mb
        // Array com as extensões permitidas
        $_UP['extensoes'] = $extensoes;

        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES[$campo]['error'] != 0) {
            if ($_FILES[$campo]['error'] == 4) {
                header("Location: $redirect");
                exit;
            } else {
                die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES[$campo]['error']]);
                exit; // Para a execução do script
            }
        }

        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
        // Faz a verificação da extensão do arquivo
        $extensao = strtolower(end(explode('.', $_FILES[$campo]['name'])));

        if (array_search($extensao, $_UP['extensoes']) === false) {
            FlashMessage::setMessage("Extensão de arquivo inválida!", 0);
            Redirect::refresh();
        }

        // Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES[$campo]['size']) {
            FlashMessage::setMessage("Arquivo com tamanho maior que o permitido!", 0);
            Redirect::refresh();
            // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
        } else {

            // Mantém o nome original do arquivo
            $nome_final = str_replace(' ', '_', $_FILES[$campo]['name']);
            
            // Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES[$campo]['tmp_name'], $_UP['pasta'] . $nome_final)) {
                foreach($thumbs as $chave => $valor) {
                    $thumb = PhpThumbFactory::create($_UP['pasta'] . $nome_final);
                    $thumb->adaptiveResize($chave, $valor)->save($_UP['pasta'] . $chave.'-' . $nome_final);
                    unset($thumb);
                }
                $thumb = PhpThumbFactory::create($_UP['pasta'] . $nome_final);
                $thumb->resize(800, 800)->save($_UP['pasta'] . $nome_final);
                return $nome_final;
            } else {
                // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                FlashMessage::setMessage("Não foi possível enviar o arquivo, tente novamente!", 0);
                Redirect::refresh();
            }
        }
    }
}