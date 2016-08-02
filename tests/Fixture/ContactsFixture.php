<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsFixture
 *
 */
class ContactsFixture extends TestFixture
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
        'email' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tel' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'email' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
            'contacts_ibfk_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Tóth Lajos',
            'email' => 'lajos@gmail.com',
            'tel' => '',
            'user_id' => 1
        ],
        [
            'id' => 2,
            'name' => 'Kiss Béla',
            'email' => 'bela@gmail.com',
            'tel' => '',
            'user_id' => 1
        ],
        [
            'id' => 3,
            'name' => 'Lakatos Nintendó',
            'email' => 'nintendo@gmail.com',
            'tel' => '',
            'user_id' => 1
        ],
        [
            'id' => 4,
            'name' => 'Kolompár Géza',
            'email' => 'kolompar@freemail.hu',
            'tel' => '',
            'user_id' => 2
        ],
        [
            'id' => 5,
            'name' => 'Tóth Arnold',
            'email' => 'arnold@freemail.hu',
            'tel' => '',
            'user_id' => 2
        ],
        [
            'id' => 6,
            'name' => 'Olajos Gizella',
            'email' => 'gizella@freemail.hu',
            'tel' => '',
            'user_id' => 2
        ],
    ];
}
