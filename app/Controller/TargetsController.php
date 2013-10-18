<?php
class TargetsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function index(){
		$this->set('targets', $this->Target->find('all'));
	}
	
	public function about($targetId){
		$target = $this->Target->findById($targetId);
		$this->set('target', $target);
	}
	
	public function add($organizationId, $programId = null) {

		$this->set('organizationId', $organizationId);	
		$this->set('programId', $programId);
	
		if (!empty($this->data)) {
			if ($this->Target->save($this->data)) {
			
				if($organizationId != null AND $programId != null) {
					// link to program
					$this->Target->linkToProgram($this->Target->id, $programId);
				}
				$this->Session->setFlash('Your target has been saved.');
				$this->redirect('/targets/about/' . $this->Target->getLastInsertID());
			}
		}
	}
	
	public function delete($id) {
		$target = $this->Target->findById($id);
		$this->Target->delete($id);
		$this->Session->setFlash('The target with id: '.$id.' has been deleted.');
		$this->redirect('/projects/impactmodel/' . $target['Outcome']['project_id']);
	}
	
	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid target'));
		}

		$target = $this->Target->findById($id);
		if (!$target) {
			throw new NotFoundException(__('Invalid target'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Target->id = $id;
			if ($this->Target->save($this->request->data)) {
				$this->Session->setFlash(__('Your target has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your target.'));
		}

		if (!$this->request->data) {
			$this->request->data = $target;
		}
	}
}
?>