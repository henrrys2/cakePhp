
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="page header">
            <h4>New User</h4>
            <hr>
        </div>
        <?= $this->Form->create($user,['novalidate']) ?>
        <fieldset>
            <?php
                echo $this->Form->control('name');
                echo $this->Form->control('email');
                echo $this->Form->control('password');
                if(isset($current_user)){
                    echo $this->Form->control('role', [
                        'type' => 'select',
                        'options' => $arrayRoles,
                        'class' => 'form-control']);
                    echo $this->Form->control('active',['type' => 'checkbox']);
                }
            ?>
        </fieldset>
        
        <?= $this->Form->button(__('Save'),['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Back',['controller' => 'Users','action' =>isset($current_user) ? 'index':'login'],['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>