<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Task;
use App\File;

class FileController extends Controller
{
    public function download($task_id){
        $task = Task::findOrFail($task_id);

        $this->authorize('download', $task->file);
        
        if(Storage::disk('public')->exists($task->file->path))
            return Storage::disk('public')->download($task->file->path, $task->file->name.'.'.pathinfo($task->file->path, PATHINFO_EXTENSION));
        else return redirect()->back();
    }

    public function upload(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'file' => ['file', 'mimes:doc,docx'],
        ],[

        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $task = Task::findOrFail($id);
        $user = auth()->user();

        $this->authorize('upload', $task);

        if($request->hasFile('file')){
            $taskFile = $request->file('file')->store('files/tasks', 'public');
            $fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);

            if(isset($task->file)){
                Storage::disk('public')->delete($task->file->path);

                $task->file->name = $fileName;
                $task->file->path = $taskFile;
                $task->file->save();
            }else{
                $newFile = File::create(array(
                    'name'      =>  $fileName,
                    'path'      =>  $taskFile,
                    'user_id'   =>  $user->id,
                    'task_id'   =>  $task->id
                ));

                $task->file_id = $newFile->id;
                $task->save();
            }
        }

        return redirect()->back();
    }
}
