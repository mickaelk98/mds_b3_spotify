<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ModifyAlbums extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('albums');

        // Supprimer la colonne inutile album_id
        $table->removeColumn('album_id');

        // Ajouter une contrainte de clé étrangère pour artist_id
        $table->addForeignKey('artist_id', 'artists', 'id', [
            'delete'=> 'CASCADE',
            'update'=> 'NO_ACTION',
        ]);

        $table->update();
    }
}
