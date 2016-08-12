<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
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
        $this->get('/users');
        $this->assertResponseOk();

        $this->get('/users/index');
        $this->assertResponseOk();
    }

    /**
     * Test index method with Ajax
     *
     * @return void
     */
    public function testIndexAjax()
    {
        // Test json
        $this->get('/users.json');
        $this->assertResponseOk();
        $this->assertHeaderContains('Content-Type', 'application/json');
        $this->assertContentType('application/json');
        $this->assertJson($this->_response->body());
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/users/view/1');
        $this->assertResponseOk();

        $this->get('/users/view/2');
        $this->assertRedirect();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('/users/add');
        $this->assertResponseOk();

        $data = [
            'name' => 'random újgyerek',
            'email' => 'ujonc@gmail.com',
            'password' => 'trololo',
        ];

        $this->post('/users/add', $data);
        $this->assertRedirect();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/users/edit/1');
        $this->assertResponseOk();

        $data = [
            'name' => 'Peti jancsi lett',
        ];

        $this->post('/users/edit/1', $data);
        $this->assertRedirect();

        $this->get('/users/edit/2');
        $this->assertRedirect();

        $data = [
            'name' => 'Peti jancsi lett'
        ];

        $this->post('/users/edit/2', $data);
        $this->assertRedirect();
    }

    /**
     * Test edit method without any parameter
     *
     * @return void
     */
    public function testEditWithoutParams()
    {
        $this->get('/users/edit');
        $this->assertRedirect();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->post('/users/delete/1');
        $this->assertRedirect();

        $this->post('/users/delete/2');
        $this->assertRedirect();
    }

    public function testSearch()
    {
        $this->post('/users', ['search' => 'i']);
        $this->assertResponseOk();
        $this->assertResponseContains('Petike');
        $this->assertResponseContains('Juliska');
        $this->assertResponseNotContains('Géza');

        $this->post('/users.json', ['search' => 'i']);
        $this->assertResponseOk();
        $this->assertHeaderContains('Content-Type', 'application/json');
        $this->assertContentType('application/json');
        $this->assertJson($this->_response->body());
        $this->assertResponseContains('Petike');
        $this->assertResponseContains('Juliska');
        $this->assertResponseNotContains('Géza');
    }
}
