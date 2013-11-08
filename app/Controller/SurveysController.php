<?php
class SurveysController extends AppController {
    public $helpers = array('Html', 'Form');
	
	public function about($surveyId){
		$survey = $this->Survey->findById($surveyId);
		$navOptions['Back to program'] = '/programs/about/' . $survey['Survey']['program_id'];
		$navOptions['New section'] = '/surveySections/add/' . $survey['Survey']['id'];
		$navOptions['Edit'] = '/surveys/edit/' . $survey['Survey']['id'];
		$this->set('navOptions', $navOptions);
		$this->set('survey', $survey);
	}
	
	public function add($programId) {
		$this->set('programId', $programId);
		
		$navOptions['Back to surveys'] = '/programs/surveys/' . $programId;
		$this->set('navOptions', $navOptions);
		
		if (!empty($this->data)) {
			if ($this->Survey->save($this->data)) {
				$this->Session->setFlash('Your survey has been saved.');
				$this->redirect('/programs/surveys/' . $programId);
			}
		}
	}
	
	public function delete($id) {
		$survey = $this->Survey->findById($id);
		$projectId = $survey['Survey']['program_id'];
		$this->Survey->delete($id);
		$this->Session->setFlash('The survey with id: '.$id.' has been deleted.');
		$this->redirect('/projects/about/' . $projectId);
	}
	
	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid survey'));
		}

		$survey = $this->Survey->findById($id);
		$this->set("survey", $survey);
		if (!$survey) {
			throw new NotFoundException(__('Invalid survey'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Survey->id = $id;
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('Your survey has been updated.'));
				return $this->redirect('/programs/about/' . $survey['Survey']['program_id']);
			}
			$this->Session->setFlash(__('Unable to update your survey.'));
		}

		if (!$this->request->data) {
			$this->request->data = $survey;
		}
	}
}
?>