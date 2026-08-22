<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'sent' => false
        ];

        $email_recipient = [
            'gonzalezrojosantiago@gmail.com' => 'Info la reja'
        ];
        $input_data = $request->all();

        if (!empty($input_data)) {
               
            // Collect input
            $contact_name    = $request->post('contactname');
            $contact_email   = $request->post('contactemail');
            $contact_subject = $request->post('contactsubject');
            $contact_message = $request->post('contactmessage');

            // Form Validation
            $validator = Validator::make(
                [
                    'contactname'    => $contact_name,
                    'contactemail'   => $contact_email,
                    'contactsubject' => $contact_subject,
                    'contactmessage' => $contact_message
                ],
                [
                    'contactname'    => 'required',
                    'contactemail'   => 'required|email',
                    'contactsubject' => 'required',
                    'contactmessage' => 'required'
                ]
            );

            $validator->validate();
            if ($validator->fails())
            {
                $messages = $validator->messages();
                return view('contact', $data);
            }

            // All is well -- Submit form
            $vars = compact('contact_name', 'contact_email','contact_subject','contact_message');

            Mail::send('mail.contact', $vars, function($message) use ($email_recipient, $contact_subject) {
                $to = $email_recipient;
                $message->to($to,'Fernando Contreras');
                $webform = 'WebForm: '.$contact_subject;
                $message->subject($webform);
            });

            Session::put('mail_sent',true);
            Session::save();
            header('location: /contacto');
            exit;

        }
        else {
            $mail_sent = Session::get('mail_sent');
            if (!is_null($mail_sent) && $mail_sent){
                Session::forget('mail_sent');
                $data['sent'] = true;
            }
        }

        return view('contact', $data);
    }
}
