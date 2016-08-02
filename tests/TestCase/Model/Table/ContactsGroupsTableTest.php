<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactsGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsGroupsTable Test Case
 */
class ContactsGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactsGroupsTable
     */
    public $ContactsGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contacts_groups',
        'app.groups',
        'app.users',
        'app.contacts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContactsGroups') ? [] : ['className' => 'App\Model\Table\ContactsGroupsTable'];
        $this->ContactsGroups = TableRegistry::get('ContactsGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactsGroups);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
