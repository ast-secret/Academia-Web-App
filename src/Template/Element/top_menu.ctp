<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= $this->Html->link(ucwords(str_replace('-', ' ', $this->request->params['gym_slug'])), [], [
                'class' => 'navbar-brand'
            ]) ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">




                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menuItems as $item): ?>
                            <li class="<?= ($this->request->controller == $item['controller']) ? 'active' : '' ?>">
                                <?= $this->Html->link($item['label'], ['controller' => $item['controller'], 'action' => $item['action']]) ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $loggedinUser['short_name'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li role="presentation" class="dropdown-header">
                            <?= $loggedinUser['username'] ?>
                        </li>
                        <li role="presentation">
                            <?= $this->Html->link('Configurações de conta', [
                                'controller' => 'Users',
                                'action' => 'mySettings'
                            ])
                            ?>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation">
                            <!-- <a role="menuitem" tabindex="-1" href="#">Sair</a> -->
                            <?= $this->Html->link('Sair', ['controller' => 'Users', 'action' => 'logout']) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>