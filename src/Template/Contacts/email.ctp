<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?></li>

    </ul>
</nav>
<div class="contacts form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('E-mail') ?></legend>
        <?php
        echo $this->Form->input('Name', ['options' => $contacts, 'name' => 'id', 'default' => $id]);
        echo $this->Form->input('Subject');
        echo $this->Form->textarea('Body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Send')) ?>
    <?= $this->Form->end() ?>
</div>