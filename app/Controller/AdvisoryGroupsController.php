<?php
class AdvisoryGroupsController extends AppController {
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('advisoryGroups', $this->AdvisoryGroup->find('all'));
    }
	
	public function about($advisoryGroupId){
		$advisoryGroup = $this->AdvisoryGroup->findById($advisoryGroupId);
		$this->set('userGroup', $advisoryGroup);
	}
	
	public function add() {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		$user = $this->getLoggedInUser();
	
		if (!empty($this->data)) {
			if ($this->AdvisoryGroup->save($this->data)) {
				$this->Session->setFlash('Your user group has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function delete($id) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		$this->AdvisoryGroup->delete($id);
		$this->Session->setFlash('The user group with id: '.$id.' has been deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
	public function edit($id = null) {
	
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		if (!$id) {
			throw new NotFoundException(__('Invalid user group'));
		}

		$advisoryGroup = $this->AdvisoryGroup->findById($id);
		if (!$advisoryGroup) {
			throw new NotFoundException(__('Invalid user group'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->AdvisoryGroup->id = $id;
			if ($this->AdvisoryGroup->save($this->request->data)) {
				$this->Session->setFlash(__('Your user group has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your user group.'));
		}

		if (!$this->request->data) {
			$this->request->data = $advisoryGroup;
		}
	}
}
?>