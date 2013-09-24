<?php
class IndicatorsController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function about($indicatorId){
		$indicator = $this->Indicator->findById($indicatorId);
		$this->set('indicator', $indicator);
	}
	
	public function add($outcomeId) {
		$this->set('outcomeId', $outcomeId);
	
		if (!empty($this->data)) {
			if ($this->Indicator->save($this->data)) {
				$this->Session->setFlash('Your indicator has been saved.');
				$this->redirect('/indicators/about/' . $this->Indicator->id);
			}
		}
	}
	
	public function delete($id) {
		$indicator = $this->Indicator->findById($id);
		$this->Indicator->delete($id);
		$this->Session->setFlash('The indicator with id: '.$id.' has been deleted.');
		$this->redirect('/projects/about/' . $indicator['Outcome']['project_id']);
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