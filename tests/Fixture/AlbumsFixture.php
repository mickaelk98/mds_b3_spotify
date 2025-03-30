<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFixture
 */
class AlbumsFixture extends TestFixture
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
                'cover' => 'Lorem ipsum dolor sit amet',
                'artist_id' => 1,
                'created' => '2025-03-25 08:50:11',
                'modified' => '2025-03-25 08:50:11',
            ],
        ];
        parent::init();
    }
}
