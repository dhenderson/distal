<?php
class OutcomesController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function index(){
		
		$outcomes = $this->Outcome->find('all');
		$outcomesByProgram = $this->Outcome->ProgramOutcome->find('all', array('order' => array('Outcome.name')));
		$this->set('outcomes', $outcomes);
		$this->set('outcomesByProgram', $outcomesByProgram);
	}
	
	public function about($outcomeId){
		$outcome = $this->Outcome->findById($outcomeId);
		$this->set('outcome', $outcome);
	}
	
	public function add($organizationId, $programId = null, $parentOutcomeId = null) {
		$user = $this->getLoggedInUser();
		
		$outcomes = $this->Outcome->find(
			'all',
			array(
				'conditions' => array(
					'Outcome.organization_id' => $organizationId,
					'NOT' => array (
						'Outcome.id' => $this->Outcome->Organization->Program->getOutcomeIds($programId),
					)
				)
			)
		);
		
		$this->set('programId', $programId);
		$this->set('outcomes', $outcomes);
		$this->set('organizationId', $organizationId);
		$this->set('parentOutcomeId', $parentOutcomeId);
		
		if($programId == null) {
			$organization = $this->Outcome->Organization->findById($organizationId);
			$this->set('title_for_layout', $organization['Organization']['name'] . ' > Add outcome' );
			$navOptions['Back to organization'] = '/organizations/about/' . $organization['Organization']['id'];
		}
		else {
			$program = $this->Outcome->Organization->Program->findById($programId);
			$this->set('title_for_layout', $program['Organization']['name'] . ' > ' . $program['Program']['name'] . ' > Add outcome' );
			$navOptions['Back to program impact model'] = '/programs/impactmodel/' . $program['Program']['id'];
		}
		
		$this->set('navOptions', $navOptions);
		
		if (!empty($this->data)) {
			if ($this->Outcome->save($this->data)) {
				// if a program id was passed, link this outcome to the program and parent
				if($programId != null) {
					$this->Outcome->linkToProgram($this->Outcome->id, $programId, $parentOutcomeId);
				}
				$this->Session->setFlash('Your outcome has been saved.');
				$this->redirect('/programs/impactmodel/' . $programId);
			}
		}
	}
	
	public function linkToProgram($outcomeId, $programId, $parentOutcomeId) {
		$this->Outcome->linkToProgram($outcomeId, $programId, $parentOutcomeId);
		$this->redirect('/programs/impactmodel/' . $programId);
	}
	
	public function delete($id) {
		$outcome = $this->Outcome->findById($id);
		$projectId = $outcome['Outcome']['project_id'];
		$this->Outcome->delete($id);
		$this->Session->setFlash('The outcome with id: '.$id.' has been deleted.');
		$this->redirect('/projects/impactmodel/' . $projectId);
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
	
	public function removeFromProgram($outcomeId, $programId, $parentOutcomeId = null){
		$this->Outcome->removeFromProgram($outcomeId, $programId, $parentOutcomeId);
		$this->redirect('/programs/impactmodel/' . $programId);
	}
	
	public function removeFromParentOutcome($outcomeId, $programId, $parentOutcomeId){
		$this->Outcome->removeFromParentOutcome($outcomeId, $programId, $parentOutcomeId);
		$this->redirect('/programs/impactmodel/' . $programId);
	}
}
?>