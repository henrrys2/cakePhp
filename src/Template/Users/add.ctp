

<div class="container">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('New User') ?></legend>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
