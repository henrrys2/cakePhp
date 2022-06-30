
<div class="container">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('password',['required' => false]);
            echo $this->Form->control('role', [
                'type' => 'select',
                'options' => $arrayRoles,
                'default' => $user->role,
                'class' => 'form-control']);
            echo $this->Form->control('active',['type' => 'checkbox','required'=>'','checked'=> $user['active'] == 1 ? 'checked' : '']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Edit'),['class' => 'btn btn-success']) ?>
    <?= $this->Html->link('Back',['controller' => 'Users','action' =>isset($current_user) ? 'index':'login'],['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
