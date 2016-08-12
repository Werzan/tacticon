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
            'tel' => '',
        ];

        $this->post('/contacts/add', $data);
        $this->assertRedirect();
    }

    /**
     * Test Adding a contact with bad data
     *
     * @return void
     */
    public function testAddWithBadData()
    {
        $this->post('/contacts/add', [
            'email' => 'aaa'
        ]);

        $this->assertResponseContains("could not be saved");
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
            'name' => 'Módosított Benjamin',
        ];
        $this->post('/contacts/edit/1', $data);
        $this->assertRedirect();
    }

    /**
     * Test Editing with bad data
     *
     * @return void
     */
    public function testEditWithBadData()
    {
        $this->post('/contacts/edit/1', [
            'email' => 'aaa'
        ]);

        $this->assertResponseContains("could not be saved");
    }

    /**
     * Test Editing Contact without params
     *
     * @return void
     */
    public function testEditWithoutParams()
    {
        $this->get('/contacts/edit');
        $this->assertRedirect();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->post('/contacts/delete/1');
        $this->assertRedirect();
    }

    public function testSearch()
    {
        $this->post('/contacts', ['search' => 'Béla']);
        $this->assertResponseOk();
        $this->assertResponseContains('Kiss');
        $this->assertResponseNotContains('Lakatos');

        $this->post('/contacts.json', ['search' => 'Béla']);
        $this->assertResponseOk();
        $this->assertHeaderContains('Content-Type', 'application/json');
        $this->assertContentType('application/json');
        $this->assertJson($this->_response->body());
        $this->assertResponseContains('Kiss');
        $this->assertResponseNotContains('Lakatos');
    }
}
