<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?></li>

    </ul>
</nav>
<div class="contacts index large-9 medium-8 columns content">
    <h3><?= __('Contacts') ?></h3>

    <?= $this->Form->create(); ?>
    <?= $this->Form->input('search'); ?>
    <?= $this->Form->button(__("Search")); ?>
    <?= $this->Form->end(); ?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
            <!--    <th><?= $this->Paginator->sort('id') ?></th> -->
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('tel') ?></th>
            <!--    <th><?= $this->Paginator->sort('user_id') ?></th> -->
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>

            <!-- <td><?= $this->Number->format($contact->id) ?></td> -->

                <td><?= h($contact->name) ?></td>
                <td><?= h($contact->email) ?></td>
                <td><?= h($contact->tel) ?></td>
             <!--   <td><?= $contact->has('user') ? $this->Html->link($contact->user->name, ['controller' => 'Users', 'action' => 'view', $contact->user->id]) : '' ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contact->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id]) ?>
                    <?= $this->Html->link(__('E-mail'), ['action' => 'email', $contact->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
