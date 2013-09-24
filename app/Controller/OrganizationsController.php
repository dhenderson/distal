<?php
class OrganizationsController extends AppController {
    public $helpers = array('Html', 'Form');
	
    public function index() {
        $this->set('organizations', $this->Organization->find('all'));
    }
	
	public function about($organizationId){
		$organization = $this->Organization->findById($organizationId);
		$this->set('organization', $organization);
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