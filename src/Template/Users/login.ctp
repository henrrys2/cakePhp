<?= $this->Html->css('login');?>

<div class="wrapper fadeInDown">
  <div id="formContent">
   
    <div class="fadeIn first">
      
      <h1>Login</h1>
    </div>
    <?= $this->Form->create('login');?>
    
        <?= $this->Form->input('username',['class'=>'form-control fadeIn second','name'=>'email']) ?>
        <?= $this->Form->input('password',['class'=>'form-control fadeIn third','name'=>'password']) ?>
        <?= $this->Form->button('Sign in',['class'=>'fadeIn fourth']) ?>
    <?= $this->Form->end() ?>

    
    <div id="formFooter">
        <?= $this->Html->link('Sign up',['controller'=>'Users','action'=> 'add'],['class'=> 'underlineHover']) ?>
      
    </div>

  </div>
</div>
