<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class IssueInfoModal extends Cell
{
    public function render(): string
    {
        return $this->view('issue_info_modal');
    }
}
