<?php
class OrganizationsController extends AppController {
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('organizations', $this->Organization->find('all'));
    }
	
	public function outcomes($organizationId) {
		$organization = $this->Organization->findById($organizationId);
		
		$outcomes = $this->Organization->Outcome->find('all', array('conditions' => array('Outcome.organization_id' => $organizationId)));
		$this->set('outcomes', $outcomes);
		$this->set('organization', $organization);
		
		$this->set('title_for_layout', $organization['Organization']['name'] . ' > Outcomes');
		
		$navOptions['Back to organization'] = '/organizations/about/' . $organization['Organization']['id'];
		$navOptions['Add a new outcome'] = '/outcomes/add/' . $organization['Organization']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function indicators($organizationId) {
		$organization = $this->Organization->findById($organizationId);
		
		$indicators = $this->Organization->Indicator->find('all', array('conditions' => array('Indicator.organization_id' => $organizationId)));
		$this->set('indicators', $indicators);
		$this->set('organization', $organization);
		
		$this->set('title_for_layout', $organization['Organization']['name'] . ' indicators');
		
		$navOptions['Back to organization'] = '/organizations/about/' . $organization['Organization']['id'];
		$navOptions['Add a new indicator'] = '/indicators/add/' . $organization['Organization']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function interventions($organizationId) {
		$organization = $this->Organization->findById($organizationId);
		
		$interventions = $this->Organization->Intervention->find('all', array('conditions' => array('Intervention.organization_id' => $organizationId)));
		$this->set('interventions', $interventions);
		$this->set('organization', $organization);
		
		$this->set('title_for_layout', $organization['Organization']['name'] . ' interventions');
		
		$navOptions['Back to organization'] = '/organizations/about/' . $organization['Organization']['id'];
		$navOptions['Add a new intervention'] = '/interventions/add/' . $organization['Organization']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function about($organizationId){
		$organization = $this->Organization->findById($organizationId);
		$this->set('organization', $organization);
		
		$this->set('title_for_layout', $organization['Organization']['name']);
		
		$navOptions['Add a new program'] = '/programs/add/' . $organization['Organization']['id'];
		$navOptions['Outcomes'] = '/organizations/outcomes/' . $organization['Organization']['id'];
		$navOptions['Interventions'] = '/organizations/interventions/' . $organization['Organization']['id'];
		$navOptions['Indicators'] = '/organizations/indicators/' . $organization['Organization']['id'];
		$this->set('navOptions', $navOptions);
	}
	
	public function add($advisoryGroupId = null) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		$user = $this->getLoggedInUser();
		$this->set('advisoryGroupId', $advisoryGroupId);
	
		if (!empty($this->data)) {
		
			if ($this->Organization->save($this->data)) {
				// link this user's user group to the organization
				$this->Organization->OrganizationAdvisoryGroup->addAdvisoryGroupToOrganization($this->Organization->id, $advisoryGroupId);
				$this->Session->setFlash('Your organization has been saved');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function delete($id) {
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		$this->Organization->delete($id);
		$this->Session->setFlash('The organization with id: '.$id.' has been deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
	public function edit($id = null) {
	
		if(!$this->isSystemAdmin()){
			$this->redirect('/users/home');
		}
		
		if (!$id) {
			throw new NotFoundException(__('Invalid organization'));
		}

		$organization = $this->Organization->findById($id);
		if (!$organization) {
			throw new NotFoundException(__('Invalid organization'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Organization->id = $id;
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('Your organization has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your organization.'));
		}

		if (!$this->request->data) {
			$this->request->data = $organization;
		}
	}
}
?>