<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
