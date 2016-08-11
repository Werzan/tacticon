<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?> </li>

    </ul>
</nav>
<div class="groups view large-9 medium-8 columns content">
    <h3><?= h($group->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $group->has('user') ? $this->Html->link($group->user->name, ['controller' => 'Users', 'action' => 'view', $group->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($group->id) ?></td>
        </tr>
    </table>
    <div class="related">


        <h4><?= __('Related Contacts') ?></h4>
        <?php if (!empty($group->contacts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
            <!--    <th><?= __('Id') ?></th> -->
                <th><?= __('Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Tel') ?></th>
            <!--    <th><?= __('User Id') ?></th> -->
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($group->contacts as $contacts): ?>
            <tr>
            <!--    <td><?= h($contacts->id) ?></td> -->
                <td><?= h($contacts->name) ?></td>
                <td><?= h($contacts->email) ?></td>
                <td><?= h($contacts->tel) ?></td>
            <!--    <td><?= h($contacts->user_id) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
