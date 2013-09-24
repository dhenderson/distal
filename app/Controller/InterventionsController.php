<?php
class InterventionsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function about($interventionId){
		$intervention = $this->Intervention->findById($interventionId);
		$this->set('intervention', $intervention);
	}
	
	public function add($outcomeId) {
		$this->set('outcomeId', $outcomeId);
	
		if (!empty($this->data)) {
			if ($this->Intervention->save($this->data)) {
				$this->Session->setFlash('Your intervention has been saved.');
				$this->redirect('/interventions/about/' . $this->Intervention->id);
			}
		}
	}
	
	public function delete($id) {
		$intervention = $this->Intervention->findById($id);
		$this->Intervention->delete($id);
		$this->Session->setFlash('The intervention with id: '.$id.' has been deleted.');
		$this->redirect('/projects/about/' . $intervention['Outcome']['project_id']);
	}
	
	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid intervention'));
		}

		$intervention = $this->Intervention->findById($id);
		if (!$intervention) {
			throw new NotFoundException(__('Invalid intervention'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Intervention->id = $id;
			if ($this->Intervention->save($this->request->data)) {
				$this->Session->setFlash(__('Your intervention has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your intervention.'));
		}

		if (!$this->request->data) {
			$this->request->data = $intervention;
		}
	}
}
?>