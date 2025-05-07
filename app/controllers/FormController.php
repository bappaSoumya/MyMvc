<?php


class FormController extends Controller {
    public function showForm() {
        //echo "ekhane asche form dekhabe";
        //$this->back();
        $this->view('form', []);
    }
    public function submit() {
        $request = new Request();

        $rules = [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email',
        ];

        $messages = [
            'name' => [
                'required' => 'custom messege: The name field is mandatory.',
                'string' => 'The name must be a valid string.',
                'max' => 'The name cannot exceed 255 characters.',
                'min' => 'The name must be at least 3 characters long.',
            ],
            'email' => [
                'required' => 'custom messege: The email field is mandatory.',
                'email' => 'Please provide a valid email address.',
            ],
        ];

        if ($request->validate($rules, $messages)) {
            
            $request->clearOldInput(); // Clear old input on successful validation
            echo "Form submitted successfully!";
        } else {
            $errors = $request->errors();
            $this->view('form', ['errors' => $errors]);
            $request->clearOldInput();
        }
    }
}