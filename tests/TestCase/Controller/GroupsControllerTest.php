<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GroupsController Test Case
 */
class GroupsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.groups',
        'app.users',
        'app.contacts',
        'app.contacts_groups'
    ];

    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '1',
                    'email' => 'peti@gmail.com',
                    'name' => 'Petike'
                ]
            ]
        ]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/groups');
        $this->assertResponseOk();

        $this->get('/groups/index');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/groups/view/1');
        $this->assertResponseOk();

        $this->get('/groups/view/3');
        $this->assertRedirect();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('/groups/add');
        $this->assertResponseOk();

        $data = [
            'name' => 'csoportd',
        ];
        $this->post('/groups/add', $data);
        $this->assertRedirect();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/groups/edit/1');
        $this->assertResponseOk();

        $data = [
            'name' => 'csoport_rename'
        ];

        $this->post('/groups/edit/1', $data);
        $this->assertRedirect();
    }

    /**
     * Test edit method without any parameter
     *
     * @return void
     */
    public function testEditWithoutParams()
    {
        $this->get('/groups/edit');
        $this->assertRedirect();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->post('/groups/delete/1');
        $this->assertRedirect();

        $this->post('/groups/delete/4');
        $this->assertResponseCode('404');
    }
}
