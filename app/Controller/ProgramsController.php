<?php
class ProgramsController extends AppController {
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('programs', $this->Program->find('all'));
    }
	
	public function about($programId){
		$program = $this->Program->findById($programId);
		$this->set('program', $program);
		
		$outcomes = $this->Program->ProgramOutcome->find('all', 
			array(
					'conditions' => array('ProgramOutcome.program_id'=>$programId),
					'fields' => array('DISTINCT ProgramOutcome.outcome_id')
				)
			);
		$this->set('outcomes', $outcomes);
		
		$indicators = $this->Program->IndicatorOutcome->find('all', 
			array(
					'conditions' => array('IndicatorOutcome.program_id'=>$programId),
					'fields' => array('DISTINCT IndicatorOutcome.indicator_id')
				)
			);
		$this->set('indicators', $indicators);
		
		$interventions = $this->Program->InterventionOutcome->find('all', 
			array(
					'conditions' => array('InterventionOutcome.program_id'=>$programId),
					'fields' => array('DISTINCT InterventionOutcome.intervention_id')
				)
			);
		$this->set('interventions', $interventions);
		
		$steps = $this->Program->Step->find('all', 
			array(
					'conditions' => array('Step.program_id'=>$programId)
				)
			);
		$this->set('steps', $steps);
		
		// menu options
		$navOptions['Back to organization'] = '/organizations/about/' . $program['Program']['organization_id'];
		$navOptions['Add a target'] = '/targets/add/' . $programId;
		$navOptions['Edit'] = '/programs/edit/' . $programId;
		$this->set('navOptions', $navOptions);
		
		// title
		$this->set('title_for_layout', 
			$program['Organization']['name'] . ' > ' . 
			$program['Program']['name']);
	}
	
	public function impactmodel($programId){
		$program = $this->Program->findById($programId);
		$this->set('program', $program);
		
		$outcomes = $this->Program->ProgramOutcome->find('all', 
			array(
					'conditions' => array('ProgramOutcome.program_id'=>$programId),
					'fields' => array('DISTINCT ProgramOutcome.outcome_id')
				)
			);
		$this->set('outcomes', $outcomes);
		
		// menu options
		$navOptions['Back to program'] = '/programs/about/' . $program['Program']['id'];
		$this->set('navOptions', $navOptions);
		
		// title
		$this->set('title_for_layout', 
			$program['Organization']['name'] . ' > ' . 
			$program['Program']['name'] . ' > ' . 'Impact model');
	}
	
	public function serviceUtilization($programId){
		$program = $this->Program->findById($programId);
	
		$steps = $this->Program->Step->find('all', array('conditions'=>array('Step.program_id'=>$programId)));
		$this->set('steps', $steps);
		$this->set('programId', $programId);
		
		// menu options
		$navOptions['Back to program'] = '/programs/about/' . $program['Program']['id'];
		$navOptions['Add a step'] = '/steps/add/' . $program['Program']['id'];
		$this->set('navOptions', $navOptions);
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
				$this->redirect('/programs/about/' . $this->Program->getLastInsertId());
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
			
			$program = $this->Program->findById($id); 
			if ($this->Program->save($this->request->data)) {
				$this->Session->setFlash(__('Your program has been updated.'));
				return $this->redirect('/programs/about/' . $program['Program']['id']);
			}
			$this->Session->setFlash(__('Unable to update your program.'));
		}

		if (!$this->request->data) {
			$this->request->data = $program;
		}
	}
}
?>