<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class DoctorRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'Mail'=>'required',
            'Name'=>'required',
            'ProfessionalLicense' => 'required',
            'PermanentAddress' => 'required',
            'PhoneNumber' => 'required'
		];
	}

}
