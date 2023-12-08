<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;

class CommandController extends Controller
{
    // edit command quantity
    public function edit(int $id){
        $command = Command::find($id);

    }
}
