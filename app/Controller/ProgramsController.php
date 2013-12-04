<?php
class ProgramsController extends AppController {
    public $helpers = array('Html', 'Form');
	
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
		
		$indicatorOutcomes = $this->Program->IndicatorOutcome->find('all', 
			array(
					'conditions' => array('IndicatorOutcome.program_id'=>$programId),
					'fields' => array('DISTINCT IndicatorOutcome.indicator_id')
				)
			);
		$this->set('indicatorOutcomes', $indicatorOutcomes);
		
		$indicatorTargets = $this->Program->IndicatorTarget->find('all', 
			array(
					'conditions' => array('IndicatorTarget.program_id'=>$programId),
					'fields' => array('DISTINCT IndicatorTarget.indicator_id')
				)
			);
		$this->set('indicatorTargets', $indicatorTargets);
		
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
		
		$surveys = $this->Program->Survey->find('all', 
			array(
					'conditions' => array('Survey.program_id'=>$programId)
				)
			);
		$this->set('surveys', $surveys);
		
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
		$navOptions['Export dot (outcomes only)'] = '/programs/downloadImpactModelAsDot/' . $program['Program']['id'];
		$navOptions['Export dot (everything)'] = '/programs/downloadImpactModelAsDot/' . $program['Program']['id'] . '/true';
		$this->set('navOptions', $navOptions);
		
		// title
		$this->set('title_for_layout', 
			$program['Organization']['name'] . ' > ' . 
			$program['Program']['name'] . ' > ' . 'Impact model');
	}
	
	/**
	* Generates a Graphviz dot file of an impact model 
	**/
	public function downloadImpactModelAsDot($programId, $indicatorsAndInterventions = false){
	
		$program = $this->Program->findById($programId);
		
		$outcomes = $this->Program->ProgramOutcome->find('all', 
			array(
					'conditions' => array('ProgramOutcome.program_id'=>$programId),
					'fields' => array('DISTINCT ProgramOutcome.outcome_id')
				)
			);
		$this->set('outcomes', $outcomes);
		
		$dot = 'digraph G{ node [shape="plaintext"]; graph [fontname = "arial"]; node [fontname = "arial"]; edge [fontname = "arial"];';

		foreach($outcomes as $outcome){
			$outcomeId = $outcome['Outcome']['id'];
			$dot .= "outcome$outcomeId ";
			
			// start table
			$dot .= '[label=<<table border="0" cellborder="1" cellspacing="0">';
			
			// outcome
			$outcomeCellColor = "e6e6e6";
			// most proximal outcome
			if(sizeOf($outcome['Outcome']['Child']) == 0){
				$outcomeCellColor = "aaccff";
			}
			// most distal outcome
			elseif(sizeOf($outcome['Outcome']['Parent']) == 0){
				$outcomeCellColor = "ff8080";
			}
			$dot .= '<tr><td bgcolor="#' . $outcomeCellColor . '">' . $outcome['Outcome']['name'] . '</td></tr>';
			
			if($indicatorsAndInterventions == true){
				if(sizeOf($outcome['Outcome']['Indicator']) > 0 OR sizeOf($outcome['Outcome']['Intervention']) > 0) {
					
					$dot .= '<tr><td><table border="0" cellborder="0" cellspacing="0"><tr>';
					
					// indicators
					if(sizeOf($outcome['Outcome']['Indicator']) > 0) {
						$dot .= '<td valign="top"><table border="0">';
						$dot .= '<tr><td valign="top"><u>Indicators</u></td></tr>'; 
						foreach($outcome['Outcome']['Indicator'] as $indicator){
							$dot .= '<tr><td valign="top">' . $indicator['name'] . '</td></tr>';
						}
						$dot .= "</table></td>";
					}
					
					// interventions
					if(sizeOf($outcome['Outcome']['Intervention']) > 0) {
						$dot .= '<td valign="top"><table border="0">';
						$dot .= '<tr><td valign="top"><u>Interventions</u></td></tr>'; 
						foreach($outcome['Outcome']['Intervention'] as $intervention){
							$dot .= '<tr><td valign="top">' . $intervention['name'] . '</td></tr>';
						}
						$dot .= "</table></td>";
					}
					
					$dot .= "</tr></table></td></tr>";
				}
			}
			
			// end table
			$dot .= '</table>>]; ';
			
			// direct outcomes to parent outcomes
			foreach($outcome['Outcome']['Parent'] as $parentOutcome){
				$parentOutcomeId = $parentOutcome['id'];
				$dot .= "outcome$outcomeId -> outcome$parentOutcomeId; ";
			}
		}
		$dot .= "}";
		
		// download
		$this->layout = 'download';
		header("Content-Type: text/plain"); 
		header('Content-Disposition: attachment; filename="impactmodel.dot"'); 
		
		$this->set('dot', $dot);
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
	
	public function targets($programId){
		$program = $this->Program->findById($programId);
	
		$targets = $this->Program->ProgramTarget->find('all', 
			array(
					'conditions' => array('ProgramTarget.program_id'=>$programId),
					'fields' => array('DISTINCT ProgramTarget.target_id')
				)
			);
		$this->set('targets', $targets);
		$this->set('program', $program);
		
		// menu options
		$navOptions['Back to program'] = '/programs/about/' . $program['Program']['id'];
		$navOptions['Add a target'] = '/targets/add/' . $program['Organization']['id'] . '/' . $program['Program']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function surveys($programId){
		$program = $this->Program->findById($programId);
		
		$surveys = $this->Program->Survey->find('all',
			array(
					'conditions' => array('Survey.program_id'=>$programId)
				)
			);
		$this->set('surveys', $surveys);
		$this->set('program', $program);

		// menu options
		$navOptions['Back to program'] = '/programs/about/' . $program['Program']['id'];
		$navOptions['Add a survey'] = '/surveys/add/' . $program['Program']['id'];
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