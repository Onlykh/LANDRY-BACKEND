<?php

use App\Models\User;

function currentUser(): ?User
{
    return auth()->user() ?? null;
}


function uploadFile($file, $path, $disk = 'public')
{
    $fileName = time() . '.' . $file->getClientOriginalExtension();
    $file->storeAs($path, $fileName, $disk);
    return "$path/$fileName";
}
