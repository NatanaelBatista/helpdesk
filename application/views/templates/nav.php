
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div style="background-color: #eee; padding: 2px 4px; margin-right: 5px; border-radius: 3px;"><img style="width: 30px;" src="<?php echo base_url(); ?>assets/img/television-2-2.png"></div>
    <a class="navbar-brand" href="<?php echo base_url(); ?>home" style="text-shadow: 1px 1px 1px #000;">HelpDesk [nome]</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link">
            <span class="nav-link-text" style="font-size: 10pt;"><?php echo $_SESSION['usuario_email']; ?></span>
          </a>
        </li>

        <!-- Incidente -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url(); ?>incidente">
            <span class="nav-link-text"><i class="fa fa-tasks"></i> Incidentes</span>
          </a>
        </li>
        
        <!-- Gerencial -->
        <li class="nav-item gerencial" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <span class="nav-link-text"><i class="fa fa-cogs"></i> Gerencial</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#pessoa"><i class="fa fa-user"></i> Pessoa</a>
              <ul class="sidenav-third-level collapse" id="pessoa">
                <li>
                  <a href="<?php echo base_url(); ?>pessoa">Pessoas</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>setor">Setores</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>cargo">Cargos</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>empresa">Empresas</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#incidente"><i class="fa fa-tasks"></i> Incidente</a>
              <ul class="sidenav-third-level collapse" id="incidente">
                <li>
                  <a href="<?php echo base_url(); ?>categoria">Categorias</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>prioridade">Prioridade</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>situacao">Situação</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#geral"><i class="fa fa-globe"></i> Geral</a>
              <ul class="sidenav-third-level collapse" id="geral">
                <li>
                  <a href="<?php echo base_url(); ?>links_uteis/listar">Links úteis</a>
                  <a href="<?php echo base_url(); ?>perguntas_frequentes/listar">Perguntas Frequentes</a>
                  <a href="<?php echo base_url(); ?>download/listar">Downloads</a>
                </li>
              </ul>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#logs"><i class="fa fa-book"></i> Logs</a>
              <ul class="sidenav-third-level collapse" id="logs">
                <li>
                  <a href="<?php echo base_url(); ?>log/auditoria">Log de Auditoria</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>log/importar">Log Microwork Cloud</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#usuario"><i class="fa fa-user-circle"></i> Usuario</a>
              <ul class="sidenav-third-level collapse" id="usuario">
                <li>
                  <a href="<?php echo base_url(); ?>usuario">Usuarios</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        <!-- Desenvolvedor -->
        <li class="nav-item desenvolvedor" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#desenvolvedor" data-parent="#exampleAccordion">
            <span class="nav-link-text"><i class="fa fa-file-code-o"></i> Desenvolvedor</span>
          </a>
          <ul class="sidenav-second-level collapse" id="desenvolvedor">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#acesso"><i class="fa fa-user"></i> Acesso</a>
              <ul class="sidenav-third-level collapse" id="acesso">
                <li>
                  <a href="<?php echo base_url(); ?>grupo_modulo">Grupo de Módulo</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>modulo">Módulo</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>acao">Ação</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#email"><i class="fa fa-tasks"></i> E-mail</a>
              <ul class="sidenav-third-level collapse" id="email">
                <li>
                  <a href="<?php echo base_url(); ?>categoria">Envio automático</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#sistema"><i class="fa fa-sitemap"></i> Sistema</a>
              <ul class="sidenav-third-level collapse" id="sistema">
                <li>
                  <a href="<?php echo base_url(); ?>links_uteis/listar">Parâmetros</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        
        <!-- Relatórios -->
        <li class="nav-item relatorio" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#relatorio" data-parent="#exampleAccordion">
            <span class="nav-link-text"><i class="fa">&#xf201;</i> Relatórios</span>
          </a>
          <ul class="sidenav-second-level collapse" id="relatorio">
            <li>
              <a href="<?php echo base_url(); ?>visita">
                <span class="nav-link-text"> Visitas a Filiais</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>recarga">
                <span class="nav-link-text"> Recarga de Impressora</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- Gestão -->
        <li class="nav-item desenvolvedor" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#gestao" data-parent="#exampleAccordion">
            <span class="nav-link-text"><i class="fa fa-pie-chart"></i> Gestão</span>
          </a>
          <ul class="sidenav-second-level collapse" id="gestao">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#equipamentos"> Equipamentos</a>
              <ul class="sidenav-third-level collapse" id="equipamentos">
                <li>
                  <a href="<?php echo base_url(); ?>item">Itens</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>tipo_item">Tipo de item</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>impressora">Impressoras</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        <!-- Configurações -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#configuracao" data-parent="#exampleAccordion">
            <span class="nav-link-text"><i class="fa fa-cog"></i> Configurações</span>
          </a>
          <ul class="sidenav-second-level collapse" id="configuracao">
            <li>
              <a href="<?php echo base_url(); ?>configuracao/alterar_senha">
                <span class="nav-link-text"><i class="fa fa-unlock-alt"></i> Alterar Senha</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- Perguntas Frequentes -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url(); ?>perguntas_frequentes">
            <span class="nav-link-text"><i class="fa fa-wpforms"></i> Perguntas frequentes</span>
          </a>
        </li>

        <!-- Links úteis -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url(); ?>links_uteis">
            <span class="nav-link-text"><i class="fa fa-external-link"></i> Links úteis</span>
          </a>
        </li>

        <!-- Downloads -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url(); ?>download">
            <span class="nav-link-text"><i class="fa fa-cloud-download"></i> Downloads</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Incidente</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for..." disabled>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" disabled>
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid conteudo">