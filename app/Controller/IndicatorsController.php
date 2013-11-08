<?php
class IndicatorsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function about($indicatorId){
		$indicator = $this->Indicator->findById($indicatorId);
		$outcomes = $this->Indicator->IndicatorOutcome->find('all',
			array('conditions' => array('IndicatorOutcome.indicator_id' => $indicatorId))
		);
		$this->set('outcomes', $outcomes);
		
		$this->set('indicator', $indicator);
		$this->set('title_for_layout', $indicator['Organization']['name'] . ' > ' . $indicator['Indicator']['name']);
		
		// menu options
		$navOptions['Back to ' . $indicator['Organization']['name']] = '/organizations/about/' . $indicator['Organization']['id'];
		$navOptions['Edit'] = '/indicators/edit/' . $indicator['Indicator']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function add($organizationId, $programId = null) {
	
		$this->set('organizationId', $organizationId);	
		
		$this->set('dataTypes', $this->Indicator->DataType->find('list'));
		$this->set('answerOptionTypes', $this->Indicator->AnswerOptionType->find('list'));
		
		$outcomeId = null;
		$targetId = null;
		
		// outcomeId
		if(isset($this->params['url']['outcomeId'])) {
			$outcomeId = $this->params['url']['outcomeId'];
			$this->set('outcomeId', $outcomeId);
		}
		// targetId
		elseif(isset($this->params['url']['targetId'])) {
			$targetId = $this->params['url']['targetId'];
			$this->set('targetId', $targetId);
		}
		// stepId
		elseif(isset($this->params['url']['stepId'])) {
			$stepId = $this->params['url']['stepId'];
			$this->set('stepId', $stepId);
		}
		
		$this->set('programId', $programId);
		
		$indicators = $this->Indicator->find(
			'all',
			array(
				'conditions' => array(
					'Indicator.id' => $this->Indicator->Organization->Program->getIndicatorIds($programId)
				)
			)
		);
		
		$this->set('indicators', $indicators);
	
		if (!empty($this->data)) {
			if ($this->Indicator->save($this->data)) {
			
				$this->Session->setFlash('Your indicator has been saved.');
			
				if($outcomeId != null AND $programId != null) {
					// link to outcome
					$this->Indicator->linkToOutcome($this->Indicator->id, $outcomeId, $programId);
					$this->redirect('/programs/impactmodel/' . $programId);
				}
				elseif($targetId != null AND $programId != null){
					// link to target
					$this->Indicator->linkToTarget($this->Indicator->id, $targetId, $programId);
					$this->redirect('/targets/about/' . $targetId);
				}
				elseif($stepId != null AND $programId != null){
					// link to step
					$this->Indicator->linkToStep($this->Indicator->id, $stepId, $programId);
					$this->redirect('/programs/serviceutilization/' . $programId);
				}
			}
		}
	}
	
	public function linkToStep($indicatorId, $stepId, $programId) {
		$this->Indicator->linkToStep($indicatorId, $stepId, $programId);
		$this->redirect('/programs/serviceutilization/' . $programId);
	}
	
	public function delete($id, $programId = null) {
		$indicator = $this->Indicator->findById($id);
		$organizationId = $indicator['Indicator']['organization_id'];
		$this->Indicator->delete($id);
		$this->Session->setFlash('The indicator with id: '.$id.' has been deleted.');
		
		if($programId != null){
			$this->redirect('/programs/impactmodel/' . $programId);
		}
		else{
			$this->redirect('/organizations/impactmodel/' . $organizationId);
		}
	}
	
	public function edit($id = null) {
	
		$this->set('dataTypes', $this->Indicator->DataType->find('list'));
		$this->set('answerOptionTypes', $this->Indicator->AnswerOptionType->find('list'));
		
		if (!$id) {
			throw new NotFoundException(__('Invalid indicator'));
		}

		$indicator = $this->Indicator->findById($id);
		if (!$indicator) {
			throw new NotFoundException(__('Invalid indicator'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Indicator->id = $id;
			if ($this->Indicator->save($this->request->data)) {
				$this->Session->setFlash(__('Your indicator has been updated.'));
				return $this->redirect('/indicators/about/' . $id);
			}
			$this->Session->setFlash(__('Unable to update your indicator.'));
		}

		if (!$this->request->data) {
			$this->request->data = $indicator;
		}
	}
}
?>