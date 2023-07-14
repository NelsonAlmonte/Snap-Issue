<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class CaptureIssueModal extends Cell
{
    public function render(): string
    {
        return $this->view('capture_issue_modal');
    }
}
