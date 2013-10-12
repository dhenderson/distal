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
	}
	
	public function add($organizationId, $outcomeId = null, $programId = null) {
	
		$this->set('organizationId', $organizationId);	
		$this->set('outcomeId', $outcomeId);
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
			
				if($outcomeId != null AND $programId != null) {
					// link to outcome
					$this->Indicator->linkToOutcome($this->Indicator->id, $outcomeId, $programId);
				}
				
				$this->Session->setFlash('Your indicator has been saved.');
				$this->redirect('/programs/impactmodel/' . $programId);
			}
		}
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
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your indicator.'));
		}

		if (!$this->request->data) {
			$this->request->data = $indicator;
		}
	}
}
?>