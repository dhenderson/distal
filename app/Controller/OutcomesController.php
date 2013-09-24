<?php
class OutcomesController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function about($outcomeId){
		$outcome = $this->Outcome->findById($outcomeId);
		$this->set('outcome', $outcome);
	}
	
	public function add($programId, $parentOutcomeId = null) {
		$user = $this->getLoggedInUser();
		$this->set('programId', $programId);
	
		if (!empty($this->data)) {
			if ($this->Outcome->save($this->data)) {
				// if a parent id was passed, link this outcome to the parent
				if($parentOutcomeId != null) {
					echo "OUTCOME ID IS " . $this->Outcome->id;
					$this->Outcome->linkToParentOutcome($this->Outcome->id, $parentOutcomeId);
				}
				$this->Session->setFlash('Your outcome has been saved.');
				$this->redirect('/programs/impactmodel/' . $programId);
			}
		}
	}
	
	public function delete($id) {
		$outcome = $this->Outcome->findById($id);
		$this->Outcome->delete($id);
		$this->Session->setFlash('The outcome with id: '.$id.' has been deleted.');
		$this->redirect('/projects/impactmodel/' . $outcome['Outcome']['project_id']);
	}
	
	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid outcome'));
		}

		$outcome = $this->Outcome->findById($id);
		$this->set("outcome", $outcome);
		if (!$outcome) {
			throw new NotFoundException(__('Invalid outcome'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Outcome->id = $id;
			if ($this->Outcome->save($this->request->data)) {
				$this->Session->setFlash(__('Your outcome has been updated.'));
				return $this->redirect('/programs/impactmodel/' . $outcome['Outcome']['program_id']);
			}
			$this->Session->setFlash(__('Unable to update your outcome.'));
		}

		if (!$this->request->data) {
			$this->request->data = $outcome;
		}
	}
}
?>