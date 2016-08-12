<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsGroupsFixture
 *
 */
class ContactsGroupsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'group_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'contact_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'contact_id' => ['type' => 'index', 'columns' => ['contact_id'], 'length' => []],
            'group_id' => ['type' => 'index', 'columns' => ['group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['group_id', 'contact_id'], 'length' => []],
            'contacts_groups_ibfk_1' => ['type' => 'foreign', 'columns' => ['contact_id'], 'references' => ['contacts', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'contacts_groups_ibfk_2' => ['type' => 'foreign', 'columns' => ['group_id'], 'references' => ['groups', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'MEMORY',
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
            'group_id' => 1,
            'contact_id' => 1
        ],
        [
            'group_id' => 1,
            'contact_id' => 2
        ],
        [
            'group_id' => 1,
            'contact_id' => 3
        ],
        [
            'group_id' => 2,
            'contact_id' => 1
        ],
        [
            'group_id' => 3,
            'contact_id' => 4
        ],
        [
            'group_id' => 3,
            'contact_id' => 5
        ],
        [
            'group_id' => 3,
            'contact_id' => 6
        ],
    ];
}
