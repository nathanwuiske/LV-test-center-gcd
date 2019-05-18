<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPassController extends Controller
{
	use SendsPasswordResetEmails;

	public function __construct()
	{
		$this->middleware('guest');
	}
	public function sendEmail(Request $request)
	{
		$this->validateEmail($request);
		$response = $this->broker()->sendResetLink(
			$request->only('email')
		);
		return $response == Password::RESET_LINK_SENT
			? response()->json(['message' => 'Reset link send to your email address.', 'status' => true], 201)
			: response()->json(['message' => 'Failed to send reset link', 'status' => false], 401);
	}
}