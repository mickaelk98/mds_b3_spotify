<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateRequests extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('requests');
        $table
            ->addColumn('request_type', 'enum', [
                'values' => ['artist', 'album'],
                'null' => false
            ])
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('user_id', 'integer', [
                'null' => false
            ])
            ->addColumn('status', 'enum', [
                'values' => ['en cours', 'accepté', 'refusé'],
                'default' => 'en cours',
                'limit' => 50
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->create();
    }
}
