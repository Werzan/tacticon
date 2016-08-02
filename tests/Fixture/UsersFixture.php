<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'email' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Petike',
                'email' => 'peti@gmail.com',
                'password' => (new DefaultPasswordHasher)->hash('qwert'),
            ],
            [
                'id' => 2,
                'name' => 'Juliska',
                'email' => 'juli@gmail.com',
                'password' => (new DefaultPasswordHasher)->hash('abcde'),
            ],
            [
                'id' => 3,
                'name' => 'Géza',
                'email' => 'geza@freemail.hu',
                'password' => (new DefaultPasswordHasher)->hash('abcde'),
            ],
        ];
        parent::init();
    }
}
