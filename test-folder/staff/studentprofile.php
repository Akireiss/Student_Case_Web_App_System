if (Auth::check()) {
            if (Auth::user()->role == 1) {
                session()->flash('message', 'Successfully Saved');
                $this->resetForm();
            }
        } else {
            $this->formSubmitted = true;
            $createdForm = Profile::latest()->first();
            Session::put('created_form_id', $createdForm->id);
            return redirect('student/qr/code');
        }
