<?php

class BaseRestController extends BaseController
{
    public function retrieve() {
    }
    public function list() {
    }
    public function create() {
    }
    public function update() {
    }
    public function delete() {
    }
    public function process_response()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if (isset($this->params['id'])) {
            if ($method == 'GET') {
                $this->retrieve();
            } else if ($method == 'POST') {
                $this->update();
            } else if ($method == 'DELETE') {
                $this->delete();
            }
        } else {
            if ($method == 'GET') {
                $this->list();
            } else if ($method == 'POST') {
                $this->create();
            }
        }
    }
}
