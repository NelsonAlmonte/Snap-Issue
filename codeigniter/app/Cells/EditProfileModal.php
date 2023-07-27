<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class EditProfileModal extends Cell
{
    public function render(): string
    {
        return $this->view('edit_profile_modal');
    }
}
