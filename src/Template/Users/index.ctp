
    <?= $this->Form->create('search',['controller' => 'Users','action' =>'index']); ?>
    <div class="input-group ">
        <?= $this->Form->input('search',['class' => 'form-control rounded','placeholder' => 'Search','aria-label'=>"Search",'aria-describedby'=>"search-addon",'label'=> false]) ?>
    
        <?= $this->Form->button('Search',['class' => 'btn btn-sm btn-outline-primary']) ?>
    </div>
    <?= $this->Form->end(); ?>
    
    
    <h3><?= $current_user['name'] ?></h3>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>         
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?=  $this->Number->format($user->role) == 1  ?  'Admin' : 'User' ?></td>
                <td><?= $this->Number->format($user->active) == 1 ? 'Yes':'No' ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id],['class' => 'btn btn-sm btn-primary']) ?>
                    <?php if($current_user['role'] == 1): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['class'=> 'btn btn-sm btn-success']) ?>
                        <?= $this->Html->Link(_('Delete'), ['action' => 'delete', $user->id],['confirm' => 'Delete User?','class'=> 'btn btn-sm btn-danger']) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
