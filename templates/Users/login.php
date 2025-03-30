<h2>Connexion</h2>
<?= $this->Form->create()?>

<?= $this->Form->control('name')?>
<?= $this->Form->control('password', ['type' => 'password'])?>

<?= $this->Form->button('Se connecter')?>
<?= $this->Form->end() ?>

<?= $this->Html->link('Vous n\'avez pas de compte ? Inscription', 
    ['controller' => 'Users', 'action' => 'add'], 
    ['class' => 'text-blue-500 hover:underline']) ?>