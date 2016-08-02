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
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/users/view/1');
        $this->assertResponseOk();

        $this->get('/users/view/2');
        $this->assertResponseError();
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
        $this->assertResponseOk();
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
            'name' => 'Peti jancsi lett'
        ];

        $this->post('/users/edit/1', $data);
        $this->assertResponseOk();

        $this->get('/users/edit/2');
        $this->assertResponseError();

        $data = [
            'name' => 'Peti jancsi lett'
        ];

        $this->post('/users/edit/2', $data);
        $this->assertResponseError();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->get('/users/delete/1');
        $this->assertResponseError();

        $this->post('/users/delete/1');
        $this->assertResponseOk();

        $this->post('/users/delete/2');
        $this->assertResponseError();
    }
}
