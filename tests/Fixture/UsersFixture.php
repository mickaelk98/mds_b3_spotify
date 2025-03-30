<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'picture' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-25 08:27:40',
                'modified' => '2025-03-25 08:27:40',
            ],
        ];
        parent::init();
    }
}
