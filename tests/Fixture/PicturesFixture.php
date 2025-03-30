<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PicturesFixture
 */
class PicturesFixture extends TestFixture
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
                'file' => 'Lorem ipsum dolor sit amet',
                'owner_id' => 1,
                'created' => '2025-03-25 08:27:44',
                'modified' => '2025-03-25 08:27:44',
            ],
        ];
        parent::init();
    }
}
