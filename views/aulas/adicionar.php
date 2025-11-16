<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

require_once "../../controllers/ProfessoresController.php";
require_once "../../controllers/HorariosProfessoresController.php";

$ProfessoresController = new ProfessoresController();
$professores = $ProfessoresController->read();

$horariosProfessoresController = new HorariosProfessoresController();
$horarios = $horariosProfessoresController->read();

$horariosArray = array_map(function($h) {
  return [
    'id' => $h->getId(),
    'id_professor' => $h->getIdProfessor(),
    'data' => $h->getData(),
    'hora_inicio' => $h->getHoraInicio(),
    'hora_fim' => $h->getHoraFim()
  ];
}, $horarios);

json_encode($horariosArray);

if(isset($_POST) && count($_POST) > 0) {

    require_once "../../controllers/AulasController.php";

    $obj = new Aulas();

    $obj->setIdProfessor(htmlspecialchars($_POST['campo-id_professor']));
    $obj->setData(htmlspecialchars($_POST['campo-data']));
    $obj->setHoraInicio(htmlspecialchars($_POST['campo-hora_inicio']));
    $obj->setHoraFim(htmlspecialchars($_POST['campo-hora_fim']));
    $obj->setTipo(htmlspecialchars($_POST['campo-tipo']));
    $obj->setLink(htmlspecialchars($_POST['campo-link']));
    $obj->setEndereco(htmlspecialchars($_POST['campo-endereco']));
    $obj->setObservacoes(htmlspecialchars($_POST['campo-observacoes']));

    $AulasController = new AulasController();

    $rs = $AulasController->add($obj);

    if($rs) {
        header("location: index.php");
    }
}

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/adminlte.css" />
    <title>Gestão de aulas | Aulas</title>
    <?php include '../includes/head.php'; ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <?php include '../includes/barra-superior.php'; ?>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <?php include '../includes/menu-lateral.php'; ?>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Aulas</h3>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title">Adicionar</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Form-->
                                <form action="" method="post">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3">
                                          <label for="campo-id_professor" class="form-label">Professor</label>
                                          <select class="form-select w-100" id="campo-id_professor" name="campo-id_professor">
                                            <option value="">Selecione um professor</option>
                                            <?php foreach ($professores as $prof): ?>
                                              <option value="<?= htmlspecialchars($prof->getId()) ?>">
                                                <?= htmlspecialchars($prof->getNome() . ' - ' . $prof->getEspecialidade()) ?>
                                              </option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="campo-horario" class="form-label">Horários Disponíveis</label>
                                          <select class="form-select w-100" id="campo-horario" name="campo-horario">
                                            <option value="">Selecione um horário</option>
                                          </select>
                                        </div>
                                        <input type="date" class="form-control" id="data"
                                            name="campo-data" hidden/>
                                        <input type="time" class="form-control" id="hora_inicio"
                                            name="campo-hora_inicio" hidden/>
                                        <input type="time" class="form-control" id="hora_fim"
                                            name="campo-hora_fim" hidden/>
                                        <div class="mb-3">
                                            <label for="tipo" class="form-label">Tipo de Aula</label>
                                            <select class="form-select" id="tipo" name="campo-tipo">
                                                <option value="presencial">Presencial</option>
                                                <option value="online">Online</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link da Aula (se online)</label>
                                            <input type="url" class="form-control" id="link"
                                                name="campo-link" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="endereco" class="form-label">Endereço da Aula (se presencial)</label>
                                            <input type="text" class="form-control" id="endereco"
                                                name="campo-endereco" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="observacoes" class="form-label">Observações</label>
                                            <textarea name="campo-observacoes" class="form-control" id="observacoes"></textarea>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Gravar</button>
                                    </div>
                                    <!--end::Footer-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <?php include '../includes/rodape.php'; ?>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <?php include '../includes/js.php'; ?>

</body>
<!--end::Body-->

<script>
  const horarios = <?= json_encode($horariosArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;

  const selectProfessor = document.getElementById('campo-id_professor');
  const selectHorario = document.getElementById('campo-horario');

  selectProfessor.addEventListener('change', async function() {
    const idProfessor = this.value;

    // limpa a lista de horários
    selectHorario.innerHTML = '<option value="">Selecione um horário</option>';

    if (!idProfessor) return;

    const horariosFiltrados = horarios.filter(h => h.id_professor == idProfessor);

    if (horariosFiltrados.length === 0) {
      selectHorario.innerHTML = '<option value="">Nenhum horário disponível</option>';
      return;
    }

    horariosFiltrados.forEach(h => {
      const data = new Date(h.data).toLocaleDateString('pt-BR');
      const texto = `${data} — ${h.hora_inicio} às ${h.hora_fim}`;
      const option = document.createElement('option');
      option.value = h.id;
      option.textContent = texto;
      selectHorario.appendChild(option);
    });

    selectHorario.disabled = false;
  });

  selectHorario.addEventListener('change', function() {
    const idHorario = this.value;

    console.log(this.value);

    // procura o horário correspondente no array 'horarios'
    const horarioSelecionado = horarios.find(h => h.id == idHorario);

    console.log(horarioSelecionado);
    console.log(JSON.stringify(horarioSelecionado));

    if (horarioSelecionado) {
      document.getElementById('data').value = horarioSelecionado.data;
      document.getElementById('hora_inicio').value = horarioSelecionado.hora_inicio;
      document.getElementById('hora_fim').value = horarioSelecionado.hora_fim;
    }
  });
</script>

</html>
