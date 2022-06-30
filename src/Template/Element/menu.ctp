<nav class="navbar navbar-light bg-light" data-topbar role="navigation">
    <ul class=" large-3 medium-4 columns">
        <li class="name">
            <h5>Backend CMS</h5>
        </li>
        
    </ul>
    <?php if($current_user):?>
    <ul class="large-1 medium-4 columns">
    
        <div class="dropdown show">
           
            <?= $this->Form->button('Actions',['class' => 'btn btn-secondary dropdown-toggle',
            'type'=>'buttton','id'=>'dropdownMenuButton','data-toggle'=>'dropdown','aria-haspopup' => 'true','aria-expanded' => 'false']) ?>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if($current_user['role'] ==1): ?>
                <?= $this->Html->link('Add user',['controller' => 'Users','action' => 'add'],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link('Profile',['controller' => 'Users','action' => 'view',$current_user['id']],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link('Edit Profile',['controller' => 'Users','action' => 'edit',$current_user['id']],['class'=>'dropdown-item']) ?>
                <?php endif; ?>
                <?= $this->Html->link('List Users',['controller' => 'Users','action' => 'index',],['class'=>'dropdown-item']) ?>
                <?= $this->Html->link('Logout',['controller' => 'Users','action' => 'logout',],['class'=>'dropdown-item']) ?>
            </div>
        </div>
    </ul>
    <?php endif; ?> 
</nav>