<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Mailer\Email;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => [
                'Contacts.user_id' => $this->Auth->user('id'),
            ],
            'limit' => 5,
            'order' => [
                'Contacts.name' => 'asc'
            ]
        ];


        $query = $this->Contacts->find();
        if ($this->request->data('search')) {
            $query
                ->where([
                    'Contacts.name LIKE' => "%" . $this->request->data('search') . "%"
                ]);
        }
        $contacts = $this->paginate($query);

        $this->set(compact('contacts'));
        $this->set('_serialize', ['contacts']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Users', 'Groups']
        ]);

        $this->set('contact', $contact);
        $this->set('_serialize', ['contact']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            $contact->user_id = $this->Auth->user('id');

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $groups = $this->Contacts->Groups->find('list', ['limit' => 200])->where(['user_id' => $this->Auth->user('id')]);
        $this->set(compact('contact', 'groups', 'users'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Groups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $groups = $this->Contacts->Groups->find('list', ['limit' => 200])->where(['user_id' => $this->Auth->user('id')]);
        $this->set(compact('contact', 'users', 'groups'));
        $this->set('_serialize', ['contact']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            // @codeCoverageIgnoreStart
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
            // @codeCoverageIgnoreEnd
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Sends an e-mail to a selected contact
     *
     * @param null|int $id id of the contact to send mail to
     * @return \Cake\Network\Response|null
     */
    public function email($id = null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->get($this->request->data('id'));
            try {
                $email = new Email();
                $email
                    ->to($contact->email)
                    ->from($this->Auth->user('email'))
                    ->subject($this->request->data('Subject'))
                    ->send($this->request->data('Body'));
                $this->Flash->success(__('The e-mail has been sent.'));

                return $this->redirect(['action' => 'index']);
            } catch (\Exception $e) {
                $this->Flash->error("Message could not be sent, please try again later...");
            }
        }
        $contacts = $this->Contacts->find('list', ['limit' => 200])
            ->where(['Contacts.user_id' => $this->Auth->user('id')])
            ->where(['Contacts.email IS NOT' => null]);
        $this->set('id', $id);
        $this->set(compact('contacts', 'users'));
        $this->set('_serialize', ['contacts']);
    }

    /**
     * @param array $user logged in user
     * @return bool user is authorized or not
     */
    public function isAuthorized($user)
    {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'email'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        // Check that the contact belongs to the current user.
        $id = $this->request->params['pass'][0];
        $contact = $this->Contacts->get($id);
        if ($contact->user_id == $user['id']) {
            return true;
        }
        // @codeCoverageIgnoreStart
        return parent::isAuthorized($user);
        // @codeCoverageIgnoreEnd
    }
}
