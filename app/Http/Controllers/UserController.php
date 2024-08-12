<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    //

    public function adminShowUsers(){
        $users=User::all();
        return view('admin.users.showUsers',compact(['users']));
    }

    public function adminAddUsers(Request $request){
        $save=User::create($request->all());
        if($save){
            alert()->success('Success','Data saved');
            return redirect()->back();
        }else{
            alert()->error('Failed','Could not save.');
            return redirect()->back();
        }

    }

    public function adminUpdateUsers(Request $request){
        $id=$request->id;
        $update=User::find($id)->update($request->all());
        if($update){
            alert()->success('Success','Data Updated');
            return redirect()->back();
        }else{
            alert()->error('Failed','Could not Update.');
            return redirect()->back();
        }

    }

    public function adminDeleteUsers(Request $request){
         $id=$request->id;
         $delete=User::find($id)->delete();
         if($delete){
            alert()->success('Success','One record deleted');
            return redirect()->back();
        }else{
            alert()->error('Failed','Could not delete.');
            return redirect()->back();
        }
    }

    public function adminExportUsersAsExcel(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function adminExportUsersAsPdf(){
        $users=User::all();
        $pdf = Pdf::loadView('admin.users.adminExportUsersAsApdf', ['users'=>$users]);
        return $pdf->download('users.pdf');
    }

    public function adminImportUsersData(Request $request){
      
        $file = $request->file('user_file');
      
        // Import the data
        Excel::import(new UsersImport, $file);
  
      return redirect()->back()->with('success', 'Users imported successfully!');
    }
}
