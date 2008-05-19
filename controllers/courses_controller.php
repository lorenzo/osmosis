<?php
class CoursesController extends AppController {

	var $name = 'Courses';
	var $helpers = array('Html', 'Form' );

	/**
	 * Lists available courses
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Course->recursive = 0;
		$this->set('courses', $this->paginate());
		$this->layout = 'no_course';
		$this->Placeholder->attach('plugin_updates');
	}

	function admin_index() {
		$this->Courses->recursive = 0;
		$this->set('courses', $this->paginate());
	}

	/**
	 * Displays course information
	 *
	 * @param string $id course id
	 * @return void
	 * @author José Lorenzo
	 */
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->activeCourse = $id;
		$this->set('course', $this->Course->read(null, $id));
		$this->set('professors', $this->Course->professors($id));
	}

	/**
	 * Adds a new course
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Course->create();
			$this->data['Course']['owner_id'] = $this->Auth->user('id');
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.',true));
			}
		}
		$departments = $this->Course->Department->find("list");
		$owners = $this->Course->Owner->find("list");
		$this->set(compact('departments', 'owners'));
	}

	/**
	 * Edits the information of a course
	 *
	 * @param string $id course id
	 * @return void
	 * @author José Lorenzo
	 */
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Course',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Course->read(null, $id);
		}
		$departments = $this->Course->Department->generateList();
	}

	/**
	 * Deletes a course
	 *
	 * @param string $id course id
	 * @return void
	 * @author José Lorenzo
	 */
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Course->del($id)) {
			$this->Session->setFlash(sprintf(__('Course %s deleted',true),"# $id"));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

	/**
	 * Enrolls the logged member in the course with id $course_id
	 *
	 * @param string $course_id the course identifier
	 * @return void
	 * @author José Lorenzo
	 */
	
	function enroll($course_id) {
		$this->Course->id = $course_id;
		if (!$this->Course->exists()) {
			$this->Session->setFlash(__('Invalid Course',true));
			$this->redirect('/');
		}
		if($this->Course->alreadyEnrolled($this->Auth->user('id'), $course_id)===true) {
			$this->Session->setFlash(__('You have been already enrolled in this course',true));
			$this->redirect(array('action' => 'index'));
		} else if ($this->Course->enroll($this->Auth->user('id'))) {
			$this->Session->setFlash(__('You have been enrolled',true));
			$this->redirect(array('action' => 'view', $course_id));
		}
		$this->Session->setFlash(__('Enrollment failed',true));
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 * Add or removes a tool from a course
	 *
	 * @param string $id course identifier
	 * @author José Lorenzo
	 */
	
	function tools($id) {
		if (!empty($this->data)) {
			if (isset($this->data['CourseTool']['add'])) {
				
				if ($this->Course->Tool->CourseTool->save($this->data))
					$this->Session->setFlash(__('The Tool has been added',true));
				else
					$this->Session->setFlash(__('The could not be added',true));
			} elseif (isset($this->data['CourseTool']['remove'])) {
				
				unset($this->data['CourseTool']['remove']);
				if ($this->Course->Tool->CourseTool->deleteAll($this->data['CourseTool']))
					$this->Session->setFlash(__('The Tool has been removed',true));
				else 
					$this->Session->setFlash(__('The Tool could not be removed',true));
			}
		}
		$tools = $this->Course->Tool->actives();
		$this->set(compact('tools','id'));
	}

}
?>