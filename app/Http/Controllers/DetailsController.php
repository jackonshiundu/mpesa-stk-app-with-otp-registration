<?php



namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function showSuccessPage($id)
        {
            // Fetch the user details from the database using the $id parameter
            $userDetails = User::find($id);
            // Make sure the user details exist
            if (!$userDetails) {
                abort(404); // or handle it in your own way, e.g., redirect to an error page
            }

            return view('success', ['userDetails' => $userDetails]);
        }
}
