<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArtistsFixture
 */
class ArtistsFixture extends TestFixture
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
                'bio' => 'Lorem ipsum dolor sit amet',
                'picture' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-25 08:27:41',
                'modified' => '2025-03-25 08:27:41',
            ],
        ];
        parent::init();
    }
}
