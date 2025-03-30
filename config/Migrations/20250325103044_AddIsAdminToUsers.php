<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddIsAdminToUsers extends BaseMigration
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
        $table = $this->table('users');
        $table->addColumn('isAdmin', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }
}
