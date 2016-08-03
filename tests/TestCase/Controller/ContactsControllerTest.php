<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ContactsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ContactsController Test Case
 */
class ContactsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.contacts',
        'app.groups',
        'app.contacts_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '1',
                    'email' => 'peti@gmail.com',
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
        $this->get('/contacts');
        $this->assertResponseOk();

        $this->get('/contacts/index');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/contacts/view/1');
        $this->assertResponseOk();

        $this->get('/contacts/view/2');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('/contacts/add');
        $this->assertResponseOk();

        $data = [
            'name' => 'Petikeaddoltspanja',
            'email' => 'addoltspan@gmail.com',
        ];

        $this->post('/contacts/add', $data);
        $this->assertResponseCode('302');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/contacts/edit/1');
        $this->assertResponseOk();

        $data = [
            'name' => 'Módosított Benjamin'
        ];
        $this->post('/contacts/edit/1', $data);
        $this->assertResponseCode('302');

    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->post('/contacts/delete/1');
        $this->assertResponseCode(302);

        $this->post('/contacts/delete/2');
        $this->assertResponseCode(302);
    }
}
