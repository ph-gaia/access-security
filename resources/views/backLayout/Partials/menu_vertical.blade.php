<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <form action="/admin/users" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text"
                       id="users"
                       name="users"
                       class="form-control"
                       placeholder="Encotre um usuário">
                <span class="input-group-btn">
                    <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Secretaria de Estado de Educação</li>
            <li><a href="/admin/dashboard"><i class="fa fa-bank"></i> <span>Home</span></a></li>
            <li><a href="/admin/users"><i class="fa fa-user"></i> <span>Usuários</span></a></li>
            <li><a href="/admin/groupaccess"><i class="fa fa-users"></i> <span>Grupo de acesso</span></a></li>
            <li><a href="/admin/module"><i class="fa fa-cubes"></i> <span>Módulos</span></a></li>
            <li><a href="/admin/permission"><i class="fa fa-key"></i> <span>Permissões</span></a></li>
            <li><a href="/admin/application"><i class="fa fa-rocket"></i> <span>Aplicações</span></a></li>
            <li class="header">SEDUC</li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>