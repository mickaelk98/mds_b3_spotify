<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Album'), ['action' => 'edit', $album->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Album'), ['action' => 'delete', $album->id], ['confirm' => __('Are you sure you want to delete # {0}?', $album->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Album'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="albums view content">
            <h3><?= h($album->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($album->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cover') ?></th>
                    <td><?= h($album->cover) ?></td>
                </tr>
                <tr>
                    <th><?= __('Artist') ?></th>
                    <td><?= $album->hasValue('artist') ? $this->Html->link($album->artist->bio, ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($album->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($album->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($album->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related User Album') ?></h4>
                <?php if (!empty($album->user_album)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Album Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($album->user_album as $userAlbum) : ?>
                        <tr>
                            <td><?= h($userAlbum->id) ?></td>
                            <td><?= h($userAlbum->user_id) ?></td>
                            <td><?= h($userAlbum->album_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserAlbum', 'action' => 'view', $userAlbum->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserAlbum', 'action' => 'edit', $userAlbum->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'UserAlbum', 'action' => 'delete', $userAlbum->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $userAlbum->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>