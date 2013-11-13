<?php
class SurveySectionsController extends AppController {
    public $helpers = array('Html', 'Form');
	public $uses = array('SurveySection', 'IndicatorTarget', 'IndicatorStep', 'IndicatorOutcome');
	
	public function about($surveySectionId){
		$surveySection = $this->SurveySection->findById($surveySectionId);
		$navOptions['Back to program'] = '/programs/about/' . $surveySection['SurveySection']['program_id'];
		$navOptions['Edit'] = '/surveySections/edit/' . $surveySection['SurveySection']['id'];
		$this->set('navOptions', $navOptions);
		$this->set('surveySection', $surveySection);
	}
	
	public function add($surveyId) {
		$this->set('surveyId', $surveyId);
		
		$navOptions['Back to survey'] = '/surveys/about/' . $surveyId;
		$this->set('navOptions', $navOptions);
		
		if (!empty($this->data)) {
			if ($this->SurveySection->save($this->data)) {
				$this->Session->setFlash('Your surveySection has been saved.');
				$this->redirect('/surveys/about/' . $surveyId);
			}
		}
	}
	
	public function delete($id) {
		$surveySection = $this->SurveySection->findById($id);
		$surveyId = $surveySection['Survey']['id'];
		$this->SurveySection->delete($id);
		$this->Session->setFlash('The surveySection with id: '.$id.' has been deleted.');
		$this->redirect('/surveys/about/' . $surveyId);
	}
	
	public function indicatorOptions($surveySectionId){
		$surveySection = $this->SurveySection->findById($surveySectionId);
		$programId = $surveySection['Survey']['program_id'];
		$program = $this->SurveySection->Survey->Program->findById($programId);
		
		// target
		if(isset($this->params['url']['target'])) {
			$indicators = $this->IndicatorTarget->find('all', array('conditions'=>array('IndicatorTarget.program_id'=>$programId)));
		}
		// step
		elseif(isset($this->params['url']['step'])) {
			$indicators = $this->IndicatorStep->find('all', array('conditions'=>array('IndicatorStep.program_id'=>$programId)));
		}
		// outcome
		elseif(isset($this->params['url']['outcome'])) {
			$indicators = $this->IndicatorOutcome->find('all', array('conditions'=>array('IndicatorOutcome.program_id'=>$programId)));
		}
		$this->set('indicators',$indicators);
		

		$navOptions['Back to survey'] = '/surveys/about/' . $surveySection['Survey']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid surveySection'));
		}

		$surveySection = $this->SurveySection->findById($id);
		$this->set("surveySection", $surveySection);
		if (!$surveySection) {
			throw new NotFoundException(__('Invalid surveySection'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->SurveySection->id = $id;
			if ($this->SurveySection->save($this->request->data)) {
				$this->Session->setFlash(__('Your surveySection has been updated.'));
				return $this->redirect('/programs/about/' . $surveySection['SurveySection']['program_id']);
			}
			$this->Session->setFlash(__('Unable to update your surveySection.'));
		}

		if (!$this->request->data) {
			$this->request->data = $surveySection;
		}
	}
}
?>