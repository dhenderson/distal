<?php
class StepsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function about($stepId){
		$step = $this->Step->findById($stepId);
		$navOptions['Back to program'] = '/programs/about/' . $step['Step']['program_id'];
		$navOptions['Edit'] = '/steps/edit/' . $step['Step']['id'];
		$this->set('navOptions', $navOptions);
		$this->set('step', $step);
	}
	
	public function add($programId) {
		$this->set('programId', $programId);
		
		$navOptions['Back to program'] = '/programs/about/' . $programId;
		$this->set('navOptions', $navOptions);
		
		if (!empty($this->data)) {
			if ($this->Step->save($this->data)) {
				$this->Session->setFlash('Your step has been saved.');
				$this->redirect('/programs/serviceutilization/' . $programId);
			}
		}
	}
	
	public function delete($id) {
		$step = $this->Step->findById($id);
		$projectId = $step['Step']['program_id'];
		$this->Step->delete($id);
		$this->Session->setFlash('The step with id: '.$id.' has been deleted.');
		$this->redirect('/projects/about/' . $projectId);
	}
	
	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid step'));
		}

		$step = $this->Step->findById($id);
		$this->set("step", $step);
		if (!$step) {
			throw new NotFoundException(__('Invalid step'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Step->id = $id;
			if ($this->Step->save($this->request->data)) {
				$this->Session->setFlash(__('Your step has been updated.'));
				return $this->redirect('/programs/about/' . $step['Step']['program_id']);
			}
			$this->Session->setFlash(__('Unable to update your step.'));
		}

		if (!$this->request->data) {
			$this->request->data = $step;
		}
	}
}
?>