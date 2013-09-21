<?php
class ProgramsController extends AppController {
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('programs', $this->Program->find('all'));
    }
	
	public function about($programId){
		$program = $this->Program->findById($programId);
		$this->set('program', $program);
	}
	
	public function add($organizationId) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		$user = $this->getLoggedInUser();
		$this->set('organizationId', $organizationId);
	
		if (!empty($this->data)) {
			if ($this->Program->save($this->data)) {
				$this->Session->setFlash('Your program has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function delete($id) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		$this->Program->delete($id);
		$this->Session->setFlash('The program with id: '.$id.' has been deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
	public function edit($id = null) {
	
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		if (!$id) {
			throw new NotFoundException(__('Invalid program'));
		}

		$program = $this->Program->findById($id);
		if (!$program) {
			throw new NotFoundException(__('Invalid program'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Program->id = $id;
			if ($this->Program->save($this->request->data)) {
				$this->Session->setFlash(__('Your program has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your program.'));
		}

		if (!$this->request->data) {
			$this->request->data = $program;
		}
	}
}
?>