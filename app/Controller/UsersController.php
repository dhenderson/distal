<?php
class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('users', $this->User->find('all'));
    }
	
	public function home(){
		$user = $this->getLoggedInUser();
		
		pr($user);
		
		$organizations = $this->User->UserUserGroup->UserGroup->Organization->find(
			'all', 
			array('conditions' => array('Organization.user_group_id IN' => $user['UserUserGroup']['user_group_id'])) // <- NEEDS TO BE AN IN CLAUSE
		);
		
		
		$this->set('user', $user);
		$this->set('organizations', $organizations);
	}
	
	public function add($userGroupId = null) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		$user = $this->getLoggedInUser();
		
		$this->set('userGroupId', $userGroupId);
	
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('Your user has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function delete($id) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		$this->User->delete($id);
		$this->Session->setFlash('The user with id: '.$id.' has been deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
	public function edit($id = null) {
	
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		if (!$id) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->findById($id);
		if (!$user) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $id;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Your user has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your user.'));
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}
	}
	
    public function login(){
	
		// use the login layout
		$this->layout = 'login';
		
        //Don't show the error message if no data has been submitted.
        $this->set('error', false);

        // If a user has submitted form data:
        if (!empty($this->data)){
            // First, let's see if there are any users in the database
            // with the username supplied by the user using the form:
            $someone = $this->User->findByEmail($this->data['User']['email']);
            // At this point, $someone is full of user data, or its empty.
            // Let's compare the form-submitted password with the one in
            // the database.

            if(!empty($someone['User']['password']) && $someone['User']['password'] == $this->data['User']['password']){
                // Note: hopefully your password in the DB is hashed,
                // so your comparison might look more like:
                // md5($this->data['User']['password']) == ...

                // This means they were the same. We can now build some basic
                // session information to remember this user as 'logged-in'.
                $this->Session->write('User', $someone);

                // Now that we have them stored in a session, forward them on
                // to a landing page for the application.
				
				if($this->isSystemAdmin()){
					$this->redirect('/admin');
				}
				else{
					$this->redirect('/users/home');
				}
            }
            // Else, they supplied incorrect data:
            else{
                // Remember the $error var in the view? Let's set that to true:
                $this->set('error', true);
            }
        }
    }

    public function logout(){
        // Redirect users to this action if they click on a Logout button.
        // All we need to do here is trash the session information:
        $this->Session->delete('User');

        // And we should probably forward them somewhere, too...
        $this->redirect('login');
    }
}
?>