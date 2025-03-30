<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RequestsFixture
 */
class RequestsFixture extends TestFixture
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
                'request_type' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-25 11:16:10',
                'modified' => '2025-03-25 11:16:10',
            ],
        ];
        parent::init();
    }
}
